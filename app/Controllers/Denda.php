<?php

namespace App\Controllers;

class Denda extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $finesModel = new \App\Models\FinesModel();
        $idUser = session()->get('mahasiswa')['id'];
        $db = db_connect();

        // Get all fines
        $fines = $finesModel->getFinesByUser($idUser);

        // Calculate totals - using raw query for better accuracy
        $unpaidResult = $db->table('fines')
            ->selectSum('jumlahDenda')
            ->join('loans', 'loans.id = fines.idLoan')
            ->where('loans.idUser', $idUser)
            ->where('fines.status', 'belum dibayar')
            ->get()
            ->getRowArray();
        $totalDenda = $unpaidResult['jumlahDenda'] ?? 0;
        
        $paidResult = $db->table('fines')
            ->selectSum('jumlahDenda')
            ->join('loans', 'loans.id = fines.idLoan')
            ->where('loans.idUser', $idUser)
            ->where('fines.status', 'dibayar')
            ->get()
            ->getRowArray();
        $totalBayar = $paidResult['jumlahDenda'] ?? 0;

        return view('Denda', [
            'user' => session()->get('mahasiswa'),
            'fines' => $fines,
            'totalDenda' => $totalDenda,
            'totalBayar' => $totalBayar,
            'countUnpaidFines' => $finesModel->getCountUnpaidFines($idUser),
        ]);
    }

    /**
     * Upload bukti pembayaran denda
     */
    public function payWithProof($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/riwayat-denda')->with('error', 'Silakan login terlebih dahulu.');
        }

        try {
            $finesModel = new \App\Models\FinesModel();
            $idUser = session()->get('mahasiswa')['id'];

            // Check if fine exists and belongs to user
            $fine = $finesModel->getFineById($id, $idUser);
            if (!$fine) {
                return redirect()->to('/riwayat-denda')->with('error', 'Denda tidak ditemukan.');
            }

            // Check if fine is already paid
            if ($fine['status'] === 'dibayar') {
                return redirect()->to('/riwayat-denda')->with('error', 'Denda ini sudah dibayar.');
            }

            // Handle file upload
            $file = $this->request->getFile('buktiPembayaran');

            if (!$file->isValid()) {
                return redirect()->back()->with('error', 'File tidak valid.');
            }

            // Validate file type
            $mimeType = $file->getMimeType();
            $allowedMimes = ['image/jpeg', 'image/png', 'application/pdf'];
            
            if (!in_array($mimeType, $allowedMimes)) {
                return redirect()->back()->with('error', 'Hanya file JPG, PNG, atau PDF yang diizinkan.');
            }

            // Validate file size (max 5MB)
            if ($file->getSize() > 5242880) {
                return redirect()->back()->with('error', 'Ukuran file maksimal 5MB.');
            }

            // Generate unique filename
            $newName = 'bukti_' . time() . '_' . $file->getRandomName();
            
            // Move file to writable/uploads
            $file->move(WRITEPATH . 'uploads', $newName);

            // Update fine status and save proof filename
            if ($finesModel->markAsPaid($id, $newName, $idUser)) {
                return redirect()->to('/riwayat-denda')->with('success', 'Pembayaran denda berhasil! Bukti pembayaran telah tersimpan.');
            } else {
                // Delete file if update fails
                unlink(WRITEPATH . 'uploads/' . $newName);
                return redirect()->to('/riwayat-denda')->with('error', 'Gagal memproses pembayaran.');
            }
        } catch (\Exception $e) {
            return redirect()->to('/riwayat-denda')->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
