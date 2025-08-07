<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1d3468;">
  <!-- Brand Logo -->
  <a href="#" class="brand-link" style="background-color: #1d3468;">
    <span class="brand-text font-weight-light text-white">BBWSBS</span>
  </a>

  <!-- Sidebar content -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
          <a href="<?= base_url('/admin/index') ?>" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher" style="color: #fdb810;"></i>
            <p>Home</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('/admin/pegawai') ?>" class="nav-link">
            <i class="nav-icon fas fa-user" style="color: #fdb810;"></i>
            <p>Pegawai</p>
          </a>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th-large" style="color: #fdb810;"></i>
            <p>
              Struktur Organisasi
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="<?= base_url('/admin/struktur/bidang') ?>" class="nav-link">
                <p>Bidang - Bagian</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('/admin/struktur/tim') ?>" class="nav-link">
                <p>Satker - Tim</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('/admin/struktur/ppk') ?>" class="nav-link">
                <p>PPK</p>
              </a>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>