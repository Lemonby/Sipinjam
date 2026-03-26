<?php

namespace App\Controllers;

class Peminjaman extends BaseController
{
    public function loan($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $booksModel = new \App\Models\BooksModel();
        $book = $booksModel->getBookById($id);
        
        // Jika buku tidak ditemukan
        if (!$book) {
            return redirect()->to('/katalog')->with('error', 'Buku tidak ditemukan.');
        }

        $tanggal_mulai = date('Y-m-d');
        $tanggal_kembali = date('Y-m-d', strtotime('+7 days')); // Default 7 hari

        return view('PeminjamanDetail', [
            'user' => session()->get('mahasiswa'),
            'buku' => $book,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_kembali' => $tanggal_kembali,
        ]);
    }

    public function loanProses()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request = service('request'); // Ambil data dari form yang menggunakan POST
        $id_buku = $request->getPost('id_buku');
        $tanggal_mulai = $request->getPost('tanggal_mulai');
        $tanggal_kembali = $request->getPost('tanggal_kembali');
        $catatan = $request->getPost('catatan');

        // Validasi sederhana
        if (!$id_buku || !$tanggal_mulai || !$tanggal_kembali) {
            return redirect()->back()->with('error', 'Semua field wajib diisi.');
        }

        // Validasi tanggal
        if (strtotime($tanggal_kembali) <= strtotime($tanggal_mulai)) {
            return redirect()->back()->with('error', 'Tanggal kembali harus lebih besar dari tanggal mulai.');
        }

        // dapatkan data pengguna dari session
        $user = session()->get('mahasiswa');

        // dapatkan copi buku yang tersedia
        $bookCopiesModel = new \App\Models\BookCopiesModel();
        $availableCopy = $bookCopiesModel->where('idBuku', $id_buku)->where('status', 'tersedia')->first();

        if (!$availableCopy) {
            return redirect()->back()->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        // Simpan data peminjaman (ke database)
        $peminjamanModel = new \App\Models\PeminjamanModel();
        $peminjamanModel->createLoan([
            'idBookCopy' => $availableCopy['id'],
            'tanggalPinjam' => $tanggal_mulai,
            'tanggalJatuhTempo' => $tanggal_kembali,
            'status' => 'dipinjam',
            'idUser' => $user['id'],
            'catatan' => $catatan,
        ]);

        // Update status buku menjadi "dipinjam"
        $bookCopiesModel->updateStatus($availableCopy['id'], 'tidak tersedia');

        return redirect()->to('/peminjamanku')->with('success', 'Buku berhasil dipinjam!');
    }

    public function extend($idBookCopy)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = session()->get('mahasiswa');
        $peminjamanModel = new \App\Models\PeminjamanModel();
        $booksModel = new \App\Models\BooksModel();
        $bookCopiesModel = new \App\Models\BookCopiesModel();
        
        // Cari peminjaman spesifik berdasarkan idBookCopy dan idUser
        $dataPeminjaman = $peminjamanModel->getLoanByIdBookCopyAndUser($idBookCopy, $user['id']);

        if (!$dataPeminjaman) {
            return redirect()->to('/peminjamanku')->with('error', 'Peminjaman tidak ditemukan.');
        }

        // Dapatkan data buku copy
        $bookCopy = $bookCopiesModel->find($idBookCopy);
        $buku = $booksModel->find($bookCopy['idBuku']);

        return view('PerpanjangDetail', [
            'user' => $user,
            'idBookCopy' => $idBookCopy,
            'peminjaman' => $dataPeminjaman,
            'buku' => $buku,
            'tanggal_kembali_lama' => $dataPeminjaman['tanggalJatuhTempo'],
            'tanggal_kembali_baru' => date('Y-m-d', strtotime($dataPeminjaman['tanggalJatuhTempo'] . ' +7 days')),
        ]);

    }

    public function extendProses()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = session()->get('mahasiswa');
        $peminjamanModel = new \App\Models\PeminjamanModel();

        $request = service('request');
        $idBookCopy = $request->getPost('idBookCopy');
        $tanggal_kembali_baru = $request->getPost('tanggal_kembali_baru');

        if (!isset($idBookCopy) || !$tanggal_kembali_baru) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        // Validasi tanggal (tidak boleh lebih awal dari hari ini)
        if (strtotime($tanggal_kembali_baru) < strtotime(date('Y-m-d'))) {
            return redirect()->back()->with('error', 'Tanggal kembali tidak boleh lebih awal dari hari ini.');
        }

        $result = $peminjamanModel->extendLoan($idBookCopy, $tanggal_kembali_baru, $user['id']);

        if (!$result) {
            return redirect()->to('/peminjamanku')->with('error', 'Peminjaman tidak ditemukan atau gagal diperpanjang.');
        }

        return redirect()->to('/peminjamanku')->with('success', 'Peminjaman berhasil diperpanjang!');
    }

    public function return($index)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $session = session();
        $peminjaman_list = $session->get('peminjaman_list') ?? [];

        if (!isset($peminjaman_list[$index])) {
            return redirect()->to('/peminjamanku')->with('error', 'Peminjaman tidak ditemukan.');
        }

        $peminjaman = $peminjaman_list[$index];
        $tanggal_kembali = strtotime($peminjaman['tanggal_kembali']);
        $sekarang = strtotime(date('Y-m-d'));
        $denda = 0;

        if ($sekarang > $tanggal_kembali) {
            $hari_telat = floor(($sekarang - $tanggal_kembali) / (60 * 60 * 24));
            $denda = $hari_telat * 5000; // Rp 5000 per hari
        }

        return view('KembaliDetail', [
            'user' => session()->get('mahasiswa'),
            'index' => $index,
            'peminjaman' => $peminjaman,
            'buku' => $this->getBukuById($peminjaman['id_buku']),
            'tanggal_pengembalian' => date('Y-m-d'),
            'denda' => $denda,
        ]);
    }

    public function returnProses()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request = service('request');
        $index = $request->getPost('index');

        $session = session();
        $peminjaman_list = $session->get('peminjaman_list') ?? [];

        if (!isset($peminjaman_list[$index])) {
            return redirect()->to('/peminjamanku')->with('error', 'Peminjaman tidak ditemukan.');
        }

        // Hapus dari list peminjaman
        array_splice($peminjaman_list, $index, 1);
        $session->set('peminjaman_list', $peminjaman_list);

        return redirect()->to('/peminjamanku')->with('success', 'Buku berhasil dikembalikan!');
    }

    private function getBukuById($id)
    {
        $all_buku = [
            ['id' => 1, 'judul' => 'Pemrograman Web dengan CodeIgniter', 'penulis' => 'John Doe', 'cover' => 'https://via.placeholder.com/100x150?text=Book+1'],
            ['id' => 2, 'judul' => 'Belajar PHP untuk Pemula', 'penulis' => 'Jane Smith', 'cover' => 'https://via.placeholder.com/100x150?text=Book+2'],
            ['id' => 3, 'judul' => 'Framework Laravel untuk Semua', 'penulis' => 'Alice Johnson', 'cover' => 'https://via.placeholder.com/100x150?text=Book+3'],
            ['id' => 4, 'judul' => 'Membangun Aplikasi dengan Vue.js', 'penulis' => 'Bob Brown', 'cover' => 'https://via.placeholder.com/100x150?text=Book+4'],
            ['id' => 5, 'judul' => 'Belajar JavaScript dengan Mudah', 'penulis' => 'Charlie Davis', 'cover' => 'https://via.placeholder.com/100x150?text=Book+5'],
            ['id' => 6, 'judul' => 'Desain UI/UX untuk Pemula', 'penulis' => 'Diana Evans', 'cover' => 'https://via.placeholder.com/100x150?text=Book+6'],
            ['id' => 7, 'judul' => 'Belajar Python untuk Semua', 'penulis' => 'Eve Foster', 'cover' => 'https://via.placeholder.com/100x150?text=Book+7'],
            ['id' => 8, 'judul' => 'Membangun API dengan Node.js', 'penulis' => 'Frank Green', 'cover' => 'https://via.placeholder.com/100x150?text=Book+8'],
        ];

        foreach ($all_buku as $buku) {
            if ($buku['id'] == $id) {
                return $buku;
            }
        }
        return null;
    }
}
