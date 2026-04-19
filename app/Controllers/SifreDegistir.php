<?php

namespace App\Controllers;

use App\Models\KullaniciModel;
use CodeIgniter\Controller;

class SifreDegistir extends Controller
{
    public function index()
    {
        // Şifre değiştirme formunu göster
        return view('sifre_degistir');
    }

    public function guncelle()
    {
        $session = session();
        $kullaniciId = $session->get('kullanici_id');

        if (!$kullaniciId) {
            // Oturum yoksa giriş sayfasına yönlendir
            return redirect()->to(base_url('/'));
        }

        $kullaniciModel = new KullaniciModel();
        $kullanici = $kullaniciModel->find($kullaniciId);

        if (!$kullanici) {
            return redirect()->to(base_url('/'))->with('error', 'Kullanıcı bulunamadı.');
        }

        $eskiSifre = $this->request->getPost('eski_sifre');
        $yeniSifre = $this->request->getPost('yeni_sifre');
        $sifreTekrar = $this->request->getPost('sifre_tekrar');

        // Eski şifre doğru mu kontrol et
        if (!password_verify($eskiSifre, $kullanici['sifre'])) {
            return redirect()->back()->with('error', 'Eski şifre yanlış!');
        }

        // Yeni şifreler eşleşiyor mu kontrol et
        if ($yeniSifre !== $sifreTekrar) {
            return redirect()->back()->with('error', 'Yeni şifreler uyuşmuyor!');
        }

        // Yeni şifre en az 6 karakter mi kontrolü (isteğe bağlı)
        if (strlen($yeniSifre) < 6) {
            return redirect()->back()->with('error', 'Yeni şifre en az 6 karakter olmalıdır.');
        }

        // Şifreyi güncelle
        $kullaniciModel->update($kullaniciId, [
            'sifre' => password_hash($yeniSifre, PASSWORD_DEFAULT)
        ]);

        return redirect()->to(base_url('profilim'))->with('success', 'Şifre başarıyla güncellendi.');
    }
}
