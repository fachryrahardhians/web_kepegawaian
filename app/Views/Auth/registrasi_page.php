<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi Pengguna</title>

    <!-- Bootstrap & AdminLTE CSS -->
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />

    <style>
        body {
            background-color: #1d3468;
            font-family: 'Segoe UI', sans-serif;
        }

        .card-custom {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .btn-gold {
            background-color: #fdb810;
            color: #1d3468;
        }

        .btn-gold:hover {
            background-color: #e0a500;
            color: white;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card w-100 card-custom" style="max-width: 700px;">
            <h3 class="text-center mb-4 text-primary">Form Registrasi</h3>

            <form id="registerForm" method="post" action="<?= base_url('/registrasi/submit') ?>">
                <!-- STEP 1 -->
                <div class="step active" id="step1">
                    <div class="form-group">
                        <label>Nama Lengkap *</label>
                        <input type="text" name="nama_lengkap" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>No WhatsApp *</label>
                        <input type="text" name="no_wa" class="form-control" pattern="[0-9]{10,13}" required>
                    </div>
                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Golongan*</label>
                        <select name="golongan" class="form-control select2" required>
                            <option value="">-- Pilih Golongan --</option>
                            <option value="IA">I A</option>
                            <option value="IB">I B</option>
                            <option value="IC">I C</option>
                            <option value="ID">I D</option>
                            <option value="IIA">II A</option>
                            <option value="IIB">II B</option>
                            <option value="IIC">II C</option>
                            <option value="IID">II D</option>
                            <option value="IIIA">III A</option>
                            <option value="IIIB">III B</option>
                            <option value="IIIC">III C</option>
                            <option value="IIID">III D</option>
                            <option value="IVA">IV A</option>
                            <option value="IVB">IV B</option>
                            <option value="IVC">IV C</option>
                            <option value="IVD">IV D</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>NIP *</label>
                        <input type="text" name="nip" id="nip" class="form-control" pattern="[0-9]{18}" required>
                    </div>
                    <button type="button" class="btn btn-gold float-right" onclick="nextStep(1)">Lanjut</button>
                </div>

                <!-- STEP 2 -->
                <div class="step" id="step2">
                    <div class="form-group">
                        <label>Bidang/Bagian</label>
                        <select name="bidang_utama" id="bidang_utama" class="form-control select2">
                            <option value="">Pilih Bidang</option>
                            <?php foreach ($bidangs as $b): ?>
                                <option value="<?= $b['id'] ?>"><?= $b['nama_bidang'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tim / Satker</label>
                        <select name="tim_utama" id="tim_utama" class="form-control select2"></select>
                    </div>
                    <div class="form-group">
                        <label>PPK</label>
                        <select name="ppk_utama" id="ppk_utama" class="form-control select2"></select>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select name="jabatan_utama" class="form-control select2" required>
                            <option value="">Pilih Jabatan</option>
                            <?php foreach ($jabatans as $j): ?>
                                <option value="<?= $j['id'] ?>"><?= $j['nama_jabatan'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-check form-switch mb-3 ms-4">
                        <input class="form-check-input" type="checkbox" id="toggleRangkap" name="toggleRangkap">
                        <label class="form-check-label" for="toggleRangkap">
                            <h5>Jabatan Rangkap</h5>
                        </label>
                    </div>
                    <div id="jabatanRangkapSection" style="display: none;">
                        <div class="form-group">
                            <label>Bidang / Bagian</label>
                            <select name="bidang_rangkap" id="bidang_rangkap" class="form-control select2">
                                <option value="">Pilih Bidang</option>
                                <?php foreach ($bidangs as $b): ?>
                                    <option value="<?= $b['id'] ?>"><?= $b['nama_bidang'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tim / Satker</label>
                            <select name="tim_rangkap" id="tim_rangkap" class="form-control select2"></select>
                        </div>
                        <div class="form-group">
                            <label>PPK</label>
                            <select name="ppk_rangkap" id="ppk_rangkap" class="form-control select2"></select>
                        </div>
                        <div class="form-group">
                            <label>Jabatan</label>
                            <select name="jabatan_rangkap" class="form-control select2" id="jabatan_rangkap">
                                <option value="">Pilih Jabatan</option>
                                <?php foreach ($jabatans as $j): ?>
                                    <option value="<?= $j['id'] ?>"><?= $j['nama_jabatan'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-secondary" onclick="prevStep(2)">Kembali</button>
                        <button type="button" class="btn btn-gold" onclick="nextStep(2)">Lanjut</button>
                    </div>

                </div>

                <!-- STEP 3 -->
                <div class="step" id="step3">
                    <div class="form-group">
                        <label for="disabled_username">Username*</label>
                        <input type="text" name="disabled_username" id="disabled_username" class="form-control" required disabled>
                    </div>
                    <div class="form-group">
                        <label for="password">Password *</label>
                        <div class="input-group">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" minlength="8" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()" tabindex="-1">
                                    <i id="togglePasswordIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <button type="button" class="btn btn-secondary" onclick="prevStep(3)">Kembali</button>
                        <button type="submit" class="btn btn-gold">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/build/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // const satker_ids = <?= json_encode($satker_ids) ?>;
        // const bidang_kpi_id = <?= json_encode($bidang_kpi_id) ?>;


        function togglePassword() {
            const passwordInput = document.getElementById("password");
            const icon = document.getElementById("togglePasswordIcon");
            const isPassword = passwordInput.type === "password";

            passwordInput.type = isPassword ? "text" : "password";
            icon.classList.toggle("fa-eye", !isPassword);
            icon.classList.toggle("fa-eye-slash", isPassword);
        }

        function nextStep(step) {
            const current = document.getElementById('step' + step);
            const inputs = current.querySelectorAll('input, select');
            for (const input of inputs) {
                if (!input.checkValidity()) {
                    input.reportValidity();
                    return;
                }
            }
            current.classList.remove('active');
            document.getElementById('step' + (step + 1)).classList.add('active');
        }

        function prevStep(step) {
            document.getElementById('step' + step).classList.remove('active');
            document.getElementById('step' + (step - 1)).classList.add('active');
        }

        function fetchOptions(bidangId, target, url) {
            $.get(url, {
                bidang_id: bidangId
            }, function(data) {
                let html = '<option value="">Pilih</option>';
                data.forEach(function(item) {
                    html += `<option value="${item.id}">${item.nama}</option>`;
                });
                $(target).html(html).prop('disabled', false).trigger('change.select2');
            });
        }

        function fetchOptionsWithTim(timId, target, url) {
            $.get(url, {
                tim_id: timId
            }, function(data) {
                let html = '<option value="">Pilih</option>';
                data.forEach(function(item) {
                    html += `<option value="${item.id}" >${item.nama}</option>`;
                });
                $(target).html(html).prop('disabled', false).trigger('change.select2');
            });
        }

        function nulifyOption(target) {
            let html = '<option value="">Pilih</option>';
            html += `<option value="">Tidak Ditemukan</option>`;
            $(target).html(html).prop('disabled', true).trigger('change.select2');
        }

        $(document).ready(function() {
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%', // WAJIB agar responsif & tidak terlihat sempit
                placeholder: 'Pilih opsi...',
                allowClear: true
            });


            $('#nip').on('input', function() {
                $('#disabled_username').val($(this).val());
            });

            $('#toggleRangkap').on('change', function() {
                $('#jabatanRangkapSection').toggle(this.checked);
            });


            $('#bidang_utama').on('change', function() {
                const id = $(this).val();
                // if (bidang_kpi_id == id) {
                //     fetchOptions(id, '#tim_utama', '<?= base_url("api/get/tim") ?>');
                //     fetchOptionsWithTim(0, '#ppk_utama', '<?= base_url("api/get/ppk") ?>');
                // } else {
                fetchOptions(id, '#tim_utama', '<?= base_url("api/get/tim") ?>');
                nulifyOption('#ppk_utama');
                // }
            });

            $('#bidang_rangkap').on('change', function() {
                const id = $(this).val();
                // if (bidang_kpi_id == id) {
                //     fetchOptions(id, '#tim_rangkap', '<?= base_url("api/get/tim") ?>');
                //     fetchOptionsWithTim(0, '#ppk_rangkap', '<?= base_url("api/get/ppk") ?>');
                // } else {
                fetchOptions(id, '#tim_rangkap', '<?= base_url("api/get/tim") ?>');
                nulifyOption('#ppk_rangkap');
                // }
            });

            $('#tim_utama').on('change', function() {
                const id = $(this).val();
                // if (satker_ids.includes(parseInt(id))) {
                // jika termasuk satker, kemudian cari ppk
                fetchOptionsWithTim(id, '#ppk_utama', '<?= base_url("api/get/ppk") ?>');
                // } else {
                //     nulifyOption('#ppk_utama');
                // }

            });

            $('#tim_rangkap').on('change', function() {
                const id = $(this).val();
                // if (satker_ids.includes(parseInt(id))) {
                // jika termasuk satker, kemudian cari ppk
                fetchOptionsWithTim(id, '#ppk_rangkap', '<?= base_url("api/get/ppk") ?>');
                // } else {
                //     nulifyOption('#ppk_rangkap');
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

</body>

</html>