<?= $this->extend('layouts/main') ?>

<?= $this->section('style') ?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fff8ed;
        margin: 0;
        padding: 0;
        color: #4b3621;
    }

    .container {
        max-width: 700px;
        margin: 50px auto;
        background: white;
        padding: 40px;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #4b3621;
        font-size: 28px;
        margin-bottom: 30px;
    }

    .info p {
        font-size: 18px;
        margin: 12px 0;
    }

    .info strong {
        display: inline-block;
        width: 150px;
        font-weight: bold;
    }

    .buttons {
        margin-top: 30px;
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .buttons a {
        text-decoration: none;
        background-color: #333;
        color: white;
        padding: 10px 25px;
        border-radius: 8px;
        transition: background-color 0.3s;
    }

    .buttons a:hover {
        background-color: #555;
    }

    .yorum {
        background-color: #f9f9f9;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        box-shadow: 0 1px 5px rgba(0,0,0,0.1);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <h1>Profilim</h1>

    <div class="info">
        <p><strong>Ad Soyad:</strong> <?= esc($kullanici['ad_soyad'] ?? 'Bilinmiyor') ?></p>
        <p><strong>E-posta:</strong> <?= esc($kullanici['email'] ?? 'Bilinmiyor') ?></p>
        <p><strong>Telefon:</strong> <?= esc($kullanici['telefon'] ?? '-') ?></p>
        <p><strong>Doğum Tarihi:</strong> <?= esc($kullanici['dogum_tarihi'] ?? '-') ?></p>
        <p><strong>Cinsiyet:</strong> <?= esc($kullanici['cinsiyet'] ?? '-') ?></p>
    </div>

    <div class="buttons">
        <a href="<?= base_url('profil_duzenle') ?>">Profili Düzenle</a>
        <a href="<?= base_url('sifre_degistir') ?>">Şifre Değiştir</a>
    </div>

    <hr style="margin:40px 0;">
    <h2>Yorumlarım</h2>

    <?php foreach ($yorumlar as $yorum): ?>
        <div class="yorum" id="yorum-<?= esc($yorum['id']) ?>">
            <p><strong><?= esc($yorum['mekan_tipi']) ?>:</strong> <?= esc($yorum['mekan_adi']) ?></p>
            <p><strong>Yorum Tarihi:</strong> <?= esc(date('d.m.Y H:i', strtotime($yorum['tarih']))) ?></p>
            <p><strong>Puan:</strong> <?= esc($yorum['puan']) ?>/5</p>
            <p><?= nl2br(esc($yorum['yorum'])) ?></p>

            <button class="yorum-sil-btn" data-yorum-id="<?= esc($yorum['id']) ?>"
                style="background:#e74c3c; color:#fff; border:none; padding:5px 10px; border-radius:5px; cursor:pointer;">
                Yorumu Sil
            </button>
        </div>
    <?php endforeach; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('.yorum-sil-btn').click(function(e){
        e.preventDefault();

        if (!confirm('Yorumu silmek istediğinize emin misiniz?')) {
            return;
        }

        const yorumId = $(this).data('yorum-id');

        $.ajax({
            url: "<?= base_url('profilim/yorumSil') ?>/" + yorumId,
            type: "POST",
            dataType: "json",
            success: function (response) {
                $('#yorum-' + yorumId).fadeOut(300, function () {
                    $(this).remove();
                });
                alert(response.success);
            },
            error: function (xhr) {
                var msg = xhr.responseJSON?.error ?? "Sunucu hatası.";
                alert(msg);
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
