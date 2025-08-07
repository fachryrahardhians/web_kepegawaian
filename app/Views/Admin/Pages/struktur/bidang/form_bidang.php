<?= $this->extend('admin/layout/main_layout') ?>
<?= $this->section('content') ?>

<div class="card mt-4" style="border-radius: 1rem;">
    <form id="pegawaiForm" class="card-body" action="<?= base_url('/admin/api/bidang/submit') ?>" method="post" class="space-y-4">
        <h4 class="mb-3">Form Bidang</h4>

        <?php if (!empty($bidang['id'])): ?>
            <input type="hidden" name="id" value="<?= $bidang['id'] ?>">
        <?php endif; ?>

        <div class="col-md-6 mb-3">
            <label>Nama Bidang</label>
            <input type="text" name="name" class="form-control" required value="<?= old('name', $bidang['nama_bidang'] ?? '') ?>">
        </div>

        <button class="btn btn-primary mt-3 mb-2" type="submit">Simpan</button>


    </form>
</div>

<?= $this->endSection() ?>