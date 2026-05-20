<?= $this->extend('layout/frontend') ?>

<?= $this->section('styles') ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* --- HERO CAROUSEL --- */
  
    .hero-carousel {
        position: relative; height: 85vh; width: 100%; overflow: hidden;
    }
    .hero-carousel .carousel, .hero-carousel .carousel-inner, .hero-carousel .carousel-item { 
        height: 100%; width: 100%; 
    }
    .hero-carousel .carousel-item img { height: 100%; width: 100%; object-fit: cover; }
    
    .hero-overlay {
        position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.3), rgba(0,0,0,0.7)); 
        z-index: 1;
    }

    /* Kunci utamanya ada di sini: pointer-events: none agar tidak memblokir tombol klik */
    .hero-content {
        position: absolute; top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        text-align: center; color: white; z-index: 10; width: 80%;
        pointer-events: none; 
    }
    
    /* Tombol dan indikator slider diberi z-index tinggi agar selalu ada di atas */
    .carousel-indicators { z-index: 20 !important; }
    .hero-carousel .carousel-control-prev, .hero-carousel .carousel-control-next { 
        width: 10%; z-index: 20 !important; 
    }

    .hero-carousel .carousel-control-prev-icon, .hero-carousel .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.4); 
        border-radius: 50%; padding: 25px; background-size: 40%; 
        transition: all 0.3s ease;
    }
    .hero-carousel .carousel-control-prev-icon:hover, .hero-carousel .carousel-control-next-icon:hover { 
        background-color: #f26e22; 
    }

    /* --- KARTU DESTINASI INTERAKTIF --- */
    .card-wisata { 
        border: none; border-radius: 20px; transition: all 0.4s ease; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.04); background: #fff;
    }
    .card-wisata:hover { 
        transform: translateY(-10px); 
        box-shadow: 0 20px 40px rgba(242, 110, 34, 0.15); 
    }
    
    /* Efek gambar membesar di dalam bingkai */
    .img-wrapper { overflow: hidden; border-radius: 20px 20px 0 0; }
    .card-img-top { 
        height: 220px; object-fit: cover; transition: transform 0.6s ease; 
    }
    .card-wisata:hover .card-img-top { transform: scale(1.1); } /* Gambar nge-zoom saat hover */

    /* Badge Love */
    .badge-love {
        position: absolute; top: 15px; right: 15px; padding: 10px; border-radius: 50%;
        background: rgba(255, 255, 255, 0.9); color: #dc3545; backdrop-filter: blur(5px);
        transition: all 0.3s; cursor: pointer; z-index: 2;
    }
    .badge-love:hover { background: #dc3545; color: white; transform: scale(1.1); }

    /* --- STATISTIK / ICON BOX --- */
    .stat-box { transition: all 0.3s ease; }
    .stat-box:hover { transform: translateY(-8px); }
    .stat-icon {
        width: 80px; height: 80px; font-size: 28px; transition: all 0.4s ease;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    .stat-box:hover .stat-icon { transform: rotateY(180deg); } /* Efek putar keren 3D */

    /* --- NEWSLETTER --- */
    .newsletter-section { 
        background: linear-gradient(135deg, #0b1c3c 0%, #2575fc 100%); /* Warna disesuaikan dengan tema biru Sultra */
        color: white; border-radius: 24px; padding: 50px 40px; 
        margin-top: 60px; margin-bottom: -100px;
        position: relative; overflow: hidden;
    }
    /* Hiasan abstrak di newsletter */
    .newsletter-section::before {
        content: ''; position: absolute; top: -50%; right: -10%; width: 300px; height: 300px;
        background: rgba(255,255,255,0.1); border-radius: 50%; blur: 20px;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

    <section class="hero-carousel">
        <div class="hero-overlay"></div>
        
        <div class="hero-content">
            <div data-aos="fade-down" data-aos-duration="1000">
                <span class="badge bg-white text-orange px-3 py-2 rounded-pill mb-3 fw-bold shadow-sm" style="letter-spacing: 1px;">EKSPLORASI SULTRA</span>
            </div>
            
            <h1 class="display-3 fw-bold text-shadow" data-aos="zoom-in" data-aos-duration="1200" data-aos-delay="200">
                Jelajahi Keindahan<br>Sulawesi Tenggara
            </h1>
            
            <p class="fs-5 mt-3 fw-light opacity-75" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                Temukan destinasi wisata alam, budaya, dan kuliner eksotis yang tak terlupakan.
            </p>
        </div>

        <div id="heroSlider" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#heroSlider" data-bs-slide-to="2"></button>
            </div>
            
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=1920&q=80" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1506905925246-bb0932340e48?auto=format&fit=crop&w=1920&q=80" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="https://images.unsplash.com/photo-1544376798-89aa6b82c6cd?auto=format&fit=crop&w=1920&q=80" alt="Slide 3">
                </div>
            </div>
            
            <button class="carousel-control-prev" type="button" data-bs-target="#heroSlider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroSlider" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </section>

    <section class="container mt-5 pt-5">
        <div class="d-flex justify-content-between align-items-end mb-4" data-aos="fade-up">
            <div>
                <span class="text-orange fw-bold small text-uppercase tracking-wider">Rekomendasi Terbaik</span>
                <h2 class="fw-bold mb-1">Destinasi Populer</h2>
            </div>
            <a href="<?= base_url('destinasi') ?>" class="btn btn-outline-orange rounded-pill px-4 py-2 small fw-semibold transition">
                Lihat Semua <i class="fa-solid fa-arrow-right ms-1"></i>
            </a>
        </div>

        <div class="row g-4">
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-wisata h-100 position-relative">
                    <span class="badge-love shadow-sm"><i class="fa-solid fa-heart"></i></span>
                    <div class="img-wrapper">
                        <img src="https://images.unsplash.com/photo-1506905925246-bb0932340e48?auto=format&fit=crop&w=500&q=60" class="card-img-top">
                    </div>
                    <div class="card-body p-4">
                        <small class="text-muted fw-semibold"><i class="fa-solid fa-location-dot text-orange me-1"></i> Wakatobi, Sultra</small>
                        <h5 class="card-title fw-bold mt-2 mb-3">Taman Nasional Wakatobi</h5>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="text-warning small"><i class="fa-solid fa-star"></i> 4.9 (120 ulasan)</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-wisata h-100 position-relative">
                    <span class="badge-love shadow-sm"><i class="fa-solid fa-heart"></i></span>
                    <div class="img-wrapper">
                        <img src="https://images.unsplash.com/photo-1506905925246-bb0932340e48?auto=format&fit=crop&w=500&q=60" class="card-img-top">
                    </div>
                    <div class="card-body p-4">
                        <small class="text-muted fw-semibold"><i class="fa-solid fa-location-dot text-orange me-1"></i> Konawe, Sultra</small>
                        <h5 class="card-title fw-bold mt-2 mb-3">Pulau Labengki</h5>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="text-warning small"><i class="fa-solid fa-star"></i> 4.8 (95 ulasan)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card card-wisata h-100 position-relative">
                    <span class="badge-love shadow-sm"><i class="fa-solid fa-heart"></i></span>
                    <div class="img-wrapper">
                        <img src="https://images.unsplash.com/photo-1506905925246-bb0932340e48?auto=format&fit=crop&w=500&q=60" class="card-img-top">
                    </div>
                    <div class="card-body p-4">
                        <small class="text-muted fw-semibold"><i class="fa-solid fa-location-dot text-orange me-1"></i> Bau-Bau, Sultra</small>
                        <h5 class="card-title fw-bold mt-2 mb-3">Benteng Keraton Buton</h5>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="text-warning small"><i class="fa-solid fa-star"></i> 4.7 (88 ulasan)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                <div class="card card-wisata h-100 position-relative">
                    <span class="badge-love shadow-sm"><i class="fa-solid fa-heart"></i></span>
                    <div class="img-wrapper">
                        <img src="https://images.unsplash.com/photo-1506905925246-bb0932340e48?auto=format&fit=crop&w=500&q=60" class="card-img-top">
                    </div>
                    <div class="card-body p-4">
                        <small class="text-muted fw-semibold"><i class="fa-solid fa-location-dot text-orange me-1"></i> Kendari, Sultra</small>
                        <h5 class="card-title fw-bold mt-2 mb-3">Pantai Nambo</h5>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="text-warning small"><i class="fa-solid fa-star"></i> 4.6 (150 ulasan)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container mt-5 pt-5 text-center">
        <div data-aos="fade-up">
            <span class="badge bg-orange text-white px-3 py-2 rounded-pill mb-2">Pencapaian Kami</span>
            <h3 class="fw-bold mb-5">Bersama Memajukan Pariwisata</h3>
        </div>
        
        <div class="row justify-content-center g-4">
            <div class="col-md-3 col-sm-6 stat-box" data-aos="zoom-in" data-aos-delay="100">
                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 stat-icon"><i class="fa-solid fa-map-location-dot"></i></div>
                <h3 class="fw-bold mb-0">150+</h3>
                <p class="text-muted small">Destinasi Wisata</p>
            </div>
            <div class="col-md-3 col-sm-6 stat-box" data-aos="zoom-in" data-aos-delay="300">
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 stat-icon"><i class="fa-solid fa-users"></i></div>
                <h3 class="fw-bold mb-0">10k+</h3>
                <p class="text-muted small">Wisatawan Aktif</p>
            </div>
            <div class="col-md-3 col-sm-6 stat-box" data-aos="zoom-in" data-aos-delay="500">
                <div class="bg-orange text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3 stat-icon"><i class="fa-solid fa-award"></i></div>
                <h3 class="fw-bold mb-0">A+</h3>
                <p class="text-muted small">Rating Pelayanan</p>
            </div>
        </div>
    </section>
    
    <div class="container position-relative z-1 mt-4" data-aos="fade-up" data-aos-duration="1000">
        <div class="newsletter-section d-flex justify-content-between align-items-center shadow-lg flex-wrap gap-4">
            <div class="position-relative z-2">
                <h2 class="fw-bold mb-2">Dapatkan Info Wisata Terbaru!</h2>
                <p class="mb-0 text-white-50" style="font-size: 1.1rem;">Silahkan Hubungi Kami Ya</p>
            </div>
            <div class="input-group z-2" style="max-width: 350px;">
                <button onclick="window.location.href='<?= base_url('kontak') ?>'" class="btn btn-orange px-4 py-3 fw-bold rounded-pill shadow w-100" type="button">Hubungi Kami Sekarang</button>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        once: true, // Animasi hanya berjalan 1 kali saat di-scroll
        offset: 80, // Elemen mulai bergerak sebelum benar-benar terlihat di layar
        duration: 800, // Kecepatan animasi (ms)
    });
</script>
<?= $this->endSection() ?>