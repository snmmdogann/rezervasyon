<?= $this->extend('layouts/main') ?>

<?= $this->section('style') ?>
<style>
    body {
        background-color: #fff8ed;
        font-family: Arial, sans-serif;
        padding: 30px;
        color: #4b3621;
    }
    .container {
        max-width: 500px;
        margin: auto;
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 1px 8px rgba(0,0,0,0.1);
    }
    input[type="password"], button[type="submit"] {
        width: 100%;
        padding: 12px;
        margin-top: 15px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }
    button[type="submit"] {
        background-color: #4b3621;
        color: white;
        font-weight: bold;
        cursor: pointer;
        border: none;
    }
    .message {
        margin-top: 20px;
        color: red;
    }
    .success {
        color: green;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
  <form action="<?= base_url('sifre_degistir/guncelle') ?>" method="post">
    <?= csrf_field() ?>

    <label>Eski Şifre:</label>
    <input type="password" name="eski_sifre" required>

    <label>Yeni Şifre:</label>
    <input type="password" name="yeni_sifre" required>

    <label>Yeni Şifre (Tekrar):</label>
    <input type="password" name="sifre_tekrar" required>

    <button type="submit">Şifreyi Güncelle</button>
  </form>

  <?php if(session()->getFlashdata('error')): ?>
      <div class="message"><?= session()->getFlashdata('error') ?></div>
  <?php endif; ?>

  <?php if(session()->getFlashdata('success')): ?>
      <div class="success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>
</div>
<?= $this->endSection() ?>
