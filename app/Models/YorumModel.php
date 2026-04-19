<?php

namespace App\Models;

use CodeIgniter\Model;

class YorumModel extends Model
{
    protected $table = 'yorumlar';         // Veritabanındaki tablo adı
    protected $primaryKey = 'id';          // Birincil anahtar sütunu

    // Ekleme ve güncelleme yapılacak sütunlar
    protected $allowedFields = [
    'otel_id',
    'restoran_id',
    'kullanici_id',
    'yorum',
    'puan',
    'tarih',
];


    // Eğer created_at ve updated_at gibi otomatik zaman alanlarınız yoksa false yapın
    protected $useTimestamps = false;

    // Eğer kullanıyorsanız aşağıdaki alanları belirtin
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
} 