<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservationModel extends Model
{
    protected $table = 'reservations';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['idUser', 'idBuku', 'antrianKe', 'tanggalReservasi', 'status', 'createdAt'];

    /**
     * Get reservations untuk user dengan informasi buku
     */
    public function getReservationsByUser($idUser)
    {
        return $this->select('reservations.*, books.judul, books.penulis, books.cover')
            ->join('books', 'books.id = reservations.idBuku')
            ->where('reservations.idUser', $idUser)
            ->where('reservations.status !=', 'dibatalkan')
            ->orderBy('reservations.tanggalReservasi', 'DESC')
            ->findAll();
    }

    /**
     * Get total reservasi aktif untuk user
     */
    public function getTotalActiveReservations($idUser)
    {
        return $this->where('idUser', $idUser)
            ->whereIn('status', ['menunggu', 'diproses'])
            ->countAllResults();
    }

    /**
     * Check if user already reserved this book
     */
    public function isAlreadyReserved($idUser, $idBuku)
    {
        return $this->where('idUser', $idUser)
            ->where('idBuku', $idBuku)
            ->whereIn('status', ['menunggu', 'diproses'])
            ->first();
    }

    /**
     * Get queue position for a book
     */
    public function getQueuePosition($idBuku)
    {
        return $this->where('idBuku', $idBuku)
            ->whereIn('status', ['menunggu', 'diproses'])
            ->countAllResults() + 1;
    }

    /**
     * Create new reservation
     */
    public function createReservation($idUser, $idBuku)
    {
        $queuePosition = $this->getQueuePosition($idBuku);
        
        $data = [
            'idUser' => $idUser,
            'idBuku' => $idBuku,
            'antrianKe' => $queuePosition,
            'tanggalReservasi' => date('Y-m-d'),
            'status' => 'menunggu',
            'createdAt' => date('Y-m-d H:i:s')
        ];

        return $this->insert($data);
    }

    /**
     * Cancel reservation
     */
    public function cancelReservation($id, $idUser)
    {
        return $this->db->table($this->table)
            ->where('id', $id)
            ->where('idUser', $idUser)
            ->update(['status' => 'dibatalkan']);
    }

    /**
     * Get reservation by ID
     */
    public function getReservationById($id, $idUser = null)
    {
        $query = $this->select('reservations.*, books.judul, books.penulis, books.cover, users.nama as nama_user')
            ->join('books', 'books.id = reservations.idBuku')
            ->join('users', 'users.id = reservations.idUser')
            ->where('reservations.id', $id);

        if ($idUser) {
            $query->where('reservations.idUser', $idUser);
        }

        return $query->first();
    }
}
