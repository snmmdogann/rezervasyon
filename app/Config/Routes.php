<?php

namespace Config;

use App\Controllers\Restoran_AnaSayfa;
use CodeIgniter\Router\RouteCollection;

$routes = Services::routes();
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Kullanici::index');              // Ana sayfa = giriş formu
$routes->get('kullanici/kayitFormu', 'Kullanici::kayitFormu'); // Kayıt formu
$routes->post('kullanici/kaydet', 'Kullanici::kaydet');       // Kayıt işlemi
$routes->post('kullanici/giris', 'Kullanici::giris');         // Giriş işlemi
$routes->get('siteanasayfa', 'SiteAnaSayfa::index');
$routes->get('oteller', 'Otel_AnaSayfa::index');
$routes->get('restoranlar', 'Restoran_AnaSayfa::index');

$routes->get('otel/detay/(:num)', 'OtelDetay::index/$1');
$routes->post('otel/detay/(:num)', 'OtelDetay::index/$1');
$routes->post('oteldetay/yorum-ekle/(:num)', 'OtelDetay::yorumEkle/$1');

$routes->get('restoran/detay/(:num)', 'RestoranDetay::index/$1');
$routes->post('restoran/detay/(:num)', 'RestoranDetay::index/$1');
$routes->post('restorandetay/yorum-ekle/(:num)', 'RestoranDetay::yorumEkle/$1');



$routes->get('rezervasyon/yap/(:segment)/(:num)', 'Rezervasyon::formGoster/$1/$2');


$routes->post('rezervasyon/yap/(:segment)/(:num)', 'Rezervasyon::formIsle/$1/$2');



$routes->get('profilim', 'Profilim::index');
$routes->get('rezervasyonlarim', 'Rezervasyonlarim::index');
$routes->get('iletisim', 'Iletisim::index');

$routes->get('cikis', 'Cikis::index');

$routes->get('profil_duzenle', 'ProfilDuzenle::index');
$routes->post('profil_duzenle/guncelle', 'ProfilDuzenle::guncelle');

$routes->get('sifre_degistir', 'SifreDegistir::index');
$routes->post('sifre_degistir/guncelle', 'SifreDegistir::guncelle');


//$routes->get('profilim/yorumSil/(:num)', 'Profilim::yorumSil/$1');


$routes->get('iletisim', 'Iletisim::index');
$routes->post('iletisim/gonder', 'Iletisim::gonder');

$routes->POST('profilim/yorumSil/(:num)', 'Profilim::yorumSil/$1');

$routes->post('otel/sil/(:num)', 'Otel_AnaSayfa::sil/$1');
$routes->get('otel/ekle', 'Otel_AnaSayfa::ekle');
$routes->post('otel/kaydet', 'Otel_AnaSayfa::kaydet'); 
$routes->post('otel/ekle', 'Otel_AnaSayfa::kaydet');

$routes->get('restoran/ekle', 'Restoran_AnaSayfa::ekle');
$routes->POST('restoran/ekle', 'Restoran_AnaSayfa::kaydet');
$routes->post('restoran/sil/(:num)', 'Restoran_AnaSayfa::sil/$1');
$routes->post('restoran/kaydet', 'Restoran_AnaSayfa::kaydet');

$routes->get('resim/(:any)', 'ResimGoster::goster/$1');
$routes->get('goster/(:segment)', 'Restoran_AnaSayfa::goster/$1');

$routes->get('uploads/(:any)', 'Restoran_AnaSayfa::resimgoster/$1');
$routes->get('uploads/(:any)', 'Restoran_AnaSayfa::resimgoster/$1');

// Otel resimlerini göstermek için rota
$routes->get('uploads/(:any)', 'Otel_AnaSayfa::resimgoster/$1');









