<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPAR-SULTRA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fcfcfc; }
        .text-orange { color: #f26e22; }
        .bg-orange { background-color: #f26e22; }
        .btn-orange { background-color: #f26e22; color: white; border: none; }
        .btn-orange:hover { background-color: #d95e16; color: white; }
        
        /* LOGIKA NAVBAR AKTIF */
        .nav-link { color: #6c757d; transition: all 0.3s ease-in-out; }
        .nav-link:hover { color: #f26e22; }
        .nav-link.active-menu { color: #f26e22 !important; font-weight: 700; border-bottom: 2px solid #f26e22; }

        /* PROFIL */
        .dropdown-menu-profile { width: 280px; border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.15); overflow: hidden; }
        .profile-header { background-color: #f26e22; padding: 20px; text-align: center; color: white; }
        .dropdown-item-custom { padding: 12px 20px; font-weight: 500; color: #4b5563; display: flex; align-items: center; }
        .dropdown-item-custom i { width: 25px; font-size: 1.1rem; color: #6b7280; }
        .dropdown-item-custom:hover { background-color: #f3f4f6; color: #f26e22; }
        .dropdown-item-custom:hover i { color: #f26e22; }

        /* FOOTER */
    .footer-premium {
       background: linear-gradient(135deg, #0b1c3c 0%, #050d1e 100%);
        color: #ffffff;
        position: relative;
        overflow: hidden;
        border-top: 4px solid #f26e22;
        
        /* --- TAMBAHKAN DUA BARIS INI --- */
        padding-top: 130px !important; /* Memberi ruang kosong di dalam footer agar tidak tertabrak kotak biru */
        margin-top: 50px; /* Memberi jarak aman dari elemen di atasnya */
    }

    /* Ornamen Cahaya Abstrak di Belakang */
    .footer-premium::before {
        content: ''; position: absolute; top: -50%; left: -10%; width: 300px; height: 300px;
        background: radial-gradient(circle, rgba(242, 110, 34, 0.15) 0%, rgba(255,255,255,0) 70%);
        border-radius: 50%; z-index: 0;
    }

    /* Elemen di dalam footer harus di atas ornamen */
    .footer-premium .container { position: relative; z-index: 1; }

    /* Efek Hover Tautan Cepat (Bergeser ke kanan) */
    .footer-link {
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }
    .footer-link i {
        font-size: 10px; opacity: 0; transform: translateX(-10px); transition: all 0.3s ease;
    }
    .footer-link:hover {
        color: #f26e22;
        transform: translateX(8px); /* Teks bergeser */
    }
    .footer-link:hover i {
        opacity: 1; transform: translateX(0); margin-right: 8px; /* Panah muncul */
    }

    /* Ikon Sosial Media Interaktif */
    .social-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px; height: 38px;
        background: rgba(255, 255, 255, 0.05);
        color: white;
        border-radius: 50%;
        margin-right: 10px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); /* Efek memantul */
        border: 1px solid rgba(255,255,255,0.1);
        text-decoration: none;
    }
    .social-btn:hover {
        background: #f26e22;
        color: white;
        transform: translateY(-5px) rotate(8deg);
        box-shadow: 0 10px 20px rgba(242, 110, 34, 0.4);
        border-color: #f26e22;
    }

    /* List Alamat Interaktif */
    .address-list li {
        transition: all 0.3s ease;
        color: rgba(255, 255, 255, 0.7);
    }
    .address-list li:hover {
        color: white;
        transform: translateX(5px);
    }
    </style>

    <?= $this->renderSection('styles') ?>

</head>
<body>

    <?php $currentUrl = uri_string(); ?>

    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center fw-bold text-dark" href="<?= base_url('beranda') ?>">
                <div class="bg-orange text-white rounded d-flex align-items-center justify-content-center me-2" style="width: 35px; height: 35px;">S</div>
                SIPAR-SULTRA
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto fw-semibold gap-2">
                    <li class="nav-item"><a class="nav-link <?= ($currentUrl == '' || $currentUrl == 'beranda') ? 'active-menu' : '' ?>" href="<?= base_url('beranda') ?>">Beranda</a></li>  
                    <li class="nav-item"><a class="nav-link <?= strpos($currentUrl, 'destinasi') === 0 ? 'active-menu' : '' ?>" href="<?= base_url('destinasi') ?>">Destinasi</a></li>    
                    <li class="nav-item"><a class="nav-link <?= strpos($currentUrl, 'tentang') === 0 ? 'active-menu' : '' ?>" href="<?= base_url('tentang') ?>">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link <?= strpos($currentUrl, 'kontak') === 0 ? 'active-menu' : '' ?>" href="<?= base_url('kontak') ?>">Kontak</a></li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark fw-semibold" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('username') ?? 'User') ?>&background=f26e22&color=fff" class="rounded-circle me-2 border" width="40" height="40" alt="User">
                            <?= esc(session()->get('username') ?? 'Wisatawan') ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-profile mt-3">
                            <div class="profile-header">
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('username') ?? 'User') ?>&background=fff&color=f26e22" class="rounded-circle mb-2 shadow-sm" width="60" height="60">
                                <h5 class="mb-0 fw-bold"><?= esc(session()->get('username') ?? 'Wisatawan') ?></h5>
                                <small class="text-white-50">Pengguna Terverifikasi</small>
                            </div>
                            <li><a class="dropdown-item dropdown-item-custom" href="<?= base_url('profil') ?>"><i class="fa-regular fa-user"></i> Profil Saya</a></li>
                            <li><hr class="dropdown-divider m-0"></li>
                            <li><a class="dropdown-item dropdown-item-custom text-danger" href="<?= base_url('logout') ?>"><i class="fa-solid fa-arrow-right-from-bracket text-danger"></i> Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

  <footer class="footer-premium">
    <div class="container pb-3">
        <div class="row mt-4 mb-5">
            
            <div class="col-lg-4 col-md-6 mb-4 pe-lg-4" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                <a class="navbar-brand d-flex align-items-center fw-bold text-white mb-3 text-decoration-none" href="<?= base_url('beranda') ?>">
                    <div class="bg-orange text-white rounded d-flex align-items-center justify-content-center me-2 shadow" style="width: 40px; height: 40px; background-color: #f26e22; font-size: 1.2rem;">
                        S
                    </div>
                    <span class="fs-4 tracking-wide">SIPAR-SULTRA</span>
                </a>
                <p class="small lh-lg" style="color: rgba(255,255,255,0.7); text-align: justify;">
                    Jelajahi keajaiban tersembunyi di Sulawesi Tenggara. Mulai dari pegunungan hijau hingga surga bawah laut, kami hadir untuk mewujudkan pengalaman wisata Anda yang tak terlupakan.
                </p>
                
                <div class="mt-4">
                    <a href="#" class="social-btn" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="social-btn" title="Instagram"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="social-btn" title="Twitter"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="social-btn" title="YouTube"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4 offset-lg-1" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <h5 class="text-white fw-bold mb-4 position-relative d-inline-block">
                    Tautan Cepat
                    <span class="position-absolute bottom-0 start-0 w-50 rounded" style="height: 3px; background-color: #f26e22; margin-bottom: -8px;"></span>
                </h5>
                <ul class="list-unstyled small lh-lg d-flex flex-column gap-2 mt-3">
                    <li><a href="<?= base_url('beranda') ?>" class="footer-link"><i class="fa-solid fa-chevron-right"></i> Beranda</a></li>
                    <li><a href="<?= base_url('tentang') ?>" class="footer-link"><i class="fa-solid fa-chevron-right"></i> Tentang Kami</a></li>
                    <li><a href="<?= base_url('destinasi') ?>" class="footer-link"><i class="fa-solid fa-chevron-right"></i> Destinasi Wisata</a></li>
                    <li><a href="<?= base_url('kontak') ?>" class="footer-link"><i class="fa-solid fa-chevron-right"></i> Hubungi Kami</a></li>
                </ul>
            </div>
            
            <div class="col-lg-4 col-md-12 mb-4 offset-lg-1" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                <h5 class="text-white fw-bold mb-4 position-relative d-inline-block">
                    Hubungi Kami
                    <span class="position-absolute bottom-0 start-0 w-50 rounded" style="height: 3px; background-color: #f26e22; margin-bottom: -8px;"></span>
                </h5>
                <ul class="list-unstyled small lh-lg mt-3 address-list d-flex flex-column gap-3">
                    <li class="d-flex align-items-start">
                        <i class="fa-solid fa-location-dot mt-1 me-3 fs-5" style="color: #f26e22;"></i>
                        <span>Jln. Belimbing No. 13, Kec. Andonouhu<br>Kendari, Sulawesi Tenggara 93117</span>
                    </li>
                    <li class="d-flex align-items-center">
                        <i class="fa-solid fa-phone me-3 fs-5" style="color: #f26e22;"></i>
                        <span>+62 878 4021 6775</span>
                    </li>
                </ul>
            </div>
        </div>

        <hr style="border-color: rgba(255,255,255,0.1); margin-top: 30px;">
        <div class="row align-items-center pt-2 pb-3">
            <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                <p class="small mb-0" style="color: rgba(255,255,255,0.5);">
                    &copy; 2026 <strong class="text-white">SIPAR-SULTRA</strong>. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>