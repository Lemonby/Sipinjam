<?php

namespace App\Models;
use CodeIgniter\Model;

class BookCopiesModel extends Model
{
    protected $table      = 'bookCopies';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idBuku', 'status', ];

    public function getCopiesByBookId($bookId)
    {
        return $this->where('idBuku', $bookId)->findAll();
    }

    public function updateStatus($bookCopyId, $status)
    {
        return $this->update($bookCopyId, ['status' => $status]);
    }

}