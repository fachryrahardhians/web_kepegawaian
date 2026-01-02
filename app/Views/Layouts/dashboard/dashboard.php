<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?? 'Dashboard' ?></title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="/assets/sneat/vendor/fonts/boxicons.css" />

    <!-- Sneat CSS -->
    <link rel="stylesheet" href="/assets/sneat/vendor/css/core.css">
    <link rel="stylesheet" href="/assets/sneat/vendor/css/theme-default.css">
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
                    <div class="container-xxl flex-grow-1">

                        <?= $this->renderSection('content') ?>

                    </div>

                    <?= $this->include('partials/dashboard/footer') ?>
                </div>

            </div>
        </div>
    </div>

    <script src="/assets/sneat/vendor/js/bootstrap.js"></script>
    <script src="/assets/sneat/vendor/js/menu.js"></script>
    <script src="/js/app.js"></script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>