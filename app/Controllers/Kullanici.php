<?php

namespace App\Controllers;

use App\Models\KullaniciModel;

class Kullanici extends BaseController
{
    // Giriş formu göster
    public function index()
    {
        return view('kullanici_giris');
    }

    // Giriş işlemi
    public function giris()
    {
        $email = $this->request->getPost('email');
        $sifre = $this->request->getPost('sifre');

        $model = new KullaniciModel();
        $kullanici = $model->where('email', $email)->first();

        if ($kullanici && password_verify($sifre, $kullanici['sifre'])) {
            session()->set([
                'kullanici_id' => $kullanici['id'],
                'ad_soyad'     => $kullanici['ad_soyad'],
                'yetki'        => $kullanici['yetki'], // 👈 YETKİ EKLENDİ
            ]);
            return redirect()->to(base_url('siteanasayfa'));
        } else {
            return redirect()->back()->with('hata', 'Email veya şifre hatalı.');
        }
    }

    // Kayıt formu göster
    public function kayitFormu()
    {
        return view('kullanici_kayit');
    }

    // Kayıt işlemi
    public function kaydet()
    {
        $model = new KullaniciModel();

        $data = [
            'ad_soyad' => $this->request->getPost('ad_soyad'),
            'email'    => $this->request->getPost('email'),
            'sifre'    => password_hash($this->request->getPost('sifre'), PASSWORD_DEFAULT),
            'yetki'    => 'kullanici', // 👈 Yeni kullanıcılar için varsayılan yetki
            'olusturulma_tarihi' => date('Y-m-d H:i:s'),
        ];


        if ($model->insert($data)) {
            return redirect()->to(base_url('siteanasayfa'))->with('basarili', 'Kayıt başarılı!');
        } else {
            $errors = $model->errors();

            return view('kullanici_kayit', [
                'errors' => $errors,
                'old' => $this->request->getPost()
            ]);
        }
    }
}
