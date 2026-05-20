<?= $this->extend('Admin/dashboard') ?> 

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <?php 
                // Deteksi Mode: Jika ada data kategori_single, berarti sedang mode EDIT
                $isEdit = isset($kategori_single); 
                $actionUrl = $isEdit ? base_url('admin/kategori/update/' . $kategori_single['id']) : base_url('admin/kategori/store/');
            ?>
            
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h5 class="fw-bold mb-0"><?= $isEdit ? 'Edit Kategori Wisata' : 'Tambah Kategori Baru' ?></h5>
                </div>
                <div class="card-body p-4">
                    
                    <?php if(session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger small py-2">
                            <ul class="mb-0 ps-3">
                                <?php foreach(session()->getFlashdata('errors') as $err): ?>
                                    <li><?= $err ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= $actionUrl ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Kategori</label>
                            <input type="text" class="form-control" name="name" placeholder="Contoh: Wisata Pantai" 
                                   value="<?= $isEdit ? esc($kategori_single['name']) : old('name') ?>" required>
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Deskripsi Singkat</label>
                            <textarea class="form-control" name="description" rows="3" placeholder="Opsional..."><?= $isEdit ? esc($kategori_single['description']) : old('description') ?></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('admin/kategori') ?>" class="btn btn-light border">Batal</a>
                            <button type="submit" class="btn" style="background-color: #f26e22; color: white;">
                                <?= $isEdit ? 'Update Kategori' : 'Simpan Kategori' ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h5 class="fw-bold mb-0">Daftar Kategori yang Tersedia</h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi</th>
                                    <th class="text-center" style="width: 160px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($kategori)): ?>
                                    <?php $no = 1; foreach($kategori as $kat): ?>
                                        <tr>
                                            <td class="fw-semibold text-secondary"><?= $no++ ?></td>
                                            <td><span class="badge bg-light text-primary border border-primary-subtle fw-bold px-2 py-1"><?= esc($kat['name']) ?></span></td>
                                            <td class="text-muted small"><?= esc($kat['description'] ?: '-') ?></td>
                                            <td class="text-center">
                                                <div class="btn-group gap-1">
                                                    <a href="<?= base_url('admin/kategori/edit/'. $kat['id']) ?>" class="btn btn-sm btn-outline-warning rounded">
                                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger rounded btn-hapus" 
                                                            data-id="<?= $kat['id'] ?>" data-name="<?= esc($kat['name']) ?>">
                                                        <i class="fa-solid fa-trash"></i> Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4 small">Belum ada data kategori yang dibuat.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Melacak notifikasi sukses flashdata dari server
        <?php if(session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= session()->getFlashdata('success') ?>',
                confirmButtonColor: '#f26e22'
            }).then(() => {
                // Bersihkan URL jika setelah update agar kembali normal
                if ("<?= $isEdit ?>") {
                    window.location.href = "<?= base_url('admin/kategori') ?>";
                }
            });
        <?php endif; ?>

        // Intersept konfirmasi penghapusan data secara interaktif
        const deleteButtons = document.querySelectorAll('.btn-hapus');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: `Kategori "${name}" akan dihapus secara permanen dari database!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect ke rute hapus jika disetujui
                        window.location.href = `<?= base_url('admin/kategori/delete') ?>/${id}`;
                    }
                });
            });
        });
    });
</script>
<?= $this->endSection() ?>