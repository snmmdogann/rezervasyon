<?= $this->extend('layouts/main') ?>

<?= $this->section('style') ?>
<style>
    body {
        /* body stili main layout'ta zaten var, istersen ek stil ekleyebilirsin */
        background: #f4eee7;
        color: #4b3621;
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

    .benzer-restoran {
        display: inline-block;
        width: 180px;
        margin-right: 10px;
        vertical-align: top;
    }

    .benzer-restoran img {
        width: 100%;
        border-radius: 6px;
        box-shadow: 0 2px 5px rgba(101, 67, 33, 0.15);
    }

    form {
        background-color: rgba(215, 204, 200, 0.8);
        padding: 15px 20px;
        border-radius: 10px;
        box-shadow: 0 6px 12px rgba(121, 85, 58, 0.3);
        margin-top: 30px;
    }

    form label {
        color: #5d4037;
        font-weight: 600;
    }

    form textarea, form input[type="number"] {
        width: 100%;
        padding: 8px 12px;
        border: 1.5px solid #a1887f;
        border-radius: 6px;
        font-family: 'Segoe UI', sans-serif;
        font-size: 14px;
        margin-top: 6px;
        margin-bottom: 15px;
        resize: vertical;
    }

    form textarea:focus, form input[type="number"]:focus {
        outline: none;
        border-color: #6d4c41;
        box-shadow: 0 0 5px #6d4c41;
    }

    form button {
        background-color: #6d4c41;
        color: white;
        font-weight: 700;
        padding: 10px 18px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button:hover {
        background-color: #4e342e;
    }

    p.hata-mesaji {
        background-color: #ef9a9a;
        color: #b71c1c;
        padding: 10px 15px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    a {
        color: #6d4c41;
        text-decoration: underline;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <h1><?= esc($restoran['isim']) ?></h1>

    <?php if (!empty($restoran['resim_yolu'])): ?>
        <img src="<?= base_url('uploads/' . $restoran['resim_yolu']) ?>" alt="<?= esc($restoran['isim']) ?>">

    <?php endif; ?>

    <div class="bilgi">
        <p><strong>Şehir:</strong> <?= esc($restoran['sehir'] ?? 'Bilinmiyor') ?></p>
        <p><strong>Adres:</strong> <?= nl2br(esc($restoran['adres'])) ?></p>
        <p><strong>Telefon:</strong> <?= !empty($restoran['telefon']) ? '<a href="tel:' . esc($restoran['telefon']) . '">' . esc($restoran['telefon']) . '</a>' : 'Bilgi yok' ?></p>
        <p><strong>Email:</strong> <?= !empty($restoran['email']) ? '<a href="mailto:' . esc($restoran['email']) . '">' . esc($restoran['email']) . '</a>' : 'Bilgi yok' ?></p>
        <p><strong>Instagram:</strong> <?= !empty($restoran['instagram']) ? '<a href="' . esc($restoran['instagram']) . '" target="_blank">' . esc($restoran['instagram']) . '</a>' : 'Bilgi yok' ?></p>
        <p><strong>Puan:</strong> <?= esc($restoran['puan']) ?> / 5</p>
        <p><strong>Açıklama:</strong> <?= esc($restoran['aciklama'] ?? 'Açıklama yok.') ?></p>
        <p><strong>Çalışma Saatleri:</strong></p>
        <pre><?= esc($restoran['calisma_saatleri'] ?? 'Çalışma saatleri bilgisi yok.') ?></pre>
        <?php if (!empty($restoran['konum_linki'])): ?>
            <p><a href="<?= esc($restoran['konum_linki']) ?>" target="_blank">📍 Haritada Göster</a></p>
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

    <form action="<?= site_url('rezervasyon/yap/restoran/' . $restoran['id']) ?>" method="post" style="margin-top: 30px;">
        <button type="submit" style="background-color:#6d4c41; color: white; font-weight: 700;
            padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer;
            transition: background-color 0.3s ease; font-size: 16px;">
            Rezervasyon Yap
        </button>
    </form>

    <h2>Benzer Restoranlar</h2>
    <?php if (!empty($benzerRestoranlar)): ?>
        <?php foreach ($benzerRestoranlar as $bRestoran): ?>
            <div class="benzer-restoran">
                <strong><?= esc($bRestoran['isim']) ?></strong><br />
                <small><?= esc($bRestoran['adres']) ?></small>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Benzer restoran bulunamadı.</p>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#yorumForm').on('submit', function (e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajax({
            url: "<?= site_url('restorandetay/yorum-ekle/' . $restoran['id']) ?>",
            method: "POST",
            data: formData,
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    const yeniYorum = response.yorum;
                    const kullanici = yeniYorum.kullanici_id ? yeniYorum.kullanici_id : 'Anonim';
                    const html = `
                        <div class="yorum">
                            <strong>Kullanıcı #${kullanici}</strong><br />
                            ${yeniYorum.yorum.replace(/\n/g, '<br />')}<br />
                            <em>Puan: ${yeniYorum.puan}/5</em>
                        </div>
                    `;

                    $('.yorumlar-alani').prepend(html);

                    $('#yorumForm')[0].reset();

                    const noCommentMessage = $('.yorumlar-alani p');
                    if (noCommentMessage.length && noCommentMessage.text().includes('Henüz yorum yok.')) {
                        noCommentMessage.remove();
                    }

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
