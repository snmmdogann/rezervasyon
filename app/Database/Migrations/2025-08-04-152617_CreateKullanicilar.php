<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Createkullanicilar extends Migration
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
            'ad_soyad' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'     => true,
            ],
            'sifre' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'olusturulma_tarihi' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kullanicilar'); // Bu satır kesin olmalı
    }

public function down()
{
    $this->forge->dropTable('kullanicilar', true);
}



}
