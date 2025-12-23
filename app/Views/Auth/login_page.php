<?= $this->extend('layouts/main') ?>
<?= $this->section('head') ?>
<!-- Vendors CSS -->
<link rel="stylesheet" href="<?= base_url('assets/sneat/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />

<!-- Page CSS -->
<!-- Page -->
<link rel="stylesheet" href="<?= base_url('assets/sneat/vendor/css/pages/page-auth.css') ?>" />
<!-- Helpers -->
<script src="<?= base_url('assets/sneat/vendor/js/helpers.js') ?>"></script>

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="<?= base_url('assets/sneat/js/config.js') ?>"></script>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="<?= base_url() ?>" class="app-brand-link gap-2">
              <img src="<?= base_url('assets/img/bbwsbs.png') ?>" alt="bbwsbs" width="100">
            </a>
          </div>
          <!-- /Logo -->
          <h5 class="mb-2">Selamat Datang</h4>
            <h5 class="mb-2">di Web Kepegawaian ! 👋</h4>
              <p class="mb-4">Silakan masuk ke akun anda dengan NIP dan Kata Sandi</p>

              <form id="loginForm" class="mb-3" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">NIP</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="1990123123123123"
                    autofocus />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-dark d-grid w-100" type="submit">Sign in</button>
                </div>
              </form>

              <p class="text-center">
                <span>belum punya Akun ?</span>
                <a href="#">
                  <span>buat Akun sekarang</span>
                </a>
              </p>
        </div>
      </div>
      <!-- /Register -->
    </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="/js/api/login.js"></script>
<?= $this->endSection() ?>