<?php

namespace App\Models;

use CodeIgniter\Model;

class KullaniciModel extends Model
{
    protected $table      = 'kullanicilar'; // Tablo adı
    protected $primaryKey = 'id';            // Birincil anahtar

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';     // Veya 'object' olarak da kullanabilirsin
    protected $useSoftDeletes = false;

  protected $allowedFields = [
    'ad_soyad',
    'email',
    'sifre',
    'telefon',
    'dogum_tarihi',
    'cinsiyet',
    'yetki',
    'olusturulma_tarihi'
];
    protected $useTimestamps = false;        // created_at, updated_at gibi otomatik zamanları kullanmıyorsan false

    // İstersen burada otomatik doğrulama kuralları da tanımlayabilirsin
    protected $validationRules = [
        'ad_soyad' => 'required|min_length[3]',
        'email'    => 'required|valid_email|is_unique[kullanicilar.email]',
        'sifre'    => 'required|min_length[6]'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Bu e-posta adresi zaten kayıtlı.',
        ],
    ];

    protected $skipValidation = false;
}
