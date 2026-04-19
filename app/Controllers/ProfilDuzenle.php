<?php
namespace App\Controllers;

use App\Models\KullaniciModel;
use CodeIgniter\Controller;

class ProfilDuzenle extends Controller
{
    public function index()
    {
        $kullaniciId = session()->get('kullanici_id');
        if (!$kullaniciId) {
            return redirect()->to(base_url('kullanici/giris'));
        }

        $model = new KullaniciModel();
        $kullanici = $model->find($kullaniciId);

        if (!$kullanici) {
            return redirect()->to(base_url('kullanici/giris'));
        }

        $data['kullanici'] = $kullanici;
        $data['validation'] = \Config\Services::validation();

        return view('profil_duzenle', $data);
    }

    public function guncelle()
    {
        $kullaniciId = session()->get('kullanici_id');
        if (!$kullaniciId) {
            return redirect()->to(base_url('kullanici/giris'));
        }

        $model = new KullaniciModel();
        
        // Kullanıcı ID'sini kullanarak geçerli e-posta adresini al
        $currentKullanici = $model->find($kullaniciId);
        $currentEmail = $currentKullanici['email'] ?? '';

        // Modelinde tanımlı olan kuralları kullan
        $kurallar = [
            'ad_soyad' => 'required|min_length[3]',
            'email'    => 'required|valid_email',
            'telefon'  => 'permit_empty|max_length[20]',
            'dogum_tarihi' => 'permit_empty|valid_date',
            'cinsiyet' => 'permit_empty|in_list[Kadın,Erkek,Diğer]',
        ];

        // Eğer e-posta adresi değiştiyse, benzersizlik kontrolü yap
        if ($this->request->getPost('email') !== $currentEmail) {
            // is_unique kuralında 'kullanicilar' tablosunu kullanıyoruz
            $kurallar['email'] .= '|is_unique[kullanicilar.email]';
        }

        if (!$this->validate($kurallar)) {
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->back()->withInput();
        }

        // Doğrulama başarılıysa veritabanını güncelle
        $guncelVeri = [
            'ad_soyad' => $this->request->getPost('ad_soyad'),
            'email'    => $this->request->getPost('email'),
            'telefon'  => $this->request->getPost('telefon'),
            'dogum_tarihi' => $this->request->getPost('dogum_tarihi'),
            'cinsiyet' => $this->request->getPost('cinsiyet'),
        ];
        
        // Update metodu doğru çalışmalı çünkü modeldeki primaryKey 'id'
        // ve session'daki ID'yi kullanıyoruz
        $model->update($kullaniciId, $guncelVeri);
        
        session()->setFlashdata('basarili', 'Profiliniz başarıyla güncellendi. ✅');
        return redirect()->to(base_url('profilim'));
    }
}