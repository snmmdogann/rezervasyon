<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSehirToOteller extends Migration
{
    public function up()
    {
        $fields = [
            'sehir' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'adres'  // hangi sütundan sonra ekleneceği
            ],
        ];
        $this->forge->addColumn('oteller', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('oteller', 'sehir');
    }
}
