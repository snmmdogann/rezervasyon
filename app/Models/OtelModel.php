<?php
namespace App\Models;

use CodeIgniter\Model;

class OtelModel extends Model
{
    protected $table = 'oteller';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'isim',
        'adres',
        'puan',
        'aciklama',
        'konum_linki',
        'telefon',
        'email',
        'instagram',
        'resim_yolu',
        'sehir'
    ];

    protected $useTimestamps = true;
}
