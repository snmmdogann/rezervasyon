<?php

namespace App\Controllers;

use App\Models\RezervasyonModel;
use App\Models\OtelModel;
use App\Models\RestoranModel;
use CodeIgniter\Controller;

class Rezervasyonlarim extends Controller
{
    public function index()
    {
        $kullaniciId = session()->get('kullanici_id');
        if (!$kullaniciId) {
            return redirect()->to(base_url('kullanici/giris'));
        }

        $rezervasyonModel = new RezervasyonModel();
        $otelModel = new OtelModel();
        $restoranModel = new RestoranModel();

        $rezervasyonlar = $rezervasyonModel
            ->where('kullanici_id', $kullaniciId)
            ->orderBy('tarih', 'DESC')
            ->findAll();

        // Mekan adlarını ekle
        foreach ($rezervasyonlar as &$rez) {
            if ($rez['rezervasyon_tipi'] === 'otel' && !empty($rez['otel_id'])) {
                $otel = $otelModel->find($rez['otel_id']);
                $rez['mekan_adi'] = $otel ? $otel['isim'] : 'Bilinmeyen Otel';
            } elseif ($rez['rezervasyon_tipi'] === 'restoran' && !empty($rez['restoran_id'])) {
                $restoran = $restoranModel->find($rez['restoran_id']);
                $rez['mekan_adi'] = $restoran ? $restoran['isim'] : 'Bilinmeyen Restoran';
            } else {
                $rez['mekan_adi'] = '-';
            }
        }

        return view('rezervasyonlarim', ['rezervasyonlar' => $rezervasyonlar]);
    }
}
