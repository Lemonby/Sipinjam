<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategories extends Migration
{
    public function up()
    {
        // ini adalah contoh migration untuk membuat tabel categories
        $this->forge->addField([
        'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        'namaKategori' => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
    ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('categories');
    }

    public function down()
    {
        // ini adalah contoh migration untuk menghapus tabel categories
        $this->forge->dropTable('categories');
    }
}
