<?php

namespace App\Models;

use CodeIgniter\Model;

class RestoranModel extends Model
{
    protected $table = 'restoranlar';
    protected $primaryKey = 'id';

    protected $allowedFields= [
    'isim',
    'adres',
    'puan',
    'aciklama',
    'konum_linki',
    'telefon',
    'email',
    'instagram',
    'sehir',
    'resim_yolu',
    'calisma_saatleri'
];


    protected $useTimestamps = true;
}
