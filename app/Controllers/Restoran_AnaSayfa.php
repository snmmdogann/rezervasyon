<?php

namespace App\Controllers;

use App\Models\RestoranModel;
use CodeIgniter\Controller;

class Restoran_AnaSayfa extends Controller
{
    public function index()
    {
        $restoranModel = new RestoranModel();
        $data['restoranlar'] = $restoranModel->findAll();

        return view('restoranlar_sayfasi', $data);
    }

    // Yönetici için restoran ekleme formu gösterme
    public function ekle()
    {
        $session = session();
        if ($session->get('yetki') !== 'yonetici') {
            return redirect()->to(base_url('siteanasayfa'))->with('hata', 'Bu işlemi yapmaya yetkiniz yok.');
        }
        return view('restoran_ekle_formu');
    }

    // Yönetici için kaydetme işlemi
    public function kaydet()
{
    $session = session();
    if ($session->get('yetki') !== 'yonetici') {
        return redirect()->to(base_url('siteanasayfa'))->with('hata', 'Bu işlemi yapmaya yetkiniz yok.');
    }

    $restoranModel = new \App\Models\RestoranModel();
    $resimYolu = null;

    // Resim yükleme işlemi
    $resim = $this->request->getFile('resim');
    if ($resim && $resim->isValid() && !$resim->hasMoved()) {
        $yeniIsim = $resim->getRandomName(); // Örn: af3e8dsf.jpg
        $uploadKlasoru = WRITEPATH . 'uploads'; // writable/uploads klasör yolu
        $resim->move($uploadKlasoru, $yeniIsim);

        $resimYolu =  $yeniIsim; // veritabanında saklayacağımız yol
    }

    $data = [
        'isim' => $this->request->getPost('isim'),
        'adres' => $this->request->getPost('adres'),
        'puan' => $this->request->getPost('puan'),
        'aciklama' => $this->request->getPost('aciklama'),
        'konum_linki' => $this->request->getPost('konum_linki'),
        'telefon' => $this->request->getPost('telefon'),
        'email' => $this->request->getPost('email'),
        'instagram' => $this->request->getPost('instagram'),
        'sehir' => $this->request->getPost('sehir'),
        'calisma_saatleri' => $this->request->getPost('calisma_saatleri'),
        'resim_yolu' => $resimYolu
    ];

    if ($restoranModel->insert($data)) {
        return redirect()->to(base_url('restoranlar'))->with('basarili', 'Restoran başarıyla eklendi.');
    } else {
        return redirect()->back()->with('hata', 'Restoran eklenirken bir hata oluştu.');
    }
}


  public function resimgoster($dosyaAdi)
    {
        $yol = WRITEPATH . 'uploads/' . $dosyaAdi;

        if (!is_file($yol)) {
            // Eğer dosya bulunamazsa, 404 hatası döndürün.
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Resim bulunamadı.");
        }

        // Dosya mime tipini alıp doğru Content-Type başlığı ile gönderiyoruz.
        $mime = mime_content_type($yol);
        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setBody(file_get_contents($yol));
    }
    // Yönetici için restoran silme işlemi
    public function sil($id)
    {
        $session = session();
        if ($session->get('yetki') !== 'yonetici') {
            return redirect()->to(base_url('siteanasayfa'))->with('hata', 'Bu işlemi yapmaya yetkiniz yok.');
        }

        $restoranModel = new RestoranModel();

        if ($restoranModel->delete($id)) {
            return redirect()->to(base_url('restoranlar'))->with('basarili', 'Restoran başarıyla silindi.');
        } else {
            return redirect()->back()->with('hata', 'Restoran silinemedi.');
        }
    }
}
