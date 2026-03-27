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
        $bookCopy = $bookCopiesModel->getBookCopyById($idBookCopy);
        $buku = $booksModel->getBookById($bookCopy['idBuku']);

        return view('PerpanjangDetail', [
            'user' => $user,
            'idBookCopy' => $idBookCopy,
            'peminjaman' => $dataPeminjaman,
            'buku' => $buku,
            'tanggalKembaliLama' => $dataPeminjaman['tanggalJatuhTempo'],
            'tanggalKembaliBaru' => date('Y-m-d', strtotime($dataPeminjaman['tanggalJatuhTempo'] . ' +7 days')),
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
        $tanggalKembaliBaru = $request->getPost('tanggalKembaliBaru');

        if (!isset($idBookCopy) || !$tanggalKembaliBaru) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        // Validasi tanggal (tidak boleh lebih awal dari hari ini)
        if (strtotime($tanggalKembaliBaru) < strtotime(date('Y-m-d'))) {
            return redirect()->back()->with('error', 'Tanggal kembali tidak boleh lebih awal dari hari ini.');
        }

        $result = $peminjamanModel->extendLoan($idBookCopy, $tanggalKembaliBaru, $user['id']);

        if (!$result) {
            return redirect()->to('/peminjamanku')->with('error', 'Peminjaman tidak ditemukan atau gagal diperpanjang.');
        }

        return redirect()->to('/peminjamanku')->with('success', 'Peminjaman berhasil diperpanjang!');
    }

    public function return($idBookCopy)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = session()->get('mahasiswa');
        $dataPeminjaman = new \App\Models\PeminjamanModel();
        $booksModel = new \App\Models\BooksModel();
        $bookCopyModel = new \App\Models\BookCopiesModel();

        $peminjaman = $dataPeminjaman->getLoanByIdBookCopyAndUser($idBookCopy, $user['id']);
        
        if (!isset($peminjaman)) {
            return redirect()->to('/peminjamanku')->with('error', 'Peminjaman tidak ditemukan.');
        }

        $tanggalJatuhTempo = strtotime($peminjaman['tanggalJatuhTempo']);
        $sekarang = strtotime(date('Y-m-d'));
        $denda = 0;

        if ($sekarang > $tanggalJatuhTempo) {
            $hari_telat = floor(($sekarang - $tanggalJatuhTempo) / (60 * 60 * 24));
            $denda = $hari_telat * 5000; // Rp 5000 per hari
        }

       $bookCopy = $bookCopyModel->getBookCopyById($idBookCopy);
       $buku = $booksModel->getBookById($bookCopy['idBuku']);

        return view('KembaliDetail', [
            'user' => session()->get('mahasiswa'),
            'idBookCopy' => $idBookCopy,
            'peminjaman' => $peminjaman,
            'buku' => $buku,
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
        $idBookCopy = $request->getPost('idBookCopy');

        $user = session()->get('mahasiswa');
        $peminjamanModel = new \App\Models\PeminjamanModel();
        $bookCopyModel = new \App\Models\BookCopiesModel();
        // $finesModel = new \App\Models\FinesModel(); --- IGNORE ---

        $dataPeminjaman = $peminjamanModel->getLoanByIdBookCopyAndUser($idBookCopy, $user['id']);
        $tanggalKembali = date('Y-m-d'); // Tanggal pengembalian hari ini

        if (!isset($dataPeminjaman)) {
            return redirect()->to('/peminjamanku')->with('error', 'Peminjaman tidak ditemukan.');
        }
        
        // Update status peminjaman menjadi "kembali"
        $peminjamanModel->returnLoan($idBookCopy, $tanggalKembali, $user['id']);

        // update book copy menjadi tersedia
        $bookCopyModel->updateStatus($idBookCopy, 'tersedia');

        return redirect()->to('/peminjamanku')->with('success', 'Buku berhasil dikembalikan!');
    }
}
