<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title><?= esc($title ?? 'Sayfa Başlığı') ?></title>
    <style>
        /* ORTAK CSS */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #fff7e6;
            padding-top: 56px; /* Menü yüksekliği kadar boşluk */
        }

        .menu {
            position: fixed; /* sabitle */
            top: 0; left: 0;
            width: 100%;
            background-color: #333;
            display: flex;
            justify-content: flex-start;
            padding: 15px 30px;
            box-sizing: border-box;
            z-index: 9999;
        }

        .menu a {
            color: white;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
            font-size: 16px;
        }

        .menu a:hover {
            text-decoration: underline;
        }
    </style>
    <?= $this->renderSection('style') ?>
</head>
<body>

    <!-- Üst Menü -->
    <nav class="menu">
        <a href="<?= base_url('profilim') ?>">Profilim</a>
        <a href="<?= base_url('rezervasyonlarim') ?>">Rezervasyonlarim</a>
        <a href="<?= base_url('iletisim') ?>">İletişim</a>
        <a href="<?= base_url('cikis') ?>">Çıkış</a>
    </nav>

    <!-- Sayfa İçeriği -->
    <?= $this->renderSection('content') ?>

</body>
</html>
