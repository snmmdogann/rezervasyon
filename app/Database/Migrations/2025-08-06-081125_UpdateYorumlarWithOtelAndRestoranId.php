<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateYorumlarWithOtelAndRestoranId extends Migration
{
    public function up()
    {
        // Eğer restoran_id yoksa ekle
        if (! $this->db->fieldExists('restoran_id', 'yorumlar')) {
            $this->forge->addColumn('yorumlar', [
                'restoran_id' => [
                    'type'       => 'INT',
                    'unsigned'   => true,
                    'null'       => true, // opsiyonel çünkü her yorum restoranla ilgili olmayabilir
                    'after'      => 'id'
                ]
            ]);
        }

        // Eğer otel_id yoksa ekle
        if (! $this->db->fieldExists('otel_id', 'yorumlar')) {
            $this->forge->addColumn('yorumlar', [
                'otel_id' => [
                    'type'       => 'INT',
                    'unsigned'   => true,
                    'null'       => true,
                    'after'      => 'restoran_id'
                ]
            ]);
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('restoran_id', 'yorumlar')) {
            $this->forge->dropColumn('yorumlar', 'restoran_id');
        }

        if ($this->db->fieldExists('otel_id', 'yorumlar')) {
            $this->forge->dropColumn('yorumlar', 'otel_id');
        }
    }
}
