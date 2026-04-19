<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Kullanıcı Giriş</title>
    <style>
        /* Sayfa genel ayarları */
        body, html {
            margin: 0; padding: 0;
            height: 100%;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #d7ccc8, #a1887f); /* Toprak tonlarında degrade */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Form kapsayıcısı */
        .container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            width: 360px;
            max-width: 90vw;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #5d4037; /* koyu toprak rengi */
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #4e342e;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1.5px solid #bcaaa4;
            border-radius: 6px;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #6d4c41;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #6d4c41; /* koyu toprak rengi */
            color: white;
            padding: 14px;
            font-size: 16px;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-weight: 700;
        }

        input[type="submit"]:hover {
            background-color: #5d4037;
        }

        .error {
            color: #d32f2f;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
        }

        p {
            text-align: center;
            margin-top: 15px;
            color: #5d4037;
            font-weight: 600;
        }

        a {
            color: #8d6e63;
            text-decoration: none;
            font-weight: 700;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Kullanıcı Giriş</h2>

        <?php if (session()->getFlashdata('hata')): ?>
            <div class="error"><?= session()->getFlashdata('hata') ?></div>
        <?php endif; ?>

        <form method="post" action="<?= base_url('kullanici/giris') ?>">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />

            <label for="sifre">Şifre:</label>
            <input type="password" id="sifre" name="sifre" required />

            <input type="submit" value="Giriş Yap" />
        </form>

        <p>Hesabın yok mu? <a href="<?= base_url('kullanici/kayitFormu') ?>">Kayıt Ol</a></p>
    </div>
</body>
</html>
