<!-- app/Views/site_iletisim.php -->
<?= $this->extend('layouts/main') ?>

<?= $this->section('style') ?>
<style>
  body {
    background-color: #fff7e6;
    color: #4b3621;
    font-family: Arial, sans-serif;
    max-width: 600px;
    margin: 40px auto;
    padding: 20px;
    box-sizing: border-box;
  }

  h1 {
    text-align: center;
    margin-bottom: 10px;
  }

  p {
    text-align: center;
    margin-bottom: 40px;
  }

  .info {
    background: rgba(75, 54, 33, 0.1);
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 0 8px rgba(75, 54, 33, 0.15);
  }

  .info p {
    margin: 12px 0;
    font-size: 18px;
  }

  a {
    color: #0066cc;
    text-decoration: none;
    font-weight: bold;
  }

  a:hover {
    text-decoration: underline;
  }

  .social-icons {
    margin-top: 30px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 15px;
  }

  .social-icons a {
    font-size: 20px;
    color: #0066cc;
    text-decoration: none;
    border: 1px solid #ddd;
    padding: 10px 15px;
    border-radius: 10px;
    background-color: #fff;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
  }

  .social-icons a:hover {
    background-color: #f0f0f0;
    color: #004a99;
  }

  .social-icons span {
    font-weight: bold;
  }

  .form-section {
    margin-top: 50px;
    background: rgba(255, 255, 255, 0.7);
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(75, 54, 33, 0.1);
  }

  form label {
    font-weight: bold;
    display: block;
    margin-top: 15px;
    margin-bottom: 5px;
  }

  input, textarea {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    box-sizing: border-box;
  }

  button {
    margin-top: 20px;
    padding: 10px 20px;
    background-color: #4b3621;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    width: 100%;
  }

  .success {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
  }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h1>İletişim</h1>
<p>Bize aşağıdaki bilgilerden ulaşabilirsiniz.</p>

<div class="info">
  <p><strong>Telefon:</strong> <a href="tel:+905551234567">0 555 123 45 67</a></p>
  <p><strong>E-posta:</strong> <a href="mailto:info@ornekfirma.com">info@ornekfirma.com</a></p>
  <p><strong>Adres:</strong> Örnek Mahallesi, 123. Sokak No:5, İstanbul</p>
  <p><strong>Çalışma Saatleri:</strong> Pazartesi - Cuma, 09:00 - 18:00</p>
</div>

<div class="social-icons">
  <a href="https://facebook.com/ornekfirma" target="_blank" title="Facebook" aria-label="Facebook">📘 <span>Facebook</span></a>
  <a href="https://instagram.com/snmmdogann" target="_blank" title="Instagram" aria-label="Instagram">📸 <span>Instagram</span></a>
  <a href="https://twitter.com/Snmm_dogan" target="_blank" title="X" aria-label="X">🐦 <span>X</span></a>
  <a href="https://linkedin.com/company/ornekfirma" target="_blank" title="LinkedIn" aria-label="LinkedIn">🔗 <span>LinkedIn</span></a>
</div>

<div class="form-section">
  <h2>Mesaj Gönder</h2>

  <?php if (session()->getFlashdata('success')): ?>
    <div class="success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <form action="<?= site_url('iletisim/gonder') ?>" method="post">
    <?= csrf_field() ?>

    <label for="ad_soyad">Ad Soyad:</label>
    <input type="text" name="ad_soyad" id="ad_soyad" required>

    <label for="email">E-posta:</label>
    <input type="email" name="email" id="email" required>

    <label for="konu">Konu:</label>
    <input type="text" name="konu" id="konu" required>

    <label for="mesaj">Mesaj:</label>
    <textarea name="mesaj" id="mesaj" rows="5" required></textarea>

    <button type="submit">Gönder</button>
  </form>
</div>
<?= $this->endSection() ?>
