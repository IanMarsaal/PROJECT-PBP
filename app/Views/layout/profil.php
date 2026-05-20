<?= $this->extend('layout/frontend') ?> 

<?= $this->section('styles') ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* --- LATAR BELAKANG HALAMAN --- */
    .profile-section {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        min-height: 80vh;
        position: relative;
        overflow: hidden;
    }
    
    /* Ornamen Latar Abstrak */
    .profile-section::before {
        content: ''; position: absolute; top: -100px; right: -100px; width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(242, 110, 34, 0.1) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%; z-index: 0;
    }
    .profile-section::after {
        content: ''; position: absolute; bottom: -50px; left: -50px; width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(37, 117, 252, 0.08) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%; z-index: 0;
    }

    /* --- KARTU PROFIL UTAMA --- */
    .profile-card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 30px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.05);
        transition: all 0.4s ease;
        position: relative;
        z-index: 2;
    }
    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 60px rgba(242, 110, 34, 0.12);
    }

    /* --- AVATAR INTERAKTIF --- */
    .avatar-container {
        position: relative;
        display: inline-block;
        margin-bottom: 20px;
    }
    .avatar-img {
        width: 140px; height: 140px; object-fit: cover;
        border-radius: 50%;
        border: 5px solid white;
        box-shadow: 0 10px 25px rgba(242, 110, 34, 0.3);
        transition: all 0.5s ease;
        position: relative;
        z-index: 2;
    }
    .avatar-container:hover .avatar-img {
        transform: scale(1.08) rotate(5deg);
    }

    /* Efek Denyut (Pulse) di belakang Avatar */
    .avatar-glow {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        border-radius: 50%;
        background: #f26e22;
        z-index: 1;
        animation: pulse-glow 2s infinite cubic-bezier(0.4, 0, 0.2, 1);
    }
    @keyframes pulse-glow {
        0% { transform: scale(1); opacity: 0.8; }
        100% { transform: scale(1.4); opacity: 0; }
    }

    /* --- STATISTIK BOX --- */
    .stat-box {
        background: #f8f9fa;
        border-radius: 16px;
        padding: 15px 10px;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }
    .stat-box:hover {
        background: white;
        border-color: rgba(242, 110, 34, 0.3);
        box-shadow: 0 8px 20px rgba(0,0,0,0.04);
        transform: translateY(-3px);
    }

    /* --- TOMBOL KELUAR --- */
    .btn-logout {
        border: 2px solid #dc3545; color: #dc3545;
        transition: all 0.3s ease; border-radius: 14px;
        font-weight: 600;
    }
    .btn-logout:hover {
        background: #dc3545; color: white;
        box-shadow: 0 10px 20px rgba(220, 53, 69, 0.2);
        transform: translateY(-2px);
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="profile-section d-flex align-items-center py-5">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                
                <div class="profile-card text-center p-5" data-aos="zoom-in" data-aos-duration="1000">
                    
                    <?php 
                        // Mengambil nama pengguna, jika kosong beri nilai 'User'
                        $namaUser = session()->get('username') ?? 'Wisatawan'; 
                    ?>

                    <div class="avatar-container" data-aos="fade-down" data-aos-delay="200">
                        <div class="avatar-glow"></div>
                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($namaUser) ?>&background=f26e22&color=fff&size=256&bold=true&rounded=true" alt="Avatar <?= esc($namaUser) ?>" class="avatar-img bg-white">
                        
                        <div class="position-absolute bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow" style="width: 35px; height: 35px; bottom: 5px; right: 5px; z-index: 3; border: 3px solid white;">
                            <i class="fa-solid fa-check small"></i>
                        </div>
                    </div>

                    <div data-aos="fade-up" data-aos-delay="300">
                        <h3 class="fw-bold mb-1 text-dark"><?= esc($namaUser) ?></h3>
                        <p class="text-muted mb-3"><i class="fa-solid fa-envelope me-2 text-orange"></i><?= esc(session()->get('email') ?? 'Belum ada email yang ditautkan') ?></p>
                        
                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-bold border border-success-subtle shadow-sm mb-4">
                            <i class="fa-solid fa-crown me-1"></i> Anggota Terverifikasi
                        </span>
                    </div>
                    
                    <hr class="my-4 text-muted opacity-25">

                <div class="stat-box mb-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="d-flex justify-content-between align-items-center px-2">
                            <div class="text-start">
                                <small class="text-muted fw-bold d-block mb-1">Status Akun</small>
                                <span class="badge bg-success-subtle text-success border border-success-subtle shadow-sm">Aktif</span>
                            </div>
                            <div class="text-end">
                                <small class="text-muted fw-bold d-block mb-1">Tanggal Bergabung</small>
                                <span class="text-dark fw-bold"><?= date('d M Y') ?></span>
                            </div>
                        </div>
                    </div>

                    <div data-aos="fade-up" data-aos-delay="500">
                        <a href="<?= base_url('logout') ?>" class="btn btn-logout w-100 py-3">
                            <i class="fa-solid fa-power-off me-2"></i> Keluar dari Akun
                        </a>
                    </div>

                </div>

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