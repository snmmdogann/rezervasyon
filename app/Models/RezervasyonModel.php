<?php

namespace App\Models;

use CodeIgniter\Model;

class RezervasyonModel extends Model
{
    protected $table = 'rezervasyonlar';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'kullanici_id',
        'rezervasyon_tipi',
        'otel_id',
        'restoran_id',
        'tarih',
        'saat',
        'kisi_sayisi',
        'gece_sayisi',
    ];

    protected $useTimestamps = false;
}
