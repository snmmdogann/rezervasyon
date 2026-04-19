<?= $this->extend('layouts/main') ?>

<?= $this->section('style') ?>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', sans-serif;
        background: linear-gradient(135deg, #f5f0e6, #cdbba9);
        color: #4e342e;
    }

    h1 {
        text-align: center;
        padding: 30px;
        color: #4e342e;
        text-shadow: 1px 1px 2px #a1887f;
    }

    .otel-listesi {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
        padding: 20px 40px;
    }

    .otel-karti {
        background-color: #fff8f0;
        border-radius: 12px;
        box-shadow: 0 6px 14px rgba(101, 67, 33, 0.15);
        padding: 20px;
        width: 280px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .otel-karti:hover {
        transform: scale(1.04);
        box-shadow: 0 12px 24px rgba(101, 67, 33, 0.25);
    }

    .otel-isim {
        font-size: 22px;
        font-weight: 700;
        color: #6d4c41;
        margin-bottom: 8px;
        text-align: center;
    }

    .otel-adres {
        color: #8d6e63;
        margin-bottom: 10px;
        font-style: italic;
        text-align: center;
    }

    .otel-puan {
        color: #a9746e;
        font-weight: 600;
        text-align: center;
        margin-bottom: 15px;
    }

    .otel-resim {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 15px;
        border: 1.5px solid #bcae9c;
    }

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

    .otel-ekle-btn {
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

    .otel-ekle-btn:hover {
        background-color: #4b3621;
    }

    .ekle-container {
        text-align: center;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h1>Oteller</h1>

<?php if (session()->get('yetki') === 'yonetici'): ?>
    <div class="ekle-container">
        <a href="<?= site_url('otel/ekle') ?>" class="otel-ekle-btn">
            + Otel Ekle
        </a>
    </div>
<?php endif; ?>

<div class="otel-listesi">
    <?php foreach ($oteller as $otel): ?>
        <div class="otel-karti">
            <a href="<?= site_url('otel/detay/' . $otel['id']) ?>" style="text-decoration: none; color: inherit;">
                <?php if (!empty($otel['resim_yolu'])): ?>
                    <img src="<?= base_url('uploads/' . $otel['resim_yolu']) ?>" class="otel-resim" alt="<?= esc($otel['isim']) ?>">
                <?php else: ?>
                    <img src="https://via.placeholder.com/300x180?text=Otel+Resmi" class="otel-resim" alt="Varsayılan Resim">
                <?php endif; ?>

                <div class="otel-isim"><?= esc($otel['isim']) ?></div>
                <div class="otel-adres"><?= esc($otel['adres']) ?></div>
                <div class="otel-puan">Puan: <?= esc($otel['puan']) ?></div>
            </a>

            <?php if (session()->get('yetki') === 'yonetici'): ?>
                <form action="<?= site_url('otel/sil/' . $otel['id']) ?>" method="post"
                      onsubmit="return confirm('Bu oteli silmek istediğinizden emin misiniz?');"
                      style="margin-top: 10px;">
                    <button type="submit" class="sil-btn">Sil</button>
                </form>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</div>
<?= $this->endSection() ?>
