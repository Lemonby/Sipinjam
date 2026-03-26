<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsers extends Migration
{
    // ini adalah contoh migration untuk membuat tabel users
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'role' => ['type' => 'ENUM', 'constraint' => ['admin', 'user'], 'default' => 'user'],
            'nim' => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'jurusan' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'telp' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'createdAt' => ['type' => 'TIMESTAMP', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    // ini adalah contoh migration untuk menghapus tabel users
    public function down()
    {
        $this->forge->dropTable('users');
    }
}
