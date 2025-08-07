<nav class="main-header navbar navbar-expand navbar-dark" style="background-color: #1d3468;">
  <!-- Sidebar toggle button -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown user-menu">
      <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="https://img.freepik.com/premium-vector/vector-flat-illustration-grayscale-avatar-user-profile-person-icon-gender-neutral-silhouette-profile-picture-suitable-social-media-profiles-icons-screensavers-as-templatex9xa_719432-1061.jpg" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline"><?= session('nama') ?? 'User' ?></span>
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-warning">
          <img src="https://img.freepik.com/premium-vector/vector-flat-illustration-grayscale-avatar-user-profile-person-icon-gender-neutral-silhouette-profile-picture-suitable-social-media-profiles-icons-screensavers-as-templatex9xa_719432-1061.jpg" class="img-circle elevation-2" alt="User Image">
          <p>
            <?= session('nama') ?? 'User' ?>
            <small>Pengguna</small>
          </p>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
          <a href="<?= base_url('/dashboard/profil') ?>" class="btn btn-default btn-flat">Profil</a>
          <a href="<?= base_url('/logout') ?>" class="btn btn-default btn-flat float-right">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        </li>
      </ul>
    </li>

  </ul>
</nav>