<!DOCTYPE html>
<html lang="en" class="layout-navbar-fixed layout-compact layout-menu-fixed" dir="ltr" data-skin="default" data-assets-path="../../assets/" data-template="vertical-menu-template" data-bs-theme="light">

<head>
    <title><?= $title ?? 'Dashboard' ?></title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/sneat/vendor/fonts/iconify-icons.css">

    <!-- Sneat CSS -->
    <link rel="stylesheet" href="/assets/sneat/vendor/libs/pickr/pickr-themes.css">
    <link rel="stylesheet" href="/assets/sneat/vendor/css/core.css">
    <link rel="stylesheet" href="/assets/sneat/vendor/css/theme-default.css">
    <link rel="stylesheet" href="/assets/sneat/css/demo.css">

    <link rel="stylesheet" href="/assets/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/assets/sneat/vendor/fonts/flag-icons.css">
    <link rel="stylesheet" href="/assets/sneat/vendor/fonts/boxicons.css" />

    <link rel="stylesheet" href="/assets/sneat/vendor/libs/apex-charts/apex-charts.css">
    <link rel="stylesheet" href="/assets/sneat/vendor/css/pages/card-analytics.css">

    <script src="/assets/sneat/vendor/js/helpers.js"></script>
    <!-- <script src="assets/sneat/vendor/js/template-customizer.js"></script> -->
    <?= $this->renderSection('header') ?>
</head>

<body>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- SIDEBAR -->
            <?= $this->include('partials/dashboard/sidebar') ?>

            <!-- PAGE CONTENT -->
            <div class="layout-page">

                <!-- NAVBAR -->
                <?= $this->include('partials/dashboard/navbar') ?>

                <!-- CONTENT -->
                <div class="content-wrapper">
                    <!-- <div class="container-xxl flex-grow-1"> -->

                    <?= $this->renderSection('content') ?>

                    <!-- </div> -->

                    <?= $this->include('partials/dashboard/footer') ?>
                </div>

            </div>
        </div>
    </div>

    <script src="/assets/sneat/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/sneat/vendor/libs/popper/popper.js"></script>
    <script src="/assets/sneat/vendor/js/bootstrap.js"></script>
    <script src="/assets/sneat/vendor/libs/@algolia/autocomplete-js.js"></script>
    <script src="/assets/sneat/vendor/js/menu.js"></script>
    <script src="/assets/sneat/vendor/libs/pickr/pickr.js"></script>
    <script src="/assets/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/assets/sneat/vendor/libs/apex-charts/apexcharts.js"></script>
    <script src="/assets/sneat/js/main.js"></script>
    <script src="/assets/sneat/vendor/libs/hammer/hammer.js"></script>
    <script src="/assets/sneat/vendor/libs/i18n/i18n.js"></script>
    <script src="/assets/sneat/js/dashboards-analytics.js"></script>
    <script async="" defer="" src="https://buttons.github.io/buttons.js"></script>
    <script src="/js/app.js"></script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>