<?= $this->extend('layouts/main') ?>

<?= $this->section('style') ?>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4eee7;
            color: #4b3621;
            margin: 20px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 6px 12px rgba(121, 85, 58, 0.3);
        }

        h1, h2 { color: #6d4c41; }

        img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .bilgi p { margin: 10px 0; }

        .yorum {
            border-top: 1px solid #d7ccc8;
            padding: 10px 0;
        }

        form {
            background-color: rgba(215, 204, 200, 0.8);
            padding: 15px 20px;
            border-radius: 10px;
            box-shadow: 0 6px 12px rgba(121, 85, 58, 0.3);
            margin-top: 30px;
        }

        form label {
            font-weight: 600;
        }

        form textarea, form input[type="number"] {
            width: 100%;
            padding: 8px 12px;
            border: 1.5px solid #a1887f;
            border-radius: 6px;
            margin-top: 6px;
            margin-bottom: 15px;
            resize: vertical;
        }

        form button {
            background-color: #6d4c41;
            color: white;
            font-weight: 700;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        a {
            color: #6d4c41;
            text-decoration: underline;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <h1><?= esc($otel['isim']) ?></h1>

    <?php if (!empty($otel['resim_yolu'])): ?>
       <img src="<?= base_url('uploads/' . $otel['resim_yolu']) ?>" alt="<?= esc($otel['isim']) ?>">

    <?php endif; ?>

    <div class="bilgi">
        <p><strong>Şehir:</strong> <?= esc($otel['sehir'] ?? 'Bilinmiyor') ?></p>
        <p><strong>Adres:</strong> <?= nl2br(esc($otel['adres'])) ?></p>
        <p><strong>Telefon:</strong> <?= !empty($otel['telefon']) ? '<a href="tel:' . esc($otel['telefon']) . '">' . esc($otel['telefon']) . '</a>' : 'Bilgi yok' ?></p>
        <p><strong>Email:</strong> <?= !empty($otel['email']) ? '<a href="mailto:' . esc($otel['email']) . '">' . esc($otel['email']) . '</a>' : 'Bilgi yok' ?></p>
        <p><strong>Instagram:</strong> <?= !empty($otel['instagram']) ? '<a href="' . esc($otel['instagram']) . '" target="_blank">' . esc($otel['instagram']) . '</a>' : 'Bilgi yok' ?></p>
        <p><strong>Puan:</strong> <?= esc($otel['puan']) ?> / 5</p>
        <p><strong>Açıklama:</strong> <?= esc($otel['aciklama'] ?? 'Açıklama yok.') ?></p>

        <?php if (!empty($otel['konum_linki'])): ?>
            <p><a href="<?= esc($otel['konum_linki']) ?>" target="_blank">📍 Haritada Göster</a></p>
        <?php endif; ?>
    </div>

    <h2>Yorumlar</h2>
    <div class="yorumlar-alani">
        <?php if (!empty($yorumlar)): ?>
            <?php foreach ($yorumlar as $yorum): ?>
                <div class="yorum">
                    <strong>Kullanıcı #<?= esc($yorum['kullanici_id'] ?? 'Anonim') ?></strong><br />
                    <?= nl2br(esc($yorum['yorum'])) ?><br />
                    <em>Puan: <?= esc($yorum['puan']) ?>/5</em>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Henüz yorum yok.</p>
        <?php endif; ?>
    </div>

    <h2>Yorum Yap</h2>
    <form id="yorumForm" method="post">
        <label for="yorum">Yorumunuz:</label>
        <textarea id="yorum" name="yorum" rows="4" required></textarea>

        <label for="puan">Puanınız (1-5):</label>
        <input type="number" id="puan" name="puan" min="1" max="5" required>

        <button type="submit">Gönder</button>
    </form>

    <form action="<?= site_url('rezervasyon/yap/otel/' . $otel['id']) ?>" method="post" style="margin-top: 30px;">
        <button type="submit" style="background-color:#6d4c41; color: white; font-weight: 700;
            padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer;
            transition: background-color 0.3s ease; font-size: 16px;">
            Rezervasyon Yap
        </button>
    </form>

    <h2>Benzer Oteller</h2>
    <?php if (!empty($benzerOteller)): ?>
        <?php foreach ($benzerOteller as $bOtel): ?>
            <div class="yorum">
                <strong><?= esc($bOtel['isim']) ?></strong><br />
                <small><?= esc($bOtel['adres']) ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Benzer otel bulunamadı.</p>
    <?php endif; ?>
</div>

<!-- AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#yorumForm').on('submit', function (e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.ajax({
            url: "<?= site_url('oteldetay/yorum-ekle/' . $otel['id']) ?>",
            method: "POST",
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    const yorum = response.yorum;
                    const kullanici = yorum.kullanici_id ? yorum.kullanici_id : 'Anonim';
                    const html = `
                        <div class="yorum">
                            <strong>Kullanıcı #${kullanici}</strong><br />
                            ${yorum.yorum.replace(/\n/g, '<br />')}<br />
                            <em>Puan: ${yorum.puan}/5</em>
                        </div>`;
                    $('.yorumlar-alani').prepend(html);
                    $('#yorumForm')[0].reset();
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert('Yorum gönderilirken bir hata oluştu.');
            }
        });
    });
</script>
<?= $this->endSection() ?>
