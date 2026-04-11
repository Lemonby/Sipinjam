<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProofOfPaymentToFines extends Migration
{
    public function up()
    {
        $this->forge->addColumn('fines', [
            'proofOfPayment' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'paidAt' => ['type' => 'DATETIME', 'null' => true],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('fines', 'proofOfPayment');
        $this->forge->dropColumn('fines', 'paidAt');
    }
}
