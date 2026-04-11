<?php

namespace App\Models;
use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table      = 'loans';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idBookCopy', 'tanggalPinjam', 'tanggalJatuhTempo', 'tanggalKembali', 'status', 'idUser'];

    public function createLoan($data)
    {
        return $this->insert($data);
    }

    public function getLoansByUserId($userId)
    {
        return $this->select('*')->where('idUser', $userId)->findAll();
    }

    public function getLoanByIdBookCopyAndUser($idBookCopy, $userId)
    {
        return $this->where('idBookCopy', $idBookCopy)
                    ->where('idUser', $userId)
                    ->where('status', 'dipinjam')
                    ->first();
    }

    public function extendLoan($idBookCopy, $tanggalJatuhTempo, $idUser)
    {
        // Cek apakah peminjaman ada
        $existing = $this->where('idBookCopy', $idBookCopy)
                        ->where('idUser', $idUser)
                        ->first();

        if (!$existing) {
            return false; // Data tidak ditemukan
        }

        // Update jika data ada
        return $this->set(['tanggalJatuhTempo' => $tanggalJatuhTempo])
                    ->where('idBookCopy', $idBookCopy)
                    ->where('idUser', $idUser)
                    ->update();
    }

    public function returnLoan($idBookCopy, $tanggalKembali, $idUser)
    {
        // Cek apakah peminjaman ada
        $existing = $this->where('idBookCopy', $idBookCopy)
                        ->where('idUser', $idUser)
                        ->first();

        if (!$existing) {
            return false; // Data tidak ditemukan
        }

        // Update jika data ada
        return $this->set([
                    'tanggalKembali' => $tanggalKembali,
                    'status' => 'kembali'
                ])
                ->where('idBookCopy', $idBookCopy)
                ->where('idUser', $idUser)
                ->update();
    }
}