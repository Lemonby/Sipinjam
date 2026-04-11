<?php

namespace App\Models;

use CodeIgniter\Model;

class FinesModel extends Model
{
    protected $table = 'fines';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['idLoan', 'jumlahDenda', 'status', 'proofOfPayment', 'paidAt', 'createdAt'];

    /**
     * Get fines untuk user dengan informasi pinjaman dan buku
     */
    public function getFinesByUser($idUser)
    {
        return $this->select('fines.id, fines.jumlahDenda, fines.status, fines.proofOfPayment, fines.paidAt, fines.createdAt, loans.tanggalKembali as tanggal_kembali, books.judul as judul_buku')
            ->join('loans', 'loans.id = fines.idLoan')
            ->join('bookCopies', 'bookCopies.id = loans.idBookCopy')
            ->join('books', 'books.id = bookCopies.idBuku')
            ->where('loans.idUser', $idUser)
            ->orderBy('fines.createdAt', 'DESC')
            ->findAll();
    }

    /**
     * Get total denda belum dibayar user
     */
    public function getTotalUnpaidFines($idUser)
    {
        return $this->selectSum('jumlahDenda')
            ->join('loans', 'loans.id = fines.idLoan')
            ->where('loans.idUser', $idUser)
            ->where('fines.status', 'belum dibayar')
            ->first();
    }

    /**
     * Get jumlah denda belum dibayar
     */
    public function getCountUnpaidFines($idUser)
    {
        return $this->join('loans', 'loans.id = fines.idLoan')
            ->where('loans.idUser', $idUser)
            ->where('fines.status', 'belum dibayar')
            ->countAllResults();
    }

    /**
     * Get fine by ID
     */
    public function getFineById($id, $idUser = null)
    {
        $query = $this->select('fines.*, loans.idUser, books.judul')
            ->join('loans', 'loans.id = fines.idLoan')
            ->join('bookCopies', 'bookCopies.id = loans.idBookCopy')
            ->join('books', 'books.id = bookCopies.idBuku')
            ->where('fines.id', $id);

        if ($idUser) {
            $query->where('loans.idUser', $idUser);
        }

        return $query->first();
    }

    /**
     * Mark fine as paid with proof
     */
    public function markAsPaid($id, $proofOfPayment, $idUser = null)
    {
        $data = [
            'status' => 'dibayar',
            'proofOfPayment' => $proofOfPayment,
            'paidAt' => date('Y-m-d H:i:s')
        ];

        if ($idUser) {
            return $this->db->table($this->table)
                ->join('loans', 'loans.id = fines.idLoan')
                ->where('fines.id', $id)
                ->where('loans.idUser', $idUser)
                ->update($data);
        } else {
            return $this->update($id, $data);
        }
    }
}
