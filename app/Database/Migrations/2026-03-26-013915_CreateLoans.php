<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLoans extends Migration
{
    public function up()
    {
        // ini adalah contoh migration untuk membuat tabel loans
        $this->forge->addField([
        'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        'idUser' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
        'idBookCopy' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
        'tanggalPinjam' => ['type' => 'DATE', 'null' => true],
        'tanggalJatuhTempo' => ['type' => 'DATE', 'null' => true],
        'tanggalKembali' => ['type' => 'DATE', 'null' => true],
        'status' => ['type' => 'ENUM', 'constraint' => ['dipinjam', 'kembali', 'terlambat'], 'default' => 'dipinjam'],
    ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idUser', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idBookCopy', 'bookCopies', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('loans');
    }

    public function down()
    {
        // ini adalah contoh migration untuk menghapus tabel loans
        $this->forge->dropTable('loans');
    }
}
