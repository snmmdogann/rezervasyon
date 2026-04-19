<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRezervasyonlarTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kullanici_id'   => [
                'type'       => 'INT',
                'null'       => true,
            ],
            'rezervasyon_tipi' => [  // 'otel' veya 'restoran'
                'type'       => 'ENUM',
                'constraint' => ['otel', 'restoran'],
                'default'    => 'restoran',
            ],
            'otel_id'        => [
                'type'       => 'INT',
                'null'       => true,
            ],
            'restoran_id'    => [
                'type'       => 'INT',
                'null'       => true,
            ],
            'tarih'          => [
                'type'       => 'DATE',
                'null'       => false,
            ],
            'saat'           => [
                'type'       => 'TIME',
                'null'       => true,
            ],
            'kisi_sayisi'    => [
                'type'       => 'INT',
                'null'       => true,
            ],
            'gece_sayisi'    => [
                'type'       => 'INT',
                'null'       => true,
            ],
'created_at' => [
    'type' => 'DATETIME',
    'null' => true,
],
'updated_at' => [
    'type' => 'DATETIME',
    'null' => true,
],



        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('rezervasyonlar');
    }

    public function down()
    {
        $this->forge->dropTable('rezervasyonlar');
    }
}
