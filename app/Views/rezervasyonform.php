<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Rezervasyon Yap (<?= esc($tip) ?>)</title>
    <style>
        /* Basit form stili */
        body { font-family: 'Segoe UI', sans-serif; background:#f9f7f4; color:#4b3621; padding:20px;}
        form { background:#fff; padding:20px; border-radius:10px; max-width:400px; margin:auto; box-shadow: 0 4px 8px rgba(0,0,0,0.1);}
        label { font-weight: 600; display:block; margin-top:15px; }
        input, select { width: 100%; padding:8px; margin-top:6px; border:1.5px solid #a1887f; border-radius:6px; }
        button { margin-top: 20px; background:#6d4c41; color:#fff; border:none; padding:12px; border-radius:8px; font-weight:700; cursor:pointer;}
        button:hover { background:#4e342e; }
        .error { background:#ef9a9a; color:#b71c1c; padding:10px; border-radius:8px; margin-top:10px;}
    </style>
</head>
<body>

<h1>Rezervasyon Yap (<?= esc($tip) ?>)</h1>

<?php if (isset($validation) && $validation->getErrors()): ?>
    <div class="error">
        <ul>
            <?php foreach ($validation->getErrors() as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?= base_url('rezervasyon/yap/' . $tip . '/' . $mekan_id) ?>" method="post" novalidate>
    <?= csrf_field() ?>

    <label for="tarih">Tarih:</label>
    <input type="date" id="tarih" name="tarih" required min="<?= date('Y-m-d') ?>" value="<?= set_value('tarih') ?>">

    <?php if ($tip === 'restoran'): ?>
        <label for="saat">Saat:</label>
        <input type="time" id="saat" name="saat" required value="<?= set_value('saat') ?>">

        <label for="kisi_sayisi">Kişi Sayısı:</label>
        <input type="number" id="kisi_sayisi" name="kisi_sayisi" min="1" max="20" required value="<?= set_value('kisi_sayisi', 1) ?>">
    <?php else: ?>
        <label for="gece_sayisi">Gece Sayısı:</label>
        <input type="number" id="gece_sayisi" name="gece_sayisi" min="1" max="30" required value="<?= set_value('gece_sayisi', 1) ?>">
    <?php endif; ?>

    <button type="submit">Rezervasyon Yap</button>
</form>

</body>
</html>
