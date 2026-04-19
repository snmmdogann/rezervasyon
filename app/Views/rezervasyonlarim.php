<?= $this->extend('layouts/main') ?>

<?= $this->section('style') ?>
<style>
    body {
        /* body ve genel stil main layoutta zaten var,
           ama rezervasyonlar sayfası özel stiller için buraya ekliyoruz */
        max-width: 900px;
        margin: 40px auto;
        padding: 20px;
        border-radius: 12px;
        background: #fff8ed;
        color: #4b3621;
    }

    h1 {
        text-align: center;
        margin-bottom: 30px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    th, td {
        padding: 14px 20px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    th {
        background-color: #6d4c41;
        color: white;
    }

    tr:hover {
        background-color: #f0e6dc;
    }

    .no-data {
        text-align: center;
        padding: 40px 0;
        font-size: 18px;
        color: #999;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1>Rezervasyonlarım</h1>

<?php if (!empty($rezervasyonlar)): ?>
<table>
    <thead>
        <tr>
            <th>Tip</th>
            <th>Mekan</th>
            <th>Tarih</th>
            <th>Saat</th>
            <th>Kişi Sayısı</th>
            <th>Gece Sayısı</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rezervasyonlar as $rez): ?>
            <tr>
                <td><?= esc($rez['rezervasyon_tipi']) ?></td>
                <td><?= esc($rez['mekan_adi'] ?? '-') ?></td>
                <td><?= esc($rez['tarih']) ?></td>
                <td><?= esc($rez['saat'] ?? '-') ?></td>
                <td><?= esc($rez['kisi_sayisi'] ?? '-') ?></td>
                <td><?= esc($rez['gece_sayisi'] ?? '-') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <p class="no-data">Henüz bir rezervasyonunuz bulunmamaktadır.</p>
<?php endif; ?>

<?= $this->endSection() ?>
