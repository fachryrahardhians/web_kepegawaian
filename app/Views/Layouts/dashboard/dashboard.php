<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?? 'Dashboard' ?></title>

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

    <script src="/assets/vendor/libs/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="/js/app.js"></script>

    <?= $this->renderSection('scripts') ?>

</body>

</html>