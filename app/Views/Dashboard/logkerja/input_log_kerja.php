<?= $this->extend('dashboard/layout/main_layout') ?>
<?= $this->section('content') ?>
<style>
  .lampiran-item a {
    word-break: break-all;
  }
</style>
<div class="container py-4">
  <form class="card card-body space-y-4" action="<?= base_url('/dashboard/log/submit') ?>" method="post" enctype="multipart/form-data" style="border-radius: 1rem;">
    <?= csrf_field() ?>

    <?php if (!empty($log_kerja['id'])): ?>
      <input type="hidden" name="id" value="<?= $log_kerja['id'] ?>">
    <?php endif; ?>

    <!-- Row Tanggal + Jam -->
    <div class="row g-3">
      <div class="col-md-4">
        <label for="tanggal" class="form-label">Tanggal <span class="text-danger">*</span></label>
        <input type="date" name="tanggal" id="tanggal" class="form-control" required value="<?= old('tanggal', $log_kerja['tanggal'] ?? date('Y-m-d')) ?>">
      </div>
      <div class="col-6 col-md-4">
        <label for="jam_mulai" class="form-label">Jam Mulai</label>
        <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" value="<?= old('jam_mulai', $log_kerja['start'] ?? '') ?>">
      </div>
      <div class="col-6 col-md-4">
        <label for="jam_selesai" class="form-label">Jam Selesai</label>
        <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" value="<?= old('jam_selesai', $log_kerja['end'] ?? '') ?>">
      </div>
    </div>

    <!-- Deskripsi Pekerjaan -->
    <div class="mt-3">
      <label for="deskripsi" class="form-label">Deskripsi Pekerjaan <span class="text-danger">*</span></label>
      <input type="text" name="deskripsi" id="deskripsi" class="form-control" required maxlength="100" value="<?= old('deskripsi', $log_kerja['uraian'] ?? '') ?>">
    </div>

    <!-- Output -->
    <div class="mt-3">
      <label for="output" class="form-label">Output <span class="text-danger">*</span></label>
      <input type="text" name="output" id="output" class="form-control" required maxlength="100" value="<?= old('output', $log_kerja['output'] ?? '') ?>">
    </div>

    <!-- Lokasi -->
    <div class="mt-3">
      <label for="lokasi" class="form-label">Lokasi</label>
      <input type="text" name="lokasi" id="lokasi" class="form-control" maxlength="100" value="<?= old('lokasi', $log_kerja['lokasi'] ?? '') ?>">
    </div>

    <?php if (!empty($lampiran_old)): ?>
      <div class="mt-4">
        <label class="form-label">Bukti Pendukung Sebelumnya</label>
        <div id="lampiran-lama">
          <?php foreach ($lampiran_old as $item): ?>
            <div class="border p-2 rounded w-100 mb-3 lampiran-item" id="lampiran-<?= $item['id'] ?>">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <a href="<?= base_url("api/log/view/lampiran/" . $item['id']) ?>" target="blank" class="text-primary text-break m-0">
                    <p><?= $item['filename'] ?></p>
                  </a>
                  <small class="text-muted"><?= esc($item['deskripsi']) ?></small>
                </div>
                <button type="button" class="btn btn-sm btn-outline-danger w-md-auto btn-hapus-lampiran" data-id="<?= $item['id'] ?>">
                  <i class="fas fa-trash"></i>
                </button>

              </div>

            </div>
          <?php endforeach ?>
        </div>
      </div>
    <?php endif; ?>




    <!-- Bukti Pendukung -->
    <div class="mt-4">
      <label class="form-label">Bukti Pendukung</label>
      <div id="bukti-container">
        <div class="row g-2 bukti-item mb-2 align-items-center">
          <div class="col-md-5">
            <div class="custom-file">
              <input type="file" name="bukti_file[]" id="bukti_file" class="form-control bukti-file">
              <label for="bukti_file" class="custom-file-label"></label>
            </div>
          </div>
          <div class="col-md-5">
            <input type="text" name="bukti_deskripsi[]" class="form-control bukti-deskripsi" placeholder="Deskripsi file">
          </div>
          <div class="col-md-2 text-end">
            <button type="button" class="btn btn-secondary btn-sm btn-remove-bukti"><i class="fa-solid fa-trash"></i></button>
          </div>
        </div>
      </div>
      <button type="button" id="add-bukti" class="btn btn-sm btn-secondary mt-2">+ Tambah File</button>
    </div>

    <!-- Submit -->
    <div class="mt-4">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>


<!-- JS: Tambah dan Hapus Bukti -->
<script>
  let counter = 0;

  function addBuktiRow() {
    const container = document.getElementById('bukti-container');
    // const rand = Math.floor(Math.random() * 100);
    counter++;
    const idFile = 'bukti_file_' + counter;
    const item = document.createElement('div');
    item.classList.add('row', 'g-2', 'bukti-item', 'mb-2', 'align-items-center');
    item.innerHTML = `
            <div class="col-md-5">
            <div class="custom-file">
              <input type="file" name="bukti_file[]" id="${idFile}" class="form-control bukti-file">
              <label for="${idFile}" class="custom-file-label"></label>
            </div>
          </div>
          <div class="col-md-5">
            <input type="text" name="bukti_deskripsi[]" class="form-control bukti-deskripsi" placeholder="Deskripsi file">
          </div>
          <div class="col-md-2 text-end">
            <button type="button" class="btn btn-secondary btn-sm btn-remove-bukti"><i class="fa-solid fa-trash"></i></button>
          </div>
        `;

    container.appendChild(item);
  }

  // Tambah bukti baru
  document.getElementById('add-bukti').addEventListener('click', addBuktiRow);

  // Delegasi: Hapus bukti
  document.getElementById('bukti-container').addEventListener('click', function(e) {
    if (e.target.classList.contains('btn-remove-bukti')) {
      const item = e.target.closest('.bukti-item');
      item.remove();
    }
  });

  document.addEventListener('change', function(e) {
    if (e.target.matches('.custom-file input[type="file"]')) {
      const input = e.target;
      const label = input.nextElementSibling;
      const fileNames = Array.from(input.files).map(f => f.name).join(', ');
      if (label && label.classList.contains('custom-file-label')) {
        label.textContent = fileNames;
      }
    }
  });

  document.addEventListener('DOMContentLoaded', function() {
    bsCustomFileInput.init();
  });
</script>
<script>
  $(document).ready(function() {
    $('.btn-hapus-lampiran').click(function() {
      const id = $(this).data('id');
      if (confirm('Yakin ingin menghapus lampiran ?')) {
        $.ajax({
          url: '<?= base_url("api/log/delete/lampiran/") ?>' + id,
          type: 'DELETE',
          success: function(response) {
            $('#lampiran-' + id).fadeOut(300, function() {
              $(this).remove();
            });
          },
          error: function() {
            alert("Gagal Menghapus Lampiran");
          }
        });
      }
    });
  });
</script>



<?= $this->endSection() ?>