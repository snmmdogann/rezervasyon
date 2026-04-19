<?php

namespace App\Controllers;

use App\Models\RestoranModel;
use App\Models\YorumModel;
use CodeIgniter\Controller;

class RestoranDetay extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Restoran ID belirtilmedi.");
        }

        $restoranModel = new RestoranModel();
        $yorumModel = new YorumModel();

        $restoran = $restoranModel->find($id);
        if (!$restoran) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Restoran bulunamadı.");
        }

        $yorumlar = $yorumModel
            ->where('restoran_id', $id)
            ->orderBy('tarih', 'DESC')
            ->findAll();

        $benzerRestoranlar = $restoranModel
            ->where('sehir', $restoran['sehir'])
            ->where('id !=', $id)
            ->limit(4)
            ->find();

        return view('restoran_detay', [
            'restoran' => $restoran,
            'yorumlar' => $yorumlar,
            'benzerRestoranlar' => $benzerRestoranlar
        ]);
    }

    // AJAX ile yorum ekleme
    
public function yorumEkle($id = null)
{
    if (!$this->request->isAJAX()) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Geçersiz istek.']);
    }

    if (!$id) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Restoran ID belirtilmedi.']);
    }

    $yorumModel = new YorumModel();

    $yorum = trim($this->request->getPost('yorum'));
    $puan = (int) $this->request->getPost('puan');

    if ($yorum === '' || $puan < 1 || $puan > 5) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Yorum veya puan geçersiz (1-5 arası puan girin).']);
    }

    $yorumData = [
        'restoran_id' => $id,
        'otel_id' => null,
        'kullanici_id' => session()->get('kullanici_id') ?? null,
        'yorum' => $yorum,
        'puan' => $puan,
        'tarih' => date('Y-m-d H:i:s'),
    ];

    $insertId = $yorumModel->insert($yorumData);

    if ($insertId) {
        $yeniYorum = $yorumModel->find($insertId);
        return $this->response->setJSON(['status' => 'success', 'yorum' => $yeniYorum]);
    } else {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Yorum eklenirken bir hata oluştu.']);
    }
}
}