<!DOCTYPE html>

<html
    lang="en"
    class="light-style customizer-hide"
    dir="ltr"
    data-theme="theme-default"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login ke Web Kepegawaian</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <!-- Favicon already set on config -->
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/sneat/vendor/fonts/boxicons.css') ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/sneat/vendor/css/core.css') ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= base_url('assets/sneat/vendor/css/theme-default.css') ?>" class="template-customizer-theme-css" />

    <?= $this->renderSection('head') ?>
</head>

<body>

    <!-- Content -->
    <?= $this->renderSection('content') ?>?>

    <!-- GLOBAL LOADING OVERLAY & ALERT -->
    <?= $this->include('partials/loading') ?>
    <?= $this->include('partials/alert') ?>


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= base_url('assets/sneat/vendor/libs/jquery/jquery.js') ?>"></script>
    <script src="<?= base_url('assets/sneat/vendor/libs/popper/popper.js') ?>"></script>
    <script src="<?= base_url('assets/sneat/vendor/js/bootstrap.js') ?>"></script>
    <script src="<?= base_url('assets/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>
    <script src="<?= base_url('assets/sneat/vendor/js/menu.js') ?>"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?= base_url('assets/sneat/js/main.js') ?>"></script>
    <script src="/js/app.js"></script>
    <!-- Page JS -->
    <?= $this->renderSection('scripts') ?>?>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>