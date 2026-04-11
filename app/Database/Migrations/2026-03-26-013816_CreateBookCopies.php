<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookCopies extends Migration
{
    public function up()
    {
        // ini adalah contoh migration untuk membuat tabel book_copies
        $this->forge->addField([
        'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        'idBuku' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
        'kodeBuku' => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
        'status' => ['type' => 'ENUM', 'constraint' => ['tersedia', 'tidak tersedia'], 'default' => 'tersedia'],
        'jumlahBuku' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
    ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idBuku', 'books', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bookCopies');
    }

    public function down()
    {
        // ini adalah contoh migration untuk menghapus tabel bookCopies
        $this->forge->dropTable('bookCopies');
    }
}