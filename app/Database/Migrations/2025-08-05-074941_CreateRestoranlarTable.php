<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRestoranlarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'isim' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'adres' => [
                'type'       => 'TEXT',
            ],
            'puan' => [
                'type'       => 'FLOAT',
                'default'    => 0,
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('restoranlar');
    }

    public function down()
    {
        $this->forge->dropTable('restoranlar');
    }
}
