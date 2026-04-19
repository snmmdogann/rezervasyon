<?= $this->extend('layouts/main') ?>

<?= $this->section('style') ?>
<style>
    body {
        /* main layout zaten body ayarını yapıyor */
        background: linear-gradient(135deg, #f5f0e6, #cdbba9);
        color: #4e342e;
    }

    h1 {
        text-align: center;
        padding: 30px;
        color: #4e342e;
        text-shadow: 1px 1px 2px #a1887f;
    }

    .restoran-listesi {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        padding: 20px 40px;
    }

    .restoran-karti {
        background-color: #fff8f0;
        border-radius: 12px;
        box-shadow: 0 6px 14px rgba(101, 67, 33, 0.15);
        padding: 20px;
        width: 280px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .restoran-karti:hover {
        transform: scale(1.04);
        box-shadow: 0 12px 24px rgba(101, 67, 33, 0.25);
    }

    .restoran-isim {
        font-size: 22px;
        font-weight: 700;
        color: #6d4c41;
        margin-bottom: 8px;
        text-align: center;
    }

    .restoran-adres {
        color: #8d6e63;
        margin-bottom: 10px;
        font-style: italic;
        text-align: center;
    }

    .restoran-puan {
        color: #a9746e;
        font-weight: 600;
        text-align: center;
        margin-bottom: 15px;
    }

    .restoran-resim {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
        border: 1.5px solid #bcae9c;
    }

    /* Sil butonu */
    .sil-btn {
        background-color: #c62828;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s ease;
        font-family: 'Segoe UI', sans-serif;
        box-shadow: 0 2px 6px rgba(198, 40, 40, 0.6);
        display: block;
        margin: 0 auto;
    }

    .sil-btn:hover {
        background-color: #b71c1c;
        box-shadow: 0 4px 12px rgba(183, 28, 28, 0.8);
    }

    /* Restoran Ekle butonu */
    .restoran-ekle-btn {
        background-color: #6d4c41;
        color: white;
        padding: 12px 26px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
        display: inline-block;
        transition: background-color 0.3s ease;
        margin-bottom: 20px;
        text-align: center;
    }

    .restoran-ekle-btn:hover {
        background-color: #4b3621;
    }

    .ekle-container {
        text-align: center;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Restoranlar</h1>

<?php if (session()->get('yetki') === 'yonetici'): ?>
    <div class="ekle-container">
        <a href="<?= site_url('restoran/ekle') ?>" class="restoran-ekle-btn">
            + Restoran Ekle
        </a>
    </div>
<?php endif; ?>

<div class="restoran-listesi">
    <?php foreach ($restoranlar as $restoran): ?>
        <div class="restoran-karti">
            <a href="<?= site_url('restoran/detay/' . $restoran['id']) ?>" style="text-decoration: none; color: inherit;">
                <?php if (!empty($restoran['resim_yolu'])): ?>
                    <img src="<?= base_url('uploads/' . $restoran['resim_yolu']) ?>" alt="<?= esc($restoran['isim']) ?>" class="restoran-resim">
                <?php else: ?>
                    <img src="https://via.placeholder.com/300x180?text=Restoran+Resmi" class="restoran-resim" alt="Varsayılan Resim">
                <?php endif; ?>

                <div class="restoran-isim"><?= esc($restoran['isim']) ?></div>
                <div class="restoran-adres"><?= esc($restoran['adres']) ?></div>
                <div class="restoran-puan">Puan: <?= esc($restoran['puan']) ?></div>
            </a>

            <?php if (session()->get('yetki') === 'yonetici'): ?>
                <form action="<?= site_url('restoran/sil/' . $restoran['id']) ?>" method="post"
                      onsubmit="return confirm('Bu restoranı silmek istediğinizden emin misiniz?');"
                      style="margin-top: 10px;">
                    <?= csrf_field() ?>
                    <button type="submit" class="sil-btn">Sil</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
