<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddYetkiToKullanicilar extends Migration
{
    public function up()
    {
        $this->forge->addColumn('kullanicilar', [
            'yetki' => [
                'type'       => 'ENUM',
                'constraint' => ['kullanici', 'yonetici'],
                'default'    => 'kullanici',
                'after'      => 'cinsiyet' // cinsiyet'ten sonra eklenir
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('kullanicilar', 'yetki');
    }
}
