<?php

namespace App\Controllers;

class Peminjaman extends BaseController
{
    private array $DummyBuku = [
        [
            'id' => 1,
            'judul' => 'Pemrograman Web dengan CodeIgniter',
            'penulis' => 'John Doe',
            'cover' => 'https://via.placeholder.com/100x150?text=Book+1',
            'status' => 'tersedia',
            'tanggal_kembali' => '3 hari lagi',
        ],
        [
            'id' => 2,
            'judul' => 'Belajar PHP untuk Pemula',
            'penulis' => 'Jane Smith',
            'cover' => 'https://via.placeholder.com/100x150?text=Book+2',
            'status' => 'tidak tersedia',
            'tanggal_kembali' => '3 hari yang lalu',
        ],
        [
            'id' => 3,
            'judul' => 'Framework Laravel untuk Semua',
            'penulis' => 'Alice Johnson',
            'cover' => 'https://via.placeholder.com/100x150?text=Book+3',
            'status' => 'tersedia',
            'tanggal_kembali' => '5 hari lagi',
        ],
        [
            'id' => 4,
            'judul' => 'Membangun Aplikasi dengan Vue.js',
            'penulis' => 'Bob Brown',
            'cover' => 'https://via.placeholder.com/100x150?text=Book+4',
            'status' => 'tersedia',
            'tanggal_kembali' => '7 hari lagi',
        ],
        [
            'id' => 5,
            'judul' => 'Belajar JavaScript dengan Mudah',
            'penulis' => 'Charlie Davis',
            'cover' => 'https://via.placeholder.com/100x150?text=Book+5',
            'status' => 'tidak tersedia',
            'tanggal_kembali' => '1 hari yang lalu',
        ],
        [
            'id' => 6,
            'judul' => 'Desain UI/UX untuk Pemula',
            'penulis' => 'Diana Evans',
            'cover' => 'https://via.placeholder.com/100x150?text=Book+6',
            'status' => 'tersedia',
            'tanggal_kembali' => '10 hari lagi',
        ],
        [
            'id' => 7,
            'judul' => 'Belajar Python untuk Semua',
            'penulis' => 'Eve Foster',
            'cover' => 'https://via.placeholder.com/100x150?text=Book+7',
            'status' => 'tersedia',
            'tanggal_kembali' => '2 hari lagi',
        ],
        [
            'id' => 8,
            'judul' => 'Membangun API dengan Node.js',
            'penulis' => 'Frank Green',
            'cover' => 'https://via.placeholder.com/100x150?text=Book+8',
            'status' => 'tidak tersedia',
            'tanggal_kembali' => '4 hari yang lalu',
        ],
    ];

    public function pinjam($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Cari buku berdasarkan ID
        $buku = null;
        foreach ($this->DummyBuku as $b) {
            if ($b['id'] == $id) {
                $buku = $b;
                break;
            }
        }

        // Jika buku tidak ditemukan
        if (!$buku) {
            return redirect()->to('/katalog')->with('error', 'Buku tidak ditemukan.');
        }

        // Jika buku tidak tersedia
        if ($buku['status'] !== 'tersedia') {
            return redirect()->to('/katalog')->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        $tanggal_mulai = date('Y-m-d');
        $tanggal_kembali = date('Y-m-d', strtotime('+7 days')); // Default 7 hari

        return view('PeminjamanDetail', [
            'user' => session()->get('mahasiswa'),
            'buku' => $buku,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_kembali' => $tanggal_kembali,
        ]);
    }

    public function proses_peminjaman()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request = service('request');
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

        // Simpan data peminjaman (untuk sekarang hanya session, nanti bisa ke database)
        $peminjaman = [
            'id_buku' => $id_buku,
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_kembali' => $tanggal_kembali,
            'catatan' => $catatan,
            'status' => 'aktif',
        ];

        // Simpan ke session atau database
        $session = session();
        $peminjaman_list = $session->get('peminjaman_list') ?? [];
        $peminjaman_list[] = $peminjaman;
        $session->set('peminjaman_list', $peminjaman_list);

        return redirect()->to('/peminjamanku')->with('success', 'Buku berhasil dipinjam!');
    }

    public function perpanjang($index)
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
        $tanggal_kembali_lama = $peminjaman['tanggal_kembali'];
        $tanggal_kembali_baru = date('Y-m-d', strtotime($tanggal_kembali_lama . ' +7 days'));

        return view('PerpanjangDetail', [
            'user' => session()->get('mahasiswa'),
            'index' => $index,
            'peminjaman' => $peminjaman,
            'buku' => $this->getBukuById($peminjaman['id_buku']),
            'tanggal_kembali_lama' => $tanggal_kembali_lama,
            'tanggal_kembali_baru' => $tanggal_kembali_baru,
        ]);
    }

    public function proses_perpanjang()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $request = service('request');
        $index = $request->getPost('index');
        $tanggal_kembali_baru = $request->getPost('tanggal_kembali_baru');

        if (!isset($index) || !$tanggal_kembali_baru) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        $session = session();
        $peminjaman_list = $session->get('peminjaman_list') ?? [];

        if (!isset($peminjaman_list[$index])) {
            return redirect()->to('/peminjamanku')->with('error', 'Peminjaman tidak ditemukan.');
        }

        $peminjaman_list[$index]['tanggal_kembali'] = $tanggal_kembali_baru;
        $session->set('peminjaman_list', $peminjaman_list);

        return redirect()->to('/peminjamanku')->with('success', 'Peminjaman berhasil diperpanjang!');
    }

    public function kembalikan($index)
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

    public function proses_kembalikan()
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
