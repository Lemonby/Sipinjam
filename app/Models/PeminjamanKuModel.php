<?php

namespace App\Models;
use CodeIgniter\Model;

class PeminjamanKuModel extends Model
{
    protected $table = 'loans';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idBookCopy', 'tanggalPinjam', 'tanggalJatuhTempo', 'tanggalKembali', 'status', 'idUser'];

    public function getPeminjamanByUserId($user_id)
    {
        return $this->select('
        loans.*, 
        books.judul as judulBuku,
        bookCopies.id as idBookCopy,
        books.cover as coverBuku,
        books.penulis as penulisBuku')
        
        ->join('bookCopies', 'bookCopies.id = loans.idBookCopy')
        ->join('books', 'books.id = bookCopies.idBuku')
        ->where('loans.status', 'dipinjam')
        ->where('loans.idUser', $user_id)
        ->findAll();
    }
}