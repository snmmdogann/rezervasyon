<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOtellerTable extends Migration
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
            'resim_yolu' => [            // Yeni sütun eklendi
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
                'default'    => null,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('oteller');
    }

    public function down()
    {
        $this->forge->dropTable('oteller');
    }
}
