<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddFieldsToRestoranlar extends Migration
{
    public function up()
    {
        $fields = [
            'aciklama' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'konum_linki' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'telefon' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'instagram' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'sehir' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'calisma_saatleri' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ];

        $this->forge->addColumn('restoranlar', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('restoranlar', 'aciklama');
        $this->forge->dropColumn('restoranlar', 'konum_linki');
        $this->forge->dropColumn('restoranlar', 'telefon');
        $this->forge->dropColumn('restoranlar', 'email');
        $this->forge->dropColumn('restoranlar', 'instagram');
        $this->forge->dropColumn('restoranlar', 'sehir');
        $this->forge->dropColumn('restoranlar', 'calisma_saatleri');
    }
}
