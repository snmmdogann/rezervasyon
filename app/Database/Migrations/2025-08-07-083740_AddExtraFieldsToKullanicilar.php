<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddExtraFieldsToKullanicilar extends Migration
{
    public function up()
    {
        $this->forge->addColumn('kullanicilar', [
            'telefon' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
                'after'      => 'email',
            ],
            'dogum_tarihi' => [
                'type' => 'DATE',
                'null' => true,
                'after' => 'telefon',
            ],
            'cinsiyet' => [
                'type'       => 'ENUM',
                'constraint' => ['Kadın', 'Erkek', 'Diğer'],
                'null'       => true,
                'after'      => 'dogum_tarihi',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('kullanicilar', ['telefon', 'dogum_tarihi', 'cinsiyet']);
    }
}
