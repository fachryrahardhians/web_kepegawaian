<?= $this->extend('dashboard/layout/main_layout') ?>
<?= $this->section('content') ?>

<!-- Tombol atas -->
<div class="mb-3">
  <a href="<?= base_url('/dashboard/log/form_rencana_kerja_atasan')?>" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Rencana Kerja
  </a>
  <!-- <a href="export-rencana.php" class="btn btn-secondary">
    <i class="fas fa-file-pdf"></i> Export PDF
  </a> -->
</div>

<!-- Tabel -->
<table id="tabel-rencana" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>Rencana Kerja</th>
      <th style="width: 120px;">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($rencana_kerja as $item): ?>
      <tr>
        <td><?= esc($item['rencana_kerja']) ?></td>
        <td>
          <a href="edit-rencana.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-warning">
            <i class="fas fa-edit"></i>
          </a>
          <button class="btn btn-sm btn-danger btn-hapus" data-id="<?= $item['id'] ?>">
            <i class="fas fa-trash"></i>
          </button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<script>
  $(document).ready(function () {
    $('#tabel-rencana').DataTable({
      "pageLength": 20,
      "columnDefs": [
        { "orderable": false, "targets": 1 } // Kolom Aksi tidak perlu bisa diurutkan
      ]
    });

    // Konfirmasi hapus
    // $('.btn-hapus').on('click', function () {
    //   const id = $(this).data('id');
    //   if (confirm('Apakah Anda yakin ingin menghapus rencana kerja ini?')) {
    //     // Lanjutkan ke aksi hapus, misalnya:
    //     window.location.href = 'hapus-rencana.php?id=' + id;
    //   }
    // });
    $('.btn-hapus').on('click', function () {
    const baseUrl = "<?= base_url() ?>";
    const id = $(this).data('id');
    if (confirm('Apakah Anda yakin ingin menghapus rencana hasil kerja ini?')) {
        window.location.href = baseUrl + 'dashboard/log/rencana_hasil_kerja_atasan/delete/' + id;
    }
});
  });
</script>


<?= $this->endSection() ?>