# Rezervasyon Sistemi

Bu proje, kullanıcıların otel ve restoran bilgilerini görüntüleyebildiği, rezervasyon işlemleri yapabildiği ve sistem üzerinden temel kullanıcı işlemlerini gerçekleştirebildiği bir web tabanlı rezervasyon uygulamasıdır.

Proje, PHP tabanlı **CodeIgniter 4** framework'ü kullanılarak geliştirilmiştir. Veritabanı işlemleri **MySQL** ile yürütülmektedir. Uygulama yerel sunucuda **XAMPP** ortamında çalıştırılmıştır.

## Proje Amacı

Bu projenin amacı, kullanıcıların tek bir platform üzerinden:

- kayıt olabilmesi,
- sisteme giriş yapabilmesi,
- otel ve restoranları görüntüleyebilmesi,
- rezervasyon işlemi yapabilmesi,
- yorum ve iletişim gibi temel işlemleri gerçekleştirebilmesi

için işlevsel bir rezervasyon sistemi sunmaktır.

## Kullanılan Teknolojiler

- **PHP**
- **CodeIgniter 4**
- **MySQL**
- **HTML**
- **CSS**
- **JavaScript**
- **XAMPP**
- **Git & GitHub**

## Proje Özellikleri

- Kullanıcı kayıt olma
- Kullanıcı giriş yapma
- Otel listeleme
- Restoran listeleme
- Rezervasyon oluşturma
- Yorum yapısı
- İletişim mesajları gönderme
- Veritabanı bağlantısı ile dinamik veri yönetimi

## Proje Klasör Yapısı

bash
rezervasyon/
│
├── app/                # Controller, Model, View ve uygulama dosyaları
├── public/             # Uygulamanın giriş noktası
├── system/             # CodeIgniter sistem dosyaları
├── tests/              # Test klasörü
├── writable/           # Cache, log ve geçici dosyalar
├── .gitignore          # Git tarafından izlenmeyecek dosyalar
├── composer.json       # Composer bağımlılıkları
├── spark               # CodeIgniter CLI aracı
└── README.md           # Proje açıklama dosyası
Kurulum Adımları

Projeyi kendi bilgisayarınızda çalıştırmak için aşağıdaki adımları izleyin.

1. Projeyi klonlayın
git clone https://github.com/snnmdogann/rezervasyon.git
2. Proje klasörüne girin
cd rezervasyon
3. Composer bağımlılıklarını yükleyin
composer install
4. .env dosyasını oluşturun

Projede .env dosyası GitHub’a yüklenmemiştir. Güvenlik nedeniyle bu dosyayı kendiniz oluşturmalısınız.

Örnek veritabanı ayarları:

CI_ENVIRONMENT = development
app.baseURL = 'http://localhost/rezervasyon/public'

database.default.hostname = localhost
database.default.database = rezervasyon_db
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306
5. Veritabanını oluşturun

phpMyAdmin üzerinden şu isimle bir veritabanı oluşturun:

rezervasyon_db
6. Migration çalıştırın
php spark migrate
7. Uygulamayı çalıştırın

XAMPP üzerinde Apache ve MySQL servislerini başlatın.

Tarayıcıdan şu adresi açın:

http://localhost/rezervasyon/public
Veritabanı Tabloları

Projede yer alan temel tablolar şunlardır:

kullanicilar
oteller
restoranlar
rezervasyonlar
yorumlar
iletisim_mesajlari
migrations

Bu tablolar sistemin kullanıcı, rezervasyon ve içerik yönetimi işlemlerini gerçekleştirmek için kullanılmaktadır.

Kullanım Senaryosu
Kullanıcı sisteme kayıt olur.
Kayıtlı kullanıcı giriş yapar.
Otel ve restoran listelerini görüntüler.
İlgili rezervasyon işlemlerini yapar.
Gerekirse yorum bırakır veya iletişim formu üzerinden mesaj gönderir.
Güvenlik Notu

Bu projede .env dosyası güvenlik nedeniyle GitHub reposuna dahil edilmemiştir. Veritabanı bağlantı bilgileri gibi hassas veriler bu dosyada tutulmalıdır.

Geliştirici

Sinem DOĞAN

GitHub: snmmdogann

Lisans

Bu proje eğitim amaçlı geliştirilmiştir.
