<?php

namespace App\Models;

use CodeIgniter\Model;

class IletisimModel extends Model
{
    protected $table = 'iletisim_mesajlari';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ad_soyad', 'email', 'konu', 'mesaj', 'tarih'];
}
