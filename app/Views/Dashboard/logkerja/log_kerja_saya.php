<?= $this->extend('dashboard/layout/main_layout') ?>
<?= $this->section('content') ?>

<!-- <div class="mb-3">
  <a href="<?= base_url('/dashboard/log/form_log_kerja') ?>" class="btn btn-primary">
    <i class="fas fa-plus"></i> Tambah Kegiatan
  </a>
  <!-- <a href="export-rencana.php" class="btn btn-secondary">
    <i class="fas fa-file-pdf"></i> Export PDF
  </a> -->
<!-- </div> -->
<div class="d-flex justify-content-between align-items-center mb-3">
  <h5 class="mb-0">Log Kegiatan Saya</h4>
    <a href="<?= base_url('/dashboard/log/form_log_kerja') ?>" class="btn btn-primary rounded-pill">
      <i class="fas fa-plus"></i> Tambah Kegiatan
    </a>
</div>
<div class="card card-body table-responsive p-4" style="border-radius: 1rem;">
  <table id="tabel-utama" class="table table-bordered table-striped w-100">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Jam Mulai</th>
        <th>Jam Selesai</th>
        <th>Kegiatan</th>
        <!-- <th>Output</th> -->
        <th>Lokasi</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>

<script>
  // $(document).ready(function() {
  //   $('#tabel-utama').DataTable({
  //     "pageLength": 20,
  //     "columnDefs": [{
  //         "orderable": false,
  //         "targets": 1
  //       } // Kolom Aksi tidak perlu bisa diurutkan
  //     ]
  //   });

  // $('.btn-hapus').on('click', function () {
  // const baseUrl = "<?= base_url() ?>";
  // const id = $(this).data('id');
  // if (confirm('Apakah Anda yakin ingin menghapus rencana hasil kerja ini?')) {
  //     window.location.href = baseUrl + 'dashboard/log/rencana_hasil_kerja_atasan/delete/' + id;
  // }
  // });
  // });
</script>
<script>
  let tabelUtama;


  function initTable(data) {
    tabelUtama = $('#tabel-utama').DataTable({
      data: data,
      columns: [{
          data: 'tanggal'
        },
        {
          data: 'start'
        },
        {
          data: 'end'
        },
        {
          data: 'uraian'
        },
        {
          data: 'lokasi'
        },
        {
          data: null,
          orderable: false,
          searchable: false,
          render: function(data, type, row) {
            return `
              <button class="btn btn-sm btn-warning btn-edit" data-id="${row.id}"><i class="fas fa-edit"></i></button>
              <button class="btn btn-sm btn-danger btn-delete" data-id="${row.id}"><i class="fas fa-trash"></i></button>
            `;
          }
        }
      ],
      destroy: true // agar bisa di-reinit saat reload
    });
  }

  function loadData() {
    $.getJSON("<?= base_url('api/log/get') ?>", function(result) {
      console.log(result);
      if (tabelUtama) {
        tabelUtama.clear().rows.add(result).draw();
      } else {
        initTable(result);
      }
    });
  }

  $(document).ready(function() {
    loadData();
    $('#tabel-utama').on('click', '.btn-edit', function() {
      const id = $(this).data('id');
      window.location.href = "<?= base_url('/dashboard/log/edit_log_kerja/') ?>" + id;
    });

    $('#tabel-utama').on('click', '.btn-delete', function() {
      const id = $(this).data('id');
      if (confirm('Yakin ingin menghapus data log kegiatan ini ?')) {
        $.ajax({
          url: `<?= base_url('api/log/delete/') ?>${id}`,
          type: 'DELETE',
          success: function() {
            $('#status-message').text("kegiatan berhasil dihapus.");
            loadData(); // reload tabel
          },
          error: function() {
            $('#status-message').text("Gagal menghapus data.");
          }
        });
      }
    });
  });
</script>

<?= $this->endSection() ?>