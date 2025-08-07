<?= $this->extend('admin/layout/main_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <form id="pegawaiForm" class="card card-body" action="<?= base_url('/admin/api/ppk/submit') ?>" method="post" class="space-y-4">
        <h4 class="mb-3">Form PPK</h4>
        <?php if (!empty($ppk['id'])): ?>
            <input type="hidden" name="id" value="<?= $ppk['id'] ?>">
        <?php endif; ?>
        <label>Nama Jabatan Pembuat Komitmen</label>
        <input type="text" name="name" class="form-control" required value="<?= old('name', $ppk['nama_ppk'] ?? '') ?>">

        <label class="mt-4">Bidang / Bagian</label>
        <select name="bidang" id="bidang" class="form-control select2">
            <option value="">Pilih Bidang</option>
            <?php foreach ($bidang as $b): ?>
                <option value="<?= $b['id'] ?>" <?= old('bidang', $ppk['bidang_id'] ?? '') == $b['id'] ? 'selected' : '' ?>><?= $b['nama_bidang'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="mt-4 mb-4">
            <label>Satker</label>
            <select name="tim" id="tim" class="form-control select2"></select>
        </div>
        <button class="btn btn-primary mt-3" type="submit">Simpan</button>
    </form>
</div>

<?php if (!empty($ppk)): ?>
    <script>
        const old_bidang_id = <?= json_encode($ppk['bidang_id']) ?? 0 ?>;
        const old_tim = <?= json_encode(old('tim', $ppk['satker_id'] ?? 0)) ?>;

        document.addEventListener('DOMContentLoaded', () => {
            fetchOptions(old_bidang_id, '#tim', '<?= base_url("admin/api/get/tim") ?>', old_tim);
        });
    </script>
<?php endif ?>

<script>
    const satker_ids = <?= json_encode($satker_ids) ?>;
    const bidang_kpi_id = <?= json_encode($bidang_kpi_id) ?>;

    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%', // WAJIB agar responsif & tidak terlihat sempit
            placeholder: 'Pilih opsi...',
            allowClear: true
        });
    });

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

    $('#bidang').on('change', function() {
        const id = $(this).val();
        fetchOptions(id, '#tim', '<?= base_url("admin/api/get/tim") ?>', null);
    });
</script>
<?= $this->endSection() ?>