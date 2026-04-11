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
        $dataLoans = new \App\Models\PeminjamanKuModel();
        $peminjaman = $dataLoans->getPeminjamanByUserId($session->get('mahasiswa')['id']);

        // Proses data peminjaman - hitung sisa hari dan denda
        $peminjaman = $this->hitungSisaHariDanDenda($peminjaman);

        return view('PeminjamanKu', [
            'user' => session()->get('mahasiswa'),
            'peminjaman' => $peminjaman
        ]);
    }

    /**
     * Menghitung sisa hari dan denda untuk setiap peminjaman
     * @param array $peminjaman Data peminjaman dari database
     * @return array Data peminjaman dengan tambahan field hari_sisa dan denda
     */
    private function hitungSisaHariDanDenda($peminjaman)
    {
        $hariDenda = 1000; // Denda per hari (Rp)
        $hariIni = date('Y-m-d');

        foreach ($peminjaman as &$p) {
            // Hitung selisih hari antara jatuh tempo dan hari ini
            $tanggalJatuhTempo = new \DateTime($p['tanggalJatuhTempo']);
            $hariIniObj = new \DateTime($hariIni);
            $selisih = $hariIniObj->diff($tanggalJatuhTempo);

            // Jika belum melewati tanggal jatuh tempo
            if ($hariIniObj <= $tanggalJatuhTempo) {
                $p['hari_sisa'] = $selisih->days;
                $p['denda'] = 0;
            } else {
                // Jika sudah melewati tanggal jatuh tempo
                $p['hari_sisa'] = $selisih->days;
                $p['denda'] = $selisih->days * $hariDenda;
                $p['status'] = 'terlambat'; // Update status menjadi terlambat
            }
        }

        return $peminjaman;
    }
}
