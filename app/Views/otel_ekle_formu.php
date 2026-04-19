<?php helper('form'); ?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8" />
    <title>Otel Ekle</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f3ece5;
            color: #4e342e;
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 6px 14px rgba(101, 67, 33, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
        }

        input[type="text"],
        input[type="email"],
        input[type="url"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #a1887f;
            border-radius: 6px;
            margin-top: 5px;
            font-size: 1rem;
            color: #4e342e;
        }

        textarea {
            resize: vertical;
            min-height: 80px;
        }

        .btn {
            margin-top: 25px;
            width: 100%;
            background-color: #6d4c41;
            color: white;
            padding: 12px 0;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #4b3621;
        }

        .error {
            color: #b71c1c;
            font-size: 0.9rem;
            margin-top: 4px;
        }
    </style>
</head>

<body>

    <h2>Yeni Otel Ekle</h2>

    <?php if (!empty(session()->getFlashdata('hata'))): ?>
        <div class="error"><?= session()->getFlashdata('hata') ?></div>
    <?php endif; ?>

    <form action="<?= site_url('otel/kaydet') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <label for="resim">Otel Resmi</label>
        <input type="file" name="resim" id="resim" required>

        <label for="isim">Otel İsmi</label>
        <input type="text" name="isim" id="isim" value="<?= set_value('isim') ?>" required>

        <label for="adres">Adres</label>
        <textarea name="adres" id="adres" required><?= set_value('adres') ?></textarea>

        <label for="puan">Puan (0-10)</label>
        <input type="number" name="puan" id="puan" min="0" max="10" step="0.1" value="<?= set_value('puan') ?>" required>

        <label for="aciklama">Açıklama</label>
        <textarea name="aciklama" id="aciklama"><?= set_value('aciklama') ?></textarea>

        <label for="konum_linki">Konum Linki (URL)</label>
        <input type="url" name="konum_linki" id="konum_linki" value="<?= set_value('konum_linki') ?>">

        <label for="telefon">Telefon</label>
        <input type="text" name="telefon" id="telefon" value="<?= set_value('telefon') ?>">

        <label for="email">E-posta</label>
        <input type="email" name="email" id="email" value="<?= set_value('email') ?>">

        <label for="instagram">Instagram</label>
        <input type="text" name="instagram" id="instagram" value="<?= set_value('instagram') ?>">

        <label for="sehir">Şehir</label>
        <input type="text" name="sehir" id="sehir" value="<?= set_value('sehir') ?>">

        <button type="submit" class="btn">Kaydet</button>
    </form>

</body>

</html>
