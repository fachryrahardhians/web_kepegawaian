<?= $this->extend('dashboard/layout/main_layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8 mt-4">
            <div class="card shadow-sm table-responsive">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title mb-0 font-weight-bold">Profil Anda</h3>
                </div>
                <div class="card-body">
                    <table class="table table-underline mb-0">
                        <tbody>
                            <tr>
                                <td class="font-weight-bold text-nowrap">Nama</td>
                                <td><?= $pegawai['nama'] ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-nowrap">NIP</td>
                                <td><?= $pegawai['nip'] ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-nowrap">Golongan</td>
                                <td><?= $pegawai['golongan'] ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-nowrap">Email</td>
                                <td><?= $pegawai['email'] ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-nowrap">Jabatan</td>
                                <td><?= $pegawai['nama_jabatan_utama'] . ' ' .  $pegawai['nama_ppk_utama'] . ' ' . $pegawai['nama_tim_utama'] . ' ' . $pegawai['nama_bidang_utama'] ?></td>
                            </tr>
                            <?php if ($pegawai['jabatan_rangkap_id'] != '0'): ?>
                                <tr>
                                    <td class="font-weight-bold text-nowrap">Jabatan Rangkap</td>
                                    <td><?= $pegawai['nama_jabatan_rangkap'] . ' ' .  $pegawai['nama_ppk_rangkap'] . ' ' . $pegawai['nama_tim_rangkap'] . ' ' . $pegawai['nama_bidang_rangkap'] ?></td>
                                </tr>
                            <?php endif ?>
                            <tr>
                                <td class="font-weight-bold text-nowrap">No WhatsApp</td>
                                <td><?= $pegawai['no_wa'] ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-nowrap">Jenis Kelamin</td>
                                <td><?= (!empty($pegawai['gender'])) ? ($pegawai['gender'] == 'L') ? 'Laki-laki' : 'Perempuan' : '-' ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-right mt-3">
                        <a href="<?= base_url('dashboard/profil/edit') ?>">
                            <button class="btn btn-warning rounded-pill px-4">
                                Edit Data
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>