<?= $this->extend('layout/admin') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h5 class="fw-bold mb-0">Tambah Kategori Baru</h5>
                </div>
                <div class="card-body p-4">
                    
                    <!-- Menampilkan Error Validasi jika ada yang kosong -->
                    <?php if(session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger small">
                            <?php foreach(session()->getFlashdata('errors') as $err): ?>
                                <li><?= $err ?></li>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Form Input, perhatikan action-nya mengarah ke route store -->
                    <form action="<?= base_url('admin/kategori/store') ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Kategori</label>
                            <input type="text" class="form-control" name="name" placeholder="Contoh: Wisata Pantai" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Deskripsi Singkat</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Opsional..."></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('admin/kategori') ?>" class="btn btn-light border">Batal</a>
                            <button type="submit" class="btn" style="background-color: #f26e22; color: white;">Simpan Kategori</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>