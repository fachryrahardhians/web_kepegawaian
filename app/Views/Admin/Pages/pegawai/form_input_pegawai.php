<?= $this->extend('admin/layout/main_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <form id="pegawaiForm" class="card card-body" action="<?= base_url('/admin/pegawai/submit') ?>" method="post" class="space-y-4">
        <h4 class="mb-3">Form Pegawai</h4>

        <?php if (!empty($pegawai['id'])): ?>
            <input type="hidden" name="id" value="<?= $pegawai['id'] ?>">
        <?php endif; ?>

        <div class="row">
            <!-- NIP -->
            <div class="col-md-6 mb-3">
                <label>NIP</label>
                <input type="text" name="nip" class="form-control" pattern="\d{18}" maxlength="18" required value="<?= old('nip', $pegawai['nip'] ?? '') ?>">
            </div>
            <!-- Nama -->
            <div class="col-md-6 mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" required value="<?= old('nama_lengkap', $pegawai['nama'] ?? '') ?>">
            </div>
            <!-- Golongan -->
            <div class="col-md-6 mb-3">
                <label for="golongan">Golongan</label>
                <select name="golongan" id="golongan" class="form-control select2" required>
                    <option value="">-- Pilih Golongan --</option>
                    <option value="IA" <?= old('golongan', $pegawai['golongan'] ?? '') == "IA" ? 'selected' : '' ?>>I A</option>
                    <option value="IB" <?= old('golongan', $pegawai['golongan'] ?? '') == "IB" ? 'selected' : '' ?>>I B</option>
                    <option value="IC" <?= old('golongan', $pegawai['golongan'] ?? '') == "IC" ? 'selected' : '' ?>>I C</option>
                    <option value="ID" <?= old('golongan', $pegawai['golongan'] ?? '') == "ID" ? 'selected' : '' ?>>I D</option>
                    <option value="IIA" <?= old('golongan', $pegawai['golongan'] ?? '') == "IIA" ? 'selected' : '' ?>>II A</option>
                    <option value="IIB" <?= old('golongan', $pegawai['golongan'] ?? '') == "IIB" ? 'selected' : '' ?>>II B</option>
                    <option value="IIC" <?= old('golongan', $pegawai['golongan'] ?? '') == "IIC" ? 'selected' : '' ?>>II C</option>
                    <option value="IID" <?= old('golongan', $pegawai['golongan'] ?? '') == "IID" ? 'selected' : '' ?>>II D</option>
                    <option value="IIIA" <?= old('golongan', $pegawai['golongan'] ?? '') == "IIIA" ? 'selected' : '' ?>>III A</option>
                    <option value="IIIB" <?= old('golongan', $pegawai['golongan'] ?? '') == "IIIB" ? 'selected' : '' ?>>III B</option>
                    <option value="IIIC" <?= old('golongan', $pegawai['golongan'] ?? '') == "IIIC" ? 'selected' : '' ?>>III C</option>
                    <option value="IIID" <?= old('golongan', $pegawai['golongan'] ?? '') == "IIID" ? 'selected' : '' ?>>III D</option>
                    <option value="IVA" <?= old('golongan', $pegawai['golongan'] ?? '') == "IVA" ? 'selected' : '' ?>>IV A</option>
                    <option value="IVB" <?= old('golongan', $pegawai['golongan'] ?? '') == "IVB" ? 'selected' : '' ?>>IV B</option>
                    <option value="IVC" <?= old('golongan', $pegawai['golongan'] ?? '') == "IVC" ? 'selected' : '' ?>>IV C</option>
                    <option value="IVD" <?= old('golongan', $pegawai['golongan'] ?? '') == "IVD" ? 'selected' : '' ?>>IV D</option>
                </select>
            </div>
            <!-- Nomor WA -->
            <div class="col-md-6 mb-3">
                <label>Nomor WhatsApp</label>
                <input type="text" name="wa" class="form-control" value="<?= old('', $pegawai['no_wa'] ?? '') ?>" required>
            </div>
            <!-- Email -->
            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required value="<?= old('', $pegawai['email'] ?? '') ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label for="status_acc">Status Akun</label>
                <select name="status_acc" id="status_acc" class="form-control select2" required>
                    <option value="">-- Pilih Golongan --</option>
                    <option value="1" <?= old('status_acc', $account['status'] ?? '') == "1" ? 'selected' : '' ?>>Aktif ✅</option>
                    <option value="0" <?= old('status_acc', $account['status'] ?? '') == "0" ? 'selected' : '' ?>>Non Aktif 🟥</option>
                </select>
            </div>
        </div>

        <hr>
        <h5>Jabatan Utama</h5>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Bidang/Bagian</label>
                <select name="bidang_utama" id="bidang_utama" class="form-control select2">
                    <option value="">Pilih Bidang</option>
                    <?php foreach ($bidangs as $b): ?>
                        <option value="<?= $b['id'] ?>" <?= old('bidang_utama', $pegawai['bidang_id'] ?? '') == $b['id'] ? 'selected' : '' ?>><?= $b['nama_bidang'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label>Tim / Satker</label>
                <select name="tim_utama" id="tim_utama" class="form-control select2"></select>
            </div>
            <div class="col-md-6 mb-3">
                <label>PPK</label>
                <select name="ppk_utama" id="ppk_utama" class="form-control select2"></select>
            </div>
            <div class="col-md-6 mb-3">
                <label>Jabatan</label>
                <select name="jabatan_utama" class="form-control select2" required>
                    <option value="">Pilih Jabatan</option>
                    <?php foreach ($jabatans as $j): ?>
                        <option value="<?= $j['id'] ?>" <?= old('jabatan_utama', $pegawai['jabatan_id'] ?? '') == $j['id'] ? 'selected' : '' ?>><?= $j['nama_jabatan'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <hr>
        <div class="form-check form-switch mb-3 ms-4">
            <input class="form-check-input" type="checkbox" id="toggleRangkap" name="toggleRangkap">
            <label class="form-check-label" for="toggleRangkap">
                <h5>Jabatan Rangkap</h5>
            </label>
        </div>

        <div id="jabatanRangkapSection" style="display: none;">
            <!-- <h5>Jabatan Rangkap</h5> -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Bidang / Bagian</label>
                    <select name="bidang_rangkap" id="bidang_rangkap" class="form-control select2">
                        <option value="">Pilih Bidang</option>
                        <?php foreach ($bidangs as $b): ?>
                            <option value="<?= $b['id'] ?>" <?= old('bidang_rangkap', $pegawai['bidang_rangkap_id'] ?? '') == $b['id'] ? 'selected' : '' ?>><?= $b['nama_bidang'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Tim / Satker</label>
                    <select name="tim_rangkap" id="tim_rangkap" class="form-control select2"></select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>PPK</label>
                    <select name="ppk_rangkap" id="ppk_rangkap" class="form-control select2"></select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Jabatan</label>
                    <select name="jabatan_rangkap" class="form-control select2" id="jabatan_rangkap">
                        <option value="">Pilih Jabatan</option>
                        <?php foreach ($jabatans as $j): ?>
                            <option value="<?= $j['id'] ?>" <?= old('jabatan_', $pegawai['jabatan_rangkap_id'] ?? '') == $j['id'] ? 'selected' : '' ?>><?= $j['nama_jabatan'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <button class="btn btn-primary mt-3" type="submit">Simpan</button>
    </form>
</div>

<?php if (!empty($pegawai)): ?>
    <script>
        const old_bidang_id = <?= json_encode($pegawai['bidang_id']) ?? 0 ?>;
        const old_tim_id = <?= json_encode($pegawai['tim_id']) ?? 0 ?>;
        const old_bidang_rangkap_id = <?= json_encode($pegawai['bidang_rangkap_id']) ?? 0 ?>;
        const old_tim_rangkap_id = <?= json_encode($pegawai['tim_rangkap_id']) ?? 0 ?>;


        const old_bidang = <?= json_encode(old('bidang_utama', $pegawai['bidang_id'] ?? 0)) ?>;
        const old_tim = <?= json_encode(old('tim_utama', $pegawai['tim_id'] ?? 0)) ?>;
        const old_ppk = <?= json_encode(old('ppk_utama', $pegawai['bidang_id'] ?? 0)) ?>;
        const old_bidang_rangkap = <?= json_encode(old('bidang', $pegawai['bidang_rangkap_id'] ?? 0)) ?>;
        const old_tim_rangkap = <?= json_encode(old('bidang', $pegawai['tim_rangkap_id'] ?? 0)) ?>;
        const old_ppk_rangkap = <?= json_encode(old('bidang', $pegawai['ppk_rangkap_id']) ?? 0) ?>;

        document.addEventListener('DOMContentLoaded', () => {
            // lakukan inisiasi ketika form digunakan untuk edit data 
            if (old_tim_rangkap_id != 0 && old_bidang_rangkap_id != 0) {
                $('#jabatanRangkapSection').toggle(1);
                $('#toggleRangkap').prop('checked', true);

                // if (satker_ids.includes(parseInt(old_tim_rangkap_id))) {
                // jika termasuk satker, kemudian cari ppk
                fetchOptionsWithTim(old_tim_rangkap_id, '#ppk_rangkap', '<?= base_url("admin/pegawai/getPpk") ?>', old_ppk_rangkap);
                // } else {
                //     nulifyOption('#ppk_rangkap');
                // }

                // if (bidang_kpi_id == old_bidang_rangkap_id) {
                fetchOptions(old_bidang_rangkap_id, '#tim_rangkap', '<?= base_url("admin/pegawai/getTim") ?>', old_tim_rangkap);
                fetchOptionsWithTim(0, '#ppk_rangkap', '<?= base_url("admin/pegawai/getPpk") ?>', old_ppk_rangkap);
                // } else {
                //     fetchOptions(old_bidang_rangkap_id, '#tim_rangkap', '<?= base_url("admin/pegawai/getTim") ?>', old_tim_rangkap);
                //     nulifyOption('#ppk_rangkap');
                // }
            }


            // if (satker_ids.includes(parseInt(old_tim_id))) {
            // jika termasuk satker, kemudian cari ppk
            fetchOptionsWithTim(old_tim_id, '#ppk_utama', '<?= base_url("admin/pegawai/getPpk") ?>', old_ppk);
            // } else {
            //     nulifyOption('#ppk_utama');
            // }

            // if (bidang_kpi_id == old_bidang_id) {
            fetchOptions(old_bidang_id, '#tim_utama', '<?= base_url("admin/pegawai/getTim") ?>', old_tim);
            fetchOptionsWithTim(old_tim_id, '#ppk_utama', '<?= base_url("admin/pegawai/getPpk") ?>', old_ppk);
            // } else {
            //     fetchOptions(old_bidang_id, '#tim_utama', '<?= base_url("admin/pegawai/getTim") ?>', old_tim);
            //     nulifyOption('#ppk_utama');
            // }


        });
    </script>
<?php endif; ?>

<script>
    const satker_ids = <?= json_encode($satker_ids) ?>;
    const bidang_kpi_id = <?= json_encode($bidang_kpi_id) ?>;

    function nulifyOption(target) {
        let html = '<option value="">Pilih</option>';
        html += `<option value="">Tidak Ditemukan</option>`;
        $(target).html(html).prop('disabled', true).trigger('change.select2');
    }

    function fetchOptions(bidangId, target, url, old_data) {
        $.get(url, {
            bidang_id: bidangId
        }, function(data) {
            let html = '<option value="">Pilih</option>';
            data.forEach(function(item) {
                const selected = (old_data != null) ? (item.id == old_data) ? 'selected' : '' : '';
                html += `<option value="${item.id}" ${selected}>${item.nama}</option>`;
            });
            $(target).html(html).prop('disabled', false).trigger('change.select2');
        });
    }

    function fetchOptionsWithTim(timId, target, url, old_data) {
        $.get(url, {
            tim_id: timId
        }, function(data) {
            let html = '<option value="">Pilih</option>';
            data.forEach(function(item) {
                const selected = (old_data != null) ? (item.id == old_data) ? 'selected' : '' : '';
                html += `<option value="${item.id}" ${selected}>${item.nama}</option>`;
            });
            $(target).html(html).prop('disabled', false).trigger('change.select2');
        });
    }

    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%', // WAJIB agar responsif & tidak terlihat sempit
            placeholder: 'Pilih opsi...',
            allowClear: true
        });

        $('#toggleRangkap').on('change', function() {
            $('#jabatanRangkapSection').toggle(this.checked);
        });


        $('#bidang_utama').on('change', function() {
            const id = $(this).val();
            if (bidang_kpi_id == id) {
                fetchOptions(id, '#tim_utama', '<?= base_url("admin/pegawai/getTim") ?>', null);
                fetchOptionsWithTim(0, '#ppk_utama', '<?= base_url("admin/pegawai/getPpk") ?>', null);
            } else {
                fetchOptions(id, '#tim_utama', '<?= base_url("admin/pegawai/getTim") ?>', null);
                nulifyOption('#ppk_utama');
            }
        });

        $('#bidang_rangkap').on('change', function() {
            const id = $(this).val();
            if (bidang_kpi_id == id) {
                fetchOptions(id, '#tim_rangkap', '<?= base_url("admin/pegawai/getTim") ?>', null);
                fetchOptionsWithTim(0, '#ppk_rangkap', '<?= base_url("admin/pegawai/getPpk") ?>',
                    null);
            } else {
                fetchOptions(id, '#tim_rangkap', '<?= base_url("admin/pegawai/getTim") ?>', null);
                nulifyOption('#ppk_rangkap');
            }
        });

        $('#tim_utama').on('change', function() {
            // const id = $(this).val();
            // if (satker_ids.includes(parseInt(id))) {
            // jika termasuk satker, kemudian cari ppk
            fetchOptionsWithTim(id, '#ppk_utama', '<?= base_url("admin/pegawai/getPpk") ?>', null);
            // } else {
            // nulifyOption('#ppk_utama');
            // }

        });

        $('#tim_rangkap').on('change', function() {
            // const id = $(this).val();
            // if (satker_ids.includes(parseInt(id))) {
            // jika termasuk satker, kemudian cari ppk
            fetchOptionsWithTim(id, '#ppk_rangkap', '<?= base_url("admin/pegawai/getPpk") ?>', null);
            // } else {
            // nulifyOption('#ppk_rangkap');
            // }        
        });

        $('#toggleRangkap').on('change', function() {
            const value = $(this).val();
            if (value) {
                //
            } else {
                // set semua rangkap menjadi kosong
                $('#bidang_rangkap').val('').trigger('change');
                $('#tim_rangkap').val('').trigger('change');
                $('#ppk_rangkap').val('').trigger('change');
                $('#jabatan_rangkap').val('').trigger('change');
            }

        });
    });
</script>

<?= $this->endSection() ?>