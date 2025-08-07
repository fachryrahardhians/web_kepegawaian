<?= $this->extend('dashboard/layout/main_layout') ?>
<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Form Rencana Kerja</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Form Card -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Masukkan Rencana Kerja Anda</h3>
        </div>
        <!-- /.card-header -->

        <!-- form start -->
        <form action="<?= base_url('dashboard/log/submit_rencana_kerja_atasan') ?>" method="post">
          <div class="card-body">
            <div class="form-group">
              <label for="rencanaKerja">Rencana Kerja</label>
              <textarea class="form-control" id="rencanaKerja" name="rencanaKerja" rows="5" placeholder="Tulis rencana kerja Anda di sini..." required></textarea>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer text-right">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>