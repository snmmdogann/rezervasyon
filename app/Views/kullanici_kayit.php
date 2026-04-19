<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />  
    <title>Kullanıcı Kayıt</title>  
    <style>
        /* Genel sayfa ayarları */
        body, html {
            margin: 0; padding: 0;
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #d7ccc8, #a1887f);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 400px;
            max-width: 90vw;
            background: rgba(255, 255, 255, 0.9);
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            color: #5d4037;
        }

        h1, h2 {
            text-align: center;
            margin: 0 0 25px 0;
            color: #5d4037;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #4e342e;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"],
        input[type="date"],
        select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1.5px solid #bcaaa4;
            border-radius: 6px;
            font-size: 15px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="tel"]:focus,
        input[type="date"]:focus,
        select:focus {
            border-color: #6d4c41;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #6d4c41;
            color: white;
            padding: 14px;
            font-size: 16px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #5d4037;
        }

        .success {
            color: #388e3c;
            margin-bottom: 15px;
            text-align: center;
            font-weight: 600;
        }

        .error {
            color: #d32f2f;
            margin-bottom: 20px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Rezervasyon Sistemine Hoş Geldiniz!</h1>
        <h2>Kayıt Formu</h2>

        <?php if (isset($errors) && !empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('basarili')): ?>
            <div class="success">
                <?= session()->getFlashdata('basarili') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('kullanici/kaydet') ?>" method="post">
            <label for="ad_soyad">Ad Soyad:</label>
            <input type="text" id="ad_soyad" name="ad_soyad" required value="<?= isset($old['ad_soyad']) ? esc($old['ad_soyad']) : '' ?>">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required value="<?= isset($old['email']) ? esc($old['email']) : '' ?>">

            <label for="telefon">Telefon:</label>
            <input type="tel" id="telefon" name="telefon" pattern="[0-9+\-\s]{7,20}" placeholder="+90 555 555 5555" value="<?= isset($old['telefon']) ? esc($old['telefon']) : '' ?>">

            <label for="dogum_tarihi">Doğum Tarihi:</label>
            <input type="date" id="dogum_tarihi" name="dogum_tarihi" value="<?= isset($old['dogum_tarihi']) ? esc($old['dogum_tarihi']) : '' ?>">

            <label for="cinsiyet">Cinsiyet:</label>
            <select id="cinsiyet" name="cinsiyet" required>
                <option value="" disabled <?= !isset($old['cinsiyet']) ? 'selected' : '' ?>>Seçiniz</option>
                <option value="Kadın" <?= (isset($old['cinsiyet']) && $old['cinsiyet'] === 'Kadın') ? 'selected' : '' ?>>Kadın</option>
                <option value="Erkek" <?= (isset($old['cinsiyet']) && $old['cinsiyet'] === 'Erkek') ? 'selected' : '' ?>>Erkek</option>
                <option value="Diğer" <?= (isset($old['cinsiyet']) && $old['cinsiyet'] === 'Diğer') ? 'selected' : '' ?>>Diğer</option>
            </select>

            <label for="sifre">Şifre:</label>
            <input type="password" id="sifre" name="sifre" required>

            <input type="submit" value="Kayıt Ol">
        </form>
    </div>
</body>
</html>
