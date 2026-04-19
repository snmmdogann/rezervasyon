<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateIletisimMesajlari extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'ad_soyad' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false
            ],
            'konu' => [
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => false
            ],
            'mesaj' => [
                'type' => 'TEXT',
                'null' => false
            ],
            'tarih' => [
                'type' => 'DATETIME',
                'null' => false
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('iletisim_mesajlari');
    }

    public function down()
    {
        $this->forge->dropTable('iletisim_mesajlari');
    }
}
