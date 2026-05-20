<?= $this->extend('Admin/dashboard') ?> 

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Manajemen Ulasan Pengunjung</h5>
                </div>
                
                <div class="card-body p-4">
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success small py-2">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Info Destinasi</th>
                                    <th>Rating</th>
                                    <th>Komentar Ulasan</th>
                                    <th>Tanggal</th>
                                    <th class="text-center" style="width: 100px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($reviews)): ?>
                                    <?php $no = 1; foreach($reviews as $rev): ?>
                                        <tr>
                                            <td class="fw-semibold text-secondary"><?= $no++ ?></td>
                                            
                                            <td>
                                                <span class="fw-bold text-dark d-block mb-1">
                                                    <?= esc($rev['nama_destinasi'] ?? 'Destinasi Tidak Ditemukan') ?>
                                                </span>
                                                <small class="text-muted">
                                                    <i class="fa-regular fa-user me-1"></i> Pengulas: <strong><?= esc($rev['nama_user'] ?? 'User Terhapus') ?></strong>
                                                </small>
                                            </td>
                                            
                                            <td>
                                                <div class="text-warning mb-1" style="font-size: 0.9rem;">
                                                    <?= str_repeat('⭐', $rev['rating']) ?>
                                                </div>
                                                <span class="badge bg-light text-dark border"><?= esc($rev['rating']) ?> / 5</span>
                                            </td>
                                            
                                            <td>
                                                <p class="mb-0 small text-secondary" style="max-width: 300px; white-space: normal;">
                                                    "<?= esc($rev['comment']) ?>"
                                                </p>
                                            </td>
                                            
                                            <td class="small text-muted">
                                                <?= date('d M Y', strtotime($rev['created_at'])) ?>
                                            </td>
                                            
                                            <td class="text-center">
                                                <a href="<?= base_url('admin/review/delete/' . $rev['id']) ?>" 
                                                   class="btn btn-sm btn-outline-danger rounded"
                                                   onclick="return confirm('Apakah Anda yakin ingin menghapus ulasan ini secara permanen?');">
                                                    <i class="fa-solid fa-trash"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4 small">
                                            <i class="fa-regular fa-comments fs-3 mb-2 text-black-50 d-block"></i>
                                            Belum ada ulasan yang diberikan oleh pengunjung.
                                        </td>
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
<?= $this->endSection() ?>