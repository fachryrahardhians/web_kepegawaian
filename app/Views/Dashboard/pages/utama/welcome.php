<?= $this->extend('dashboard/layout/main_layout') ?>
<?= $this->section('content') ?>

<style>
    .responsive-img {
        max-width: 100%;
        height: auto;
    }
</style>


<div class="container-fluid">
    <div class="d-none d-md-block">
        <img src="<?= base_url('assets/welcome.png') ?>" alt="Logo" class="responsive-img">
    </div>

    <!-- Tampilan Mobile -->
    <div class="d-block d-md-none">
        <img src="<?= base_url('assets/welcome_v.png') ?>" alt="Logo" class="responsive-img">
    </div>

</div>

<?= $this->endSection() ?>