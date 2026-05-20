<?= $this->extend('layout/frontend') ?> 

<?= $this->section('styles') ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* --- EFEK KARTU INFORMASI --- */
    .contact-info-card {
        transition: all 0.4s ease;
        border: 1px solid rgba(0,0,0,0.05);
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
    }
    .contact-info-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(242, 110, 34, 0.15) !important;
        border-color: rgba(242, 110, 34, 0.3);
    }
    
    .icon-circle {
        width: 45px; height: 45px;
        background-color: rgba(242, 110, 34, 0.1);
        color: #f26e22;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem; transition: all 0.3s ease;
    }
    .contact-info-card:hover .icon-circle {
        background-color: #f26e22; color: white; transform: scale(1.1);
    }

    /* --- EFEK INPUT FORM INTERAKTIF --- */
    .form-control {
        border: 2px solid #e5e7eb;
        padding: 12px 15px;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    .form-control:focus {
        border-color: #f26e22;
        box-shadow: 0 0 0 4px rgba(242, 110, 34, 0.15);
        transform: translateY(-2px);
    }

    /* --- TOMBOL KIRIM --- */
    .btn-kirim {
        background-color: #f26e22; color: white;
        border-radius: 12px; padding: 12px; transition: all 0.3s ease;
    }
    .btn-kirim:hover {
        background-color: #d95e16;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(242, 110, 34, 0.3);
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container my-5 pt-4">
    <div class="text-center mb-5" data-aos="fade-down" data-aos-duration="1000">
        <span class="badge bg-white text-orange px-3 py-2 rounded-pill mb-3 shadow-sm border" style="color: #f26e22; letter-spacing: 1px;">LAYANAN PENGADUAN</span>
        <h2 class="fw-bold display-6 text-dark mb-3">Hubungi Kami</h2>
        <p class="text-muted mx-auto" style="max-width: 600px;">Punya kendala, pertanyaan, atau saran untuk pengembangan aplikasi? Kirimkan pesan Anda langsung kepada tim developer kami.</p>
    </div>

    <div class="row g-4 justify-content-center">
        <div class="col-md-4" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">
            <div class="card contact-info-card border-0 shadow-sm p-4 rounded-4 h-100">
                <h5 class="fw-bold mb-4 text-dark">Informasi Kontak</h5>
                
                <div class="d-flex align-items-center gap-3 mb-4">
                    <div class="icon-circle"><i class="fa-solid fa-location-dot"></i></div>
                    <div>
                        <p class="mb-0 fw-bold text-dark small">Alamat</p>
                        <p class="text-muted small mb-0">Jln. Belimbing No. 13, Kendari</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="icon-circle"><i class="fa-solid fa-phone"></i></div>
                    <div>
                        <p class="mb-0 fw-bold text-dark small">Telepon / WA</p>
                        <p class="text-muted small mb-0">+62 878 4021 6775</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="400">
            <div class="card border-0 shadow-sm p-4 p-md-5 rounded-4 bg-white position-relative overflow-hidden">
                
                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success py-3 small mb-4 fw-semibold border-0 shadow-sm rounded-3">
                        <i class="fa-solid fa-circle-check me-2"></i> <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>
                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger py-3 small mb-4 fw-semibold border-0 shadow-sm rounded-3">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('kontak/kirim') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" placeholder="Masukkan nama Anda" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark">Alamat Email</label>
                        <input type="email" class="form-control" name="email" placeholder="contoh@gmail.com" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark">Isi Pesan / Pengaduan</label>
                        <textarea class="form-control" name="pesan" rows="5" placeholder="Tuliskan pesan atau laporan Anda secara detail di sini..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-kirim w-100 fw-bold fs-6">
                        <i class="fa-solid fa-paper-plane me-2"></i> Kirim Pesan Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ once: true, offset: 50 });
</script>
<?= $this->endSection() ?>