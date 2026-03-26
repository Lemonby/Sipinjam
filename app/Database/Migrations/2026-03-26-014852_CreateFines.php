<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateFines extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
        'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        'idLoan' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
        'jumlahDenda' => ['type' => 'DECIMAL', 'constraint' => '10,2', 'null' => true],
        'status' => ['type' => 'ENUM', 'constraint' => ['belum dibayar', 'dibayar'], 'default' => 'belum dibayar'],
        'createdAt' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idLoan', 'loans', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('fines');
    }

    public function down()
    {
        //
        $this->forge->dropTable('fines');
    }
}
