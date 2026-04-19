<?php

namespace App\Controllers;

use App\Models\RezervasyonModel;
use CodeIgniter\Controller;

class Rezervasyon extends Controller
{
    // GET: Formu göster
    public function formGoster($tip = null, $mekan_id = null)
    {
        if (!in_array($tip, ['otel', 'restoran']) || !$mekan_id) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Geçersiz rezervasyon türü veya mekan ID.');
        }


        return view('rezervasyonform', [
            'tip' => $tip,
            'mekan_id' => $mekan_id,
            'validation' => null
        ]);
    }

    // POST: Formu işle ve veritabanına kaydet
   public function formIsle($tip = null, $mekan_id = null)
{
    helper(['form', 'url']);

    if (!in_array($tip, ['otel', 'restoran']) || !$mekan_id) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Geçersiz rezervasyon türü veya mekan ID.');
    }

    $kurallar = [
        'tarih' => 'required|valid_date[Y-m-d]',
    ];

    if ($tip === 'restoran') {
        $kurallar['saat'] = 'required';
        $kurallar['kisi_sayisi'] = 'required|integer|greater_than[0]|less_than_equal_to[20]';
    } else if ($tip === 'otel') {
        $kurallar['gece_sayisi'] = 'required|integer|greater_than[0]|less_than_equal_to[30]';
    }

    if (!$this->validate($kurallar)) {
        return view('rezervasyonform', [
            'validation' => $this->validator,
            'tip' => $tip,
            'mekan_id' => $mekan_id,
        ]);
    }

    $rezervasyonModel = new RezervasyonModel();

    $kullaniciId = session()->get('kullanici_id');  // Doğru session anahtarı kullanılıyor

    $data = [
        'kullanici_id' => $kullaniciId,  // Burada da doğru anahtar kullan
        'rezervasyon_tipi' => $tip,
        'tarih' => $this->request->getPost('tarih'),
    ];

    if ($tip === 'restoran') {
        $data['restoran_id'] = $mekan_id;
        $data['saat'] = $this->request->getPost('saat');
        $data['kisi_sayisi'] = $this->request->getPost('kisi_sayisi');
    } else {
        $data['otel_id'] = $mekan_id;
        $data['gece_sayisi'] = $this->request->getPost('gece_sayisi');
    }
if (!$rezervasyonModel->save($data)) {
    return view('rezervasyonform', [
        'tip' => $tip,
        'mekan_id' => $mekan_id,
        'validation' => $this->validator,
        'error' => 'Rezervasyon kaydedilemedi.',
    ]);
}

// Rezervasyon başarılı ise:
echo "<script>
        alert('Rezervasyon başarıyla oluşturuldu!');
        window.location.href = '".base_url('siteanasayfa')."';
      </script>";
exit;

}
}
