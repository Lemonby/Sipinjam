<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'nim', 'jurusan', 'password'];

    public function getUserById($id)
    {
        return $this->find($id);
    }

    public function updateUser($id, $data)
    {
        return $this->update($id, $data);
    }
}