<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateYorumlarTable extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id'          => [
            'type'           => 'INT',
            'constraint'     => 11,
            'unsigned'       => true,
            'auto_increment' => true,
        ],
        'restoran_id'     => [
            'type'       => 'INT',
            'constraint' => 11,
            'unsigned'   => true,
            'null'       => true,
        ],
        'otel_id'     => [
            'type'       => 'INT',
            'constraint' => 11,
            'unsigned'   => true,
            'null'       => true,
        ],
        'kullanici_id' => [
            'type'       => 'INT',
            'constraint' => 11,
            'unsigned'   => true,
            'null'       => true,
        ],
        'yorum'       => [
            'type' => 'TEXT',
            'null' => false,
        ],
        'puan'        => [
            'type'       => 'TINYINT',
            'constraint' => 1,
            'null'       => false,
        ],
        'tarih'       => [
            'type' => 'DATETIME',
            'null' => true,
        ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('yorumlar');
}


    public function down()
    {
        $this->forge->dropTable('yorumlar');
    }
}
