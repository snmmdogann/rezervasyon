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
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    h1 {
        text-align: center;
        color: #4b3621;
        font-size: 28px;
        margin-bottom: 30px;
    }
    label {
        display: block;
        margin: 15px 0 5px;
        font-weight: bold;
    }
    input[type="text"],
    input[type="email"],
    input[type="tel"],
    input[type="date"],
    select {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1.5px solid #bcaaa4;
        border-radius: 8px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        margin-top: 30px;
        background-color: #4b3621;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #6d4c41;
    }
    .error {
        color: #d32f2f;
        margin-top: 5px;
        font-size: 14px;
    }
    .success {
        text-align: center;
        color: #388e3c;
        margin-bottom: 20px;
        font-weight: 600;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <h1>Profilimi Düzenle</h1>

    <?php if(session()->getFlashdata('basarili')): ?>
        <div class="success"><?= session()->getFlashdata('basarili') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('profil_duzenle/guncelle') ?>" method="post">
        <label for="ad_soyad">Ad Soyad</label>
        <input type="text" id="ad_soyad" name="ad_soyad" value="<?= esc(old('ad_soyad', $kullanici['ad_soyad'])) ?>">
        <?php if(isset($validation) && $validation->hasError('ad_soyad')): ?>
            <div class="error"><?= $validation->getError('ad_soyad') ?></div>
        <?php endif; ?>

        <label for="email">E-posta</label>
        <input type="email" id="email" name="email" value="<?= esc(old('email', $kullanici['email'])) ?>">
        <?php if(isset($validation) && $validation->hasError('email')): ?>
            <div class="error"><?= $validation->getError('email') ?></div>
        <?php endif; ?>

        <label for="telefon">Telefon</label>
        <input type="tel" id="telefon" name="telefon" value="<?= esc(old('telefon', $kullanici['telefon'])) ?>">
        <?php if(isset($validation) && $validation->hasError('telefon')): ?>
            <div class="error"><?= $validation->getError('telefon') ?></div>
        <?php endif; ?>

        <label for="dogum_tarihi">Doğum Tarihi</label>
        <input type="date" id="dogum_tarihi" name="dogum_tarihi" value="<?= esc(old('dogum_tarihi', $kullanici['dogum_tarihi'])) ?>">
        <?php if(isset($validation) && $validation->hasError('dogum_tarihi')): ?>
            <div class="error"><?= $validation->getError('dogum_tarihi') ?></div>
        <?php endif; ?>

        <label for="cinsiyet">Cinsiyet</label>
        <select id="cinsiyet" name="cinsiyet">
            <option value="" <?= old('cinsiyet', $kullanici['cinsiyet']) == '' ? 'selected' : '' ?>>Seçiniz</option>
            <option value="Kadın" <?= old('cinsiyet', $kullanici['cinsiyet']) == 'Kadın' ? 'selected' : '' ?>>Kadın</option>
            <option value="Erkek" <?= old('cinsiyet', $kullanici['cinsiyet']) == 'Erkek' ? 'selected' : '' ?>>Erkek</option>
            <option value="Diğer" <?= old('cinsiyet', $kullanici['cinsiyet']) == 'Diğer' ? 'selected' : '' ?>>Diğer</option>
        </select>
        <?php if(isset($validation) && $validation->hasError('cinsiyet')): ?>
            <div class="error"><?= $validation->getError('cinsiyet') ?></div>
        <?php endif; ?>

        <input type="submit" value="Güncelle">
    </form>
</div>
<?= $this->endSection() ?>
