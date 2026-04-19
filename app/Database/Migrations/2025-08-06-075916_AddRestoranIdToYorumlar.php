<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRestoranIdToYorumlar extends Migration
{
    public function up()
    {
        $this->forge->addColumn('yorumlar', [
            'restoran_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false,
                'after'      => 'id' // konumlandırmak istersen
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('yorumlar', 'restoran_id');
    }
}
