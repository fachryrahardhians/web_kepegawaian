<?= $this->extend('admin/layout/main_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Data Pegawai</h4>
        <a href="<?= base_url('admin/pegawai/tambah') ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah
        </a>
    </div>

    <div class="card" style="border-radius: 1rem;">
        <div class="card-body table-responsive">
            <table id="tabelPegawai" class="table table-bordered table-hover text-nowrap">
                <thead class="bg-light text-center">
                    <tr>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Bidang</th>
                        <th>Akun</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pegawai as $row): ?>
                        <tr>
                            <td><?= esc($row['nama']) ?></td>
                            <td><?= esc($row['nip']) ?></td>
                            <td><?= esc($row['nama_bidang']) ?></td>
                            <td><?= esc($row['status'] == '1' ? 'Aktif ✅' : 'Non Aktif 🟥') ?></td>
                            <!-- <td><?= esc($row['nama_jabatan']) ?></td> -->
                            <!-- <td><?= esc($row['nama_bidang']) ?></td> -->
                            <td class="text-center">
                                <a href="<?= base_url('admin/pegawai/edit/' . $row['id']) ?>" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!-- <a href="<?= base_url('pegawai/' . $row['id']) ?>" class="btn btn-sm btn-info" title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="<?= base_url('pegawai/' . $row['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form> -->
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
        $('#tabelPegawai').DataTable({
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