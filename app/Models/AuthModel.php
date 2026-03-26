<?php

namespace App\Models;
use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'nim', 'jurusan', 'password'];

    public function authenticate($nama, $nim, $jurusan)
    {
        return $this->where('nama', $nama)
                    ->where('nim', $nim)
                    ->where('jurusan', $jurusan)
                    ->first();
    }

    public function getAllUsers()
    {
        return $this->findAll();
    }
}