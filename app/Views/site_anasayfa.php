<!-- app/Views/site_anasayfa.php -->
<?= $this->extend('layouts/main') ?>

<?= $this->section('style') ?>
<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-grow: 1;
        gap: 40px;
        padding: 40px 0;
    }

    .section {
        flex: 1 1 500px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    .oteller-button {
        width: 500px;
        height: 600px;
        background-image: url('oteller.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        font-size: 22px;
        font-weight: bold;
        border: none;
        border-radius: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        text-decoration: none;
        transition: transform 0.3s ease;
    }

    .oteller-button:hover {
        transform: scale(1.02);
    }

    .restoran-button {
        width: 500px;
        height: 600px;
        background-image: url('restoranlar.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        color: white;
        font-size: 22px;
        font-weight: bold;
        border: none;
        border-radius: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        text-decoration: none;
        transition: opacity 0.3s ease;
    }

    .restoran-button:hover {
        opacity: 0.85;
    }

    .oteller-button span,
    .restoran-button span {
        background-color: rgba(0, 0, 0, 0.5);
        padding: 10px 20px;
        border-radius: 10px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="section" id="oteller-section">
        <a href="<?= base_url('oteller') ?>" class="oteller-button">
            <span>OTELLER</span>
        </a>
    </div>

    <div class="section" id="restoranlar-section">
        <a href="<?= base_url('restoranlar') ?>" class="restoran-button">
            <span>RESTORANLAR</span>
        </a>
    </div>
</div>
<?= $this->endSection() ?>
