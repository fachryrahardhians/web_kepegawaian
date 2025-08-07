<?= $this->extend('admin/layout/main_layout') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <form id="pegawaiForm" class="card card-body" action="<?= base_url('/admin/api/tim/submit') ?>" method="post" class="space-y-4">
        <h4 class="mb-3">Form Tim / Satker</h4>

        <?php if (!empty($tim['id'])): ?>
            <input type="hidden" name="id" value="<?= $tim['id'] ?>">
        <?php endif; ?>
        <label>Nama Tim/Satker</label>
        <input type="text" name="name" class="form-control" required value="<?= old('name', $tim['nama_tim'] ?? '') ?>">
        <label>Bidang / Bagian</label>
        <select name="bidang" id="bidang" class="form-control select2">
            <option value="">Pilih Bidang</option>
            <?php foreach ($bidang as $b): ?>
                <option value="<?= $b['id'] ?>" <?= old('bidang', $tim['bidang_id'] ?? '') == $b['id'] ? 'selected' : '' ?>><?= $b['nama_bidang'] ?></option>
            <?php endforeach; ?>
        </select>
        <button class="btn btn-primary mt-3" type="submit">Simpan</button>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%', // WAJIB agar responsif & tidak terlihat sempit
            placeholder: 'Pilih opsi...',
            allowClear: true
        });
    });
</script>
<?= $this->endSection() ?>