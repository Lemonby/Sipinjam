<?php

namespace App\Models;
use CodeIgniter\Model;

class DashboardModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'nim', 'jurusan'];


    public function getUserByNim()
    {
        $user=session()->get('mahasiswa');

        return $this->where('nim', $user['nim'])->first();
    }

    public function updateUser($data)
    {
        $user=session()->get('mahasiswa');
        $id = $this->where('nim', $user['nim'])->first()['id'];

        return $this->update($id, $data);
    }

    // mendapatkan data user dan data peminjaman buku yang sedang dipinjam
    public function getDataUser()
    {
        $user=session()->get('mahasiswa');
        return $this->select('
            users.*, 
            books.judul as judulBuku,
            books.cover as coverBuku,
            books.penulis as penulisBuku,
            DATEDIFF(loans.tanggalJatuhTempo, NOW()) as sisaHari,        
            COUNT(loans.id) as totalDipinjam')
            ->join('loans', 'loans.idUser = users.id', 'left')
            ->join('bookCopies', 'bookCopies.id = loans.idBookCopy', 'left')
            ->join('books', 'books.id = bookCopies.idBuku', 'left')
            ->where('users.nim', $user['nim'])
            ->where('loans.status', 'dipinjam')
            ->findAll();
    }
}