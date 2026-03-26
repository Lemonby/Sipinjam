<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateReservations extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'idUser' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'idBuku' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'antrianKe' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
            'tanggalReservasi' => ['type' => 'DATE', 'null' => true],
            'status' => ['type' => 'ENUM', 'constraint' => ['menunggu', 'diproses', 'selesai', 'dibatalkan'], 'default' => 'menunggu'],
            'createdAt' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idUser', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idBuku', 'books', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('reservations');
    }

    public function down()
    {
        //
        $this->forge->dropTable('reservations');
    }
}
