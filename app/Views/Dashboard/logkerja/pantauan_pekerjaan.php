<?= $this->extend('dashboard/layout/main_layout') ?>
<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h5 class="mb-0">Log Kegiatan Anggota</h4>
</div>
<div class="card card-body table-responsive p-4" style="border-radius: 1rem;">
    <table id="tabel-utama" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Kegiatan</th>
                <th>Tanggal</th>
                <th>Jam Mulai</th>
                <th style="width: 120px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($log_pekerjaan as $item): ?>
                <tr>
                    <td><?= esc($item->nama) ?></td>
                    <td><?= esc($item->uraian) ?></td>
                    <td><?= esc($item->tanggal) ?></td>
                    <td><?= esc($item->start) ?></td>
                    <td>
                        <a href="edit-rencana.php?id=<?= $item->id ?>" class="btn btn-sm btn-warning">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#tabel-utama').DataTable({
            "pageLength": 20,
            "columnDefs": [{
                    "orderable": false,
                    "targets": 1
                } // Kolom Aksi tidak perlu bisa diurutkan
            ]
        });

        // $('.btn-hapus').on('click', function () {
        // const baseUrl = "<?= base_url() ?>";
        // const id = $(this).data('id');
        // if (confirm('Apakah Anda yakin ingin menghapus rencana hasil kerja ini?')) {
        //     window.location.href = baseUrl + 'dashboard/log/rencana_hasil_kerja_atasan/delete/' + id;
        // }
        // });
    });
</script>

<?= $this->endSection() ?>