<?php

namespace App\Controllers;

class PeminjamanKu extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $session = session();
        $peminjaman_list = $session->get('peminjaman_list') ?? [];

        // Proses data peminjaman untuk ditampilkan
        $peminjaman_processed = [];
        foreach ($peminjaman_list as $index => $peminjaman) {
            $buku = $this->getBukuById($peminjaman['id_buku']);
            if ($buku) {
                $tanggal_kembali = strtotime($peminjaman['tanggal_kembali']);
                $sekarang = strtotime(date('Y-m-d'));
                $status_peminjaman = 'aktif';
                $hari_sisa = floor(($tanggal_kembali - $sekarang) / (60 * 60 * 24));

                if ($sekarang > $tanggal_kembali) {
                    $status_peminjaman = 'telat';
                    $hari_sisa = abs($hari_sisa);
                } else {
                    $hari_sisa = max($hari_sisa, 0);
                }

                $peminjaman_processed[] = [
                    'index' => $index,
                    'id_buku' => $peminjaman['id_buku'],
                    'judul' => $buku['judul'],
                    'penulis' => $buku['penulis'],
                    'cover' => $buku['cover'],
                    'tanggal_mulai' => $peminjaman['tanggal_mulai'],
                    'tanggal_kembali' => $peminjaman['tanggal_kembali'],
                    'catatan' => $peminjaman['catatan'] ?? '',
                    'status' => $status_peminjaman,
                    'hari_sisa' => $hari_sisa,
                    'denda' => $status_peminjaman === 'telat' ? $hari_sisa * 5000 : 0,
                ];
            }
        }

        return view('PeminjamanKu', [
            'user' => session()->get('mahasiswa'),
            'peminjaman' => $peminjaman_processed
        ]);
    }

    private function getBukuById($id)
    {
        $all_buku = [
            [
                'id' => 1, 
                'judul' => 'Pemrograman Web dengan CodeIgniter',
                'penulis' => 'John Doe', 
                'cover' => 'https://via.placeholder.com/100x150?text=Book+1'
            ],
            [
                'id' => 2, 
                'judul' => 'Belajar PHP untuk Pemula', 
                'penulis' => 'Jane Smith', 
                'cover' => 'https://via.placeholder.com/100x150?text=Book+2'
            ],
            [
                'id' => 3, 
                'judul' => 'Framework Laravel untuk Semua', 
                'penulis' => 'Alice Johnson', 
                'cover' => 'https://via.placeholder.com/100x150?text=Book+3'
            ],
             [
                'id' => 4, 
                'judul' => 'Membangun Aplikasi dengan ReactJS', 
                'penulis' => 'Bob Williams', 
                'cover' => 'https://via.placeholder.com/100x150?text=Book+4'
            ],
             [
                'id' => 5, 
                'judul' => 'Database MySQL untuk Pemula', 
                'penulis' => 'Charlie Brown', 
                'cover' => 'https://via.placeholder.com/100x150?text=Book+5'
            ],
            
            
        ];

        foreach ($all_buku as $buku) {
            if ($buku['id'] == $id) {
                return $buku;
            }
        }
        return null;
    }
}
