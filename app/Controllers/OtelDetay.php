<?php

namespace App\Controllers;

use App\Models\OtelModel;
use App\Models\YorumModel;
use CodeIgniter\Controller;

class OtelDetay extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Otel ID belirtilmedi");
        }

        $otelModel = new OtelModel();
        $otel = $otelModel->find($id);
        if (!$otel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Otel bulunamadı");
        }

        $benzerOteller = $otelModel->where('sehir', $otel['sehir'])
                                   ->where('id !=', $id)
                                   ->findAll(4);

        $yorumModel = new YorumModel();
        $yorumlar = $yorumModel->where('otel_id', $id)->orderBy('tarih', 'DESC')->findAll();

        $data = [
            'otel' => $otel,
            'benzerOteller' => $benzerOteller,
            'yorumlar' => $yorumlar,
        ];

        return view('otel_detay', $data);
    }

    public function yorumEkle($id = null)
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(403)->setBody("Sadece AJAX isteklerine izin verilir.");
        }

        $yorumModel = new YorumModel();
        $yorumData = [
            'otel_id' => $id,
            'restoran_id' => null,
            'kullanici_id' => session()->get('kullanici_id') ?? null,
            'yorum' => $this->request->getPost('yorum'),
            'puan' => $this->request->getPost('puan'),
            'tarih' => date('Y-m-d H:i:s'),
        ];

        if (empty($yorumData['yorum']) || empty($yorumData['puan']) || $yorumData['puan'] < 1 || $yorumData['puan'] > 5) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Lütfen geçerli bir yorum ve puan giriniz (1-5 arasında).'
            ]);
        }

        $yorumModel->insert($yorumData);
        $yeniYorum = $yorumModel->orderBy('id', 'DESC')->first();

        return $this->response->setJSON([
            'status' => 'success',
            'yorum' => $yeniYorum,
        ]);
    }
}
