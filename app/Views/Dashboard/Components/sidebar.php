<!-- Sidebar -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #1d3468;">
  <!-- Brand Logo -->
  <a href="#" class="brand-link" style="background-color: #1d3468;">
    <span class="brand-text font-weight-light text-white">My Dashboard</span>
  </a>

  <!-- Sidebar content -->
  <div class="sidebar">
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <!-- Menu Utama -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-th-large" style="color: #fdb810;"></i>
            <p>
              Kepegawaian
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!-- <li class="nav-item">
              <a href="<?= base_url('/dashboard/utama/data-saya') ?>" class="nav-link">
                <p>Data Saya</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <p>Pengajuan Cuti</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= base_url('/dashboard/utama/bukti-dukung-bravo') ?>" class="nav-link">
                <p>Bukti Dukung Bravo</p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="#" class="nav-link">
                <p>LHKPN</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="<?= base_url('/dashboard/utama/survey-kepuasan') ?>" class="nav-link">
                <p>Survey Kepuasan Layanan Kepegawaian</p>
              </a>
            </li>
          </ul>
        </li>

        <!--  -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-calendar-check" style="color: #fdb810;"></i>
            <p>
              Log Kegiatan Harian
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!-- <li class="nav-item">
              <a href="<?= base_url('/dashboard/log/rencana_hasil_kerja_atasan') ?>" class="nav-link">
                <p>Rencana Hasil Kerja</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="<?= base_url('/dashboard/log/saya') ?>" class="nav-link">
                <p>Kegiatan Saya</p>
              </a>
            </li>
            <?php if (array_filter(session()->get('levels'), fn($v) => ((int)$v) > 0 && ((int)$v) <= 4)): ?>
              <li class="nav-item">
                <a href="<?= base_url('/dashboard/log/pantauan') ?>" class="nav-link">
                  <p>Pemantauan</p>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </li>

        <!-- Menu Lainnya -->
        <!-- <li class="nav-item">
          <a href="<?= base_url('/dashboard/log') ?>" class="nav-link">
            <i class="nav-icon fas fa-calendar-check" style="color: #fdb810;"></i>
            <p>Log Kerja Harian</p>
          </a>
        </li> -->

        <li class="nav-item">
          <a href="<?= base_url('/dashboard/pengembangan') ?>" class="nav-link">
            <i class="nav-icon fas fa-chalkboard-teacher" style="color: #fdb810;"></i>
            <p>Pengembangan Kompetensi</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?= base_url('/dashboard/profil') ?>" class="nav-link">
            <i class="nav-icon fas fa-user" style="color: #fdb810;"></i>
            <p>Profil Saya</p>
          </a>
        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>


<!-- <script>
  document.addEventListener("DOMContentLoaded", function () {
    const toggleLinks = document.querySelectorAll('[data-bs-toggle="collapse"]');

    toggleLinks.forEach(link => {
      const targetId = link.getAttribute('data-bs-target');
      const target = document.querySelector(targetId);
      const arrow = link.querySelector('.toggle-arrow');

      // saat toggle diklik
      link.addEventListener('click', function () {
        setTimeout(() => {
          if (target.classList.contains('show')) {
            arrow.classList.remove('fa-angle-right');
            arrow.classList.add('fa-angle-down');
          } else {
            arrow.classList.remove('fa-angle-down');
            arrow.classList.add('fa-angle-right');
          }
        }, 350); // sesuai timing animasi bootstrap
      });
    });
  });
</script>


<?php $segment = service('uri')->getSegment(2); ?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="#" class="brand-link text-center">
    <span class="brand-text fw-bold">Dashboard</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column " role="menu">
        <li class="nav-item <?= url_is('dashboard/utama/*') ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= url_is('dashboard/utama/*') ? 'menu-open' : '' ?>" data-bs-toggle="collapse" data-bs-target="#submenuUtama" aria-expanded="false">
          <i class="nav-icon fas fa-home me-2"></i>
          <span>Utama</span>
          <i class="fas fa-angle-right ms-auto toggle-arrow"></i>  
  </a>
  <ul class="nav collapse" id="submenuUtama">
    <li class="nav-item">
      <a href="<?= base_url('/dashboard/utama/data-saya') ?>" class="nav-link <?= url_is('dashboard/utama/data-saya') ? 'active' : '' ?>">
        <i class="far fa-circle nav-icon me-2"></i> Data Saya
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('/dashboard/utama/pengajuan-cuti') ?>" class="nav-link">
        <i class="far fa-circle nav-icon me-2"></i> Pengajuan Cuti
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('/dashboard/utama/bravo') ?>" class="nav-link">
        <i class="far fa-circle nav-icon me-2"></i> Bukti Dukung Bravo
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('/dashboard/utama/lhkpn') ?>" class="nav-link">
        <i class="far fa-circle nav-icon me-2"></i> LHKPN
      </a>
    </li>
    <li class="nav-item">
      <a href="<?= base_url('/dashboard/utama/survey') ?>" class="nav-link">
        <i class="far fa-circle nav-icon me-2"></i> Survey Kepuasan
      </a>
    </li>
  </ul>
  </li>
        <li class="nav-item">
          <a href="/dashboard/pengembangan" class="nav-link <?= $segment === 'pengembangan' ? 'active' : '' ?>">
            <p>Pengembangan Kompetensi</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/dashboard/log" class="nav-link <?= $segment === 'log' ? 'active' : '' ?>">
            <p>Log Pekerjaan</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="/dashboard/profil" class="nav-link <?= $segment === 'profil' ? 'active' : '' ?>">
            <p>Profil Saya</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside> -->