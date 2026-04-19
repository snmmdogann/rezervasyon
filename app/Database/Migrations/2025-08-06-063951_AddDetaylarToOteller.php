<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDetaylarToOteller extends Migration
{
    public function up()
    {
        $this->forge->addColumn('oteller', [
            'aciklama' => [
                'type' => 'TEXT',
                'null' => true,
                'after' => 'puan',
            ],
            'konum_linki' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
                'null' => true,
                'after' => 'aciklama',
            ],
            'telefon' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
                'after' => 'konum_linki',
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true,
                'after' => 'telefon',
            ],
            'instagram' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'email',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('oteller', ['aciklama', 'konum_linki', 'telefon', 'email', 'instagram']);
    }
}
