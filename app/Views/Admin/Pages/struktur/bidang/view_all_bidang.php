<?= $this->extend('admin/layout/main_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Bidang / Bagian</h4>
        <a href="<?= base_url('admin/struktur/bidang/tambah') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah
        </a>
    </div>

    <div class="card" style="border-radius: 1rem;">
        <div class="card-body table-responsive">
            <table id="tabelBidang" class="table table-bordered table-hover text-nowrap">
                <thead class="bg-light text-center">
                    <tr>
                        <th>Nama Bidang</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bidang as $row): ?>
                        <tr>
                            <td><?= esc($row['nama_bidang']) ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('admin/struktur/bidang/edit/' . $row['id']) ?>" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">

<!-- DataTables JS + Bootstrap 4 Integration -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabelBidang').DataTable({
            responsive: true,
            autoWidth: false,
            language: {
                search: "Cari:",
                lengthMenu: "Tampilkan _MENU_ data",
                info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                paginate: {
                    first: "Awal",
                    last: "Akhir",
                    next: "›",
                    previous: "‹"
                },
                zeroRecords: "Data tidak ditemukan",
            }
        });
    });
</script>

<?= $this->endSection() ?>