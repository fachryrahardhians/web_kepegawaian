<?= $this->extend('dashboard/layout/main_layout') ?>
<?= $this->section('content') ?>

<table id="tabel-utama" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Kegiatan</th>
            <th>Output</th>
            <th>Lokasi</th>
            <th style="width: 120px;">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($log_kerja as $item): ?>
            <tr>
                <td><?= esc($item['tanggal']) ?></td>
                <td><?= esc($item['start']) ?></td>
                <td><?= esc($item['end']) ?></td>
                <td><?= esc($item['uraian']) ?></td>
                <td><?= esc($item['output']) ?></td>
                <td><?= esc($item['lokasi']) ?></td>
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