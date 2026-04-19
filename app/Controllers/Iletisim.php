<?php

namespace App\Controllers;

use App\Models\IletisimModel;
use CodeIgniter\Controller;

class Iletisim extends Controller
{
    public function index()
    {
        return view('iletisim');
    }

    public function gonder()
    {
        helper(['form']);

        $data = [
            'ad_soyad' => $this->request->getPost('ad_soyad'),
            'email'    => $this->request->getPost('email'),
            'konu'     => $this->request->getPost('konu'),
            'mesaj'    => $this->request->getPost('mesaj'),
            'tarih'    => date('Y-m-d H:i:s')
        ];

        $model = new IletisimModel();
        $model->insert($data);

        return redirect()->to('/iletisim')->with('success', 'Mesajınız başarıyla gönderildi.');
    }
}
