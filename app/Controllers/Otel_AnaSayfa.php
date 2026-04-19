<?php

namespace App\Controllers;

use App\Models\OtelModel;
use CodeIgniter\Controller;

class Otel_AnaSayfa extends Controller
{
    public function index()
    {
        $otelModel = new OtelModel();
        $data['oteller'] = $otelModel->findAll();

        return view('oteller_sayfasi', $data);
    }
    
    public function ekle()
    {
        $session = session();

        if ($session->get('yetki') !== 'yonetici') {
            return redirect()->to(base_url('siteanasayfa'))->with('hata', 'Bu işlemi yapmaya yetkiniz yok.');
        }

        return view('otel_ekle_formu');
    }

    public function sil($id)
    {
        $session = session();

        // Yalnızca yönetici silebilir
        if ($session->get('yetki') !== 'yonetici') {
            return redirect()->to(base_url('siteanasayfa'))->with('hata', 'Bu işlemi yapmaya yetkiniz yok.');
        }

        $otelModel = new \App\Models\OtelModel();

        if ($otelModel->delete($id)) {
            return redirect()->to(base_url('oteller'))->with('basarili', 'Otel başarıyla silindi.');

        } else {
            return redirect()->back()->with('hata', 'Otel silinemedi.');
        }
    }

    public function kaydet()
    {
        $session = session();

        if ($session->get('yetki') !== 'yonetici') {
            return redirect()->to(base_url('siteanasayfa'))->with('hata', 'Bu işlemi yapmaya yetkiniz yok.');
        }

        $otelModel = new OtelModel();
        $resimYolu = null; // Resim yolunu saklamak için bir değişken tanımlayın

        // 1. Resim yükleme işlemini burada yapın
        $resim = $this->request->getFile('resim');
        if ($resim && $resim->isValid() && !$resim->hasMoved()) {
            $yeniIsim = $resim->getRandomName(); // Dosyaya benzersiz bir ad verin
            $resim->move(WRITEPATH . 'uploads', $yeniIsim); // writable/uploads klasörüne taşıyın
            $resimYolu = $yeniIsim; // Veritabanına kaydedilecek dosya adını değişkene atayın
        }

        $data = [
            // 2. Yüklediğiniz resmin yolunu veritabanına ekleyin
            'resim_yolu' => $resimYolu, 
            'isim'       => $this->request->getPost('isim'),
            'adres'      => $this->request->getPost('adres'),
            'puan'       => $this->request->getPost('puan'),
            'aciklama'   => $this->request->getPost('aciklama'),
            'konum_linki' => $this->request->getPost('konum_linki'),
            'telefon'    => $this->request->getPost('telefon'),
            'email'      => $this->request->getPost('email'),
            'instagram'  => $this->request->getPost('instagram'),
            'sehir'      => $this->request->getPost('sehir'),
        ];

        if ($otelModel->insert($data)) {
            return redirect()->to(base_url('oteller'))->with('basarili', 'Otel başarıyla eklendi.');
        } else {
            // Hata durumunda, CodeIgniter'ın kendi hata mesajlarını da gösterebilirsiniz.
            return redirect()->back()->withInput()->with('hata', 'Otel eklenirken bir hata oluştu: ' . implode(', ', $otelModel->errors()));
        }
    }

    // Resim gösterme metodunu da ekleyin
    public function resimgoster($dosyaAdi)
    {
        $yol = WRITEPATH . 'uploads/' . $dosyaAdi;

        if (!is_file($yol)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Resim bulunamadı.");
        }

        $mime = mime_content_type($yol);
        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setBody(file_get_contents($yol));
    }
}