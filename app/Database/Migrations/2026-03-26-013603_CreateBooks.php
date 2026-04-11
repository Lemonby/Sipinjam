<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBooks extends Migration
{
    public function up()
    {
        // ini adalah contoh migration untuk membuat tabel books
        $this->forge->addField([
        'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        'judul' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        'penulis' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        'penerbit' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        'tahunTerbit' => ['type' => 'YEAR', 'null' => true],
        'idKategori' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
        'deskripsi' => ['type' => 'TEXT', 'null' => true],
        'cover' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        'createdAt' => ['type' => 'TIMESTAMP', 'null' => true],
    ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idKategori', 'categories', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('books');
    }

    public function down()
    {
        // ini adalah contoh migration untuk menghapus tabel books
        $this->forge->dropTable('books');
    }
}
