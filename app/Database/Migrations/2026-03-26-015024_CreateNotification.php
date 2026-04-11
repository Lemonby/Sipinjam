<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotification extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'idUser' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'pesan' => ['type' => 'TEXT', 'null' => true],
            'tipe' => ['type' => 'ENUM', 'constraint' => ['pengingat', 'reservasi', 'info'], 'default' => 'info'],
            'isRead' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'createdAt' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idUser', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('notifications');
    }

    public function down()
    {
        //
        $this->forge->dropTable('notifications');
    }
}
