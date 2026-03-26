<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateExtensions extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
        'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
        'idLoan' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
        'tanggalPerpanjangan' => ['type' => 'DATE', 'null' => true],
        'jumlahHari' => ['type' => 'INT', 'constraint' => 11, 'null' => true],
        'status' => ['type' => 'ENUM', 'constraint' => ['disetujui', 'ditolak'], 'default' => 'disetujui'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idLoan', 'loans', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('extensions');
    }

    public function down()
    {
        //
        $this->forge->dropTable('extensions');
    }
}
