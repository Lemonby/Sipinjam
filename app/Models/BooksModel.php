<?php

namespace App\Models;

use CodeIgniter\Model;

class BooksModel extends Model
{
    protected $table      = 'books';
    protected $primaryKey = 'id';
    // Daftarkan kolom yang boleh dimanipulasi
    protected $allowedFields = ['judul', 'penulis', 'penerbit', 'tahunTerbit', 'idKategori', 'deskripsi', 'cover'];

    // fungsi untuk mendapatkan semua buku beserta jumlah copy yang tersedia
    public function getAvailableBooks()
    {
        return $this->select('
                books.*, 
                SUM(CASE WHEN bookCopies.status = "tersedia" THEN 1 ELSE 0 END) as statusTersedia
            ')
            ->join('bookCopies', 'bookCopies.idBuku = books.id', 'left')
            ->groupBy('books.id')
            ->findAll();
    }

    // fungsi untuk mendapatkan detail buku berdasarkan id
    public function getBookById($id)
    {
        return $this->select('books.*, SUM(CASE WHEN bookCopies.status = "tersedia" THEN 1 ELSE 0 END) as statusTersedia')
            ->join('bookCopies', 'bookCopies.idBuku = books.id', 'left')
            ->groupBy('books.id')
            ->where('books.id', $id)
            ->first();
    }
}