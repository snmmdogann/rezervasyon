<?php
namespace App\Controllers;

use App\Models\KullaniciModel;
use App\Models\YorumModel;
use App\Models\OtelModel;
use App\Models\RestoranModel;
use CodeIgniter\Controller;

class Profilim extends Controller
{
    public function index()
    {
        $session = session();
        $kullaniciId = $session->get('kullanici_id');

        $kullaniciModel = new KullaniciModel();
        $yorumModel = new YorumModel();
        $otelModel = new OtelModel();
        $restoranModel = new RestoranModel();

        // Kullanıcı bilgisi
        $data['kullanici'] = $kullaniciModel->find($kullaniciId);

        // Kullanıcının yorumları
        $yorumlar = $yorumModel
            ->where('kullanici_id', $kullaniciId)
            ->orderBy('tarih', 'DESC')
            ->findAll();

        // Otel ve Restoran isimlerini ekleyelim
        foreach ($yorumlar as &$yorum) {
            $yorum['mekan_adi'] = null;
            if (!empty($yorum['otel_id'])) {
                $otel = $otelModel->find($yorum['otel_id']);
                $yorum['mekan_adi'] = $otel ? $otel['isim'] : 'Bilinmeyen Otel';
                $yorum['mekan_tipi'] = 'Otel';
            } elseif (!empty($yorum['restoran_id'])) {
                $restoran = $restoranModel->find($yorum['restoran_id']);
                $yorum['mekan_adi'] = $restoran ? $restoran['isim'] : 'Bilinmeyen Restoran';
                $yorum['mekan_tipi'] = 'Restoran';
            } else {
                $yorum['mekan_adi'] = 'Bilinmeyen Mekan';
                $yorum['mekan_tipi'] = '';
            }
        }

        $data['yorumlar'] = $yorumlar;
        

        return view('profilim', $data);
    }

public function yorumSil($yorumId)
{
    if ($this->request->getMethod() !== 'POST') {
        return $this->response->setStatusCode(405)->setJSON(['error' => 'Geçersiz istek metodu.']);
    }

    $session = session();
    $kullaniciId = $session->get('kullanici_id');

    if (!$kullaniciId) {
        return $this->response->setStatusCode(401)->setJSON(['error' => 'Giriş yapmanız gerekiyor.']);
    }

    $yorumModel = new \App\Models\YorumModel();
    $yorum = $yorumModel->find($yorumId);

    if (!$yorum || $yorum['kullanici_id'] != $kullaniciId) {
        return $this->response->setStatusCode(403)->setJSON(['error' => 'Bu yorumu silmeye yetkiniz yok.']);
    }

    $yorumModel->delete($yorumId);

    return $this->response->setJSON(['success' => 'Yorum başarıyla silindi.']);
}

}