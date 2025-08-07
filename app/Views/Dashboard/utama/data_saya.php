<?= $this->extend('dashboard/layout/main_layout') ?>
<?= $this->section('content') ?>

<div class="card">
  <div class="card-header">
    <h5>Data Anda</h5>
  </div>
  <div class="card-body">
    <table class="table table-bordered">
      <tbody>
        <tr>
          <th>Nama Lengkap</th>
          <td><?= esc($pegawai['nama']) ?></td>
        </tr>
        <tr>
          <th>NIP</th>
          <td><?= esc($pegawai['nip']) ?></td>
        </tr>
        <tr>
          <th>Nomor HP / WhatsApp</th>
          <td><?= esc($pegawai['no_wa']) ?></td>
        </tr>
        <tr>
          <th>Email</th>
          <td><?= esc($pegawai['email']) ?></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<?= $this->endSection() ?>
