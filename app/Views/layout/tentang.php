<?= $this->extend('layout/frontend') ?>

<?= $this->section('styles') ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* --- ESTETIKA HERO BANNER --- */
    .hero-tentang {
        background: linear-gradient(rgba(11, 28, 60, 0.8), rgba(242, 110, 34, 0.3)), url('<?= base_url('uploads/hero_tentang.jpg') ?>') center/cover fixed;
        min-height: 450px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* --- ESTETIKA BADGE & TEKS --- */
    .badge-aesthetic {
        background-color: rgba(242, 110, 34, 0.1);
        color: #f26e22;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 1.5px;
        font-size: 0.85rem;
        text-transform: uppercase;
        display: inline-block;
    }
    .text-orange { color: #f26e22 !important; }

    /* --- ESTETIKA GAMBAR --- */
    .img-aesthetic {
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        transition: transform 0.5s ease;
        object-fit: cover;
    }
    .img-aesthetic:hover { transform: scale(1.02); }

    /* --- ESTETIKA KARTU KEUNGGULAN --- */
    .value-card {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        padding: 40px 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    .value-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(242, 110, 34, 0.1);
    }
    .value-card::before {
        content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 4px; background: #f26e22; transform: scaleX(0); transform-origin: left; transition: transform 0.3s ease;
    }
    .value-card:hover::before { transform: scaleX(1); }
    
    .icon-box {
        width: 70px; height: 70px; background-color: rgba(242, 110, 34, 0.1); color: #f26e22; border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 28px; margin-bottom: 25px;
    }

    /* CSS Newsletter */
    .newsletter-section { background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%); color: white; border-radius: 20px; padding: 40px; margin-top: 60px; margin-bottom: -100px;}
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="hero-tentang text-white text-center">
    <div class="container py-5" style="z-index: 2;" data-aos="fade-up" data-aos-duration="1000">
        <span class="badge-aesthetic bg-white text-dark mb-3 shadow-sm">Kenali Kami</span>
        <h1 class="fw-bold display-4 mb-3 text-shadow">Tentang SIPAR-SULTRA</h1>
        <p class="lead fw-light mx-auto opacity-75" style="max-width: 700px;">
            Membuka jendela keajaiban Sulawesi Tenggara. Temukan surga tersembunyi yang menunggu untuk Anda jelajahi.
        </p>
    </div>
</div>

<div class="container my-5 py-5">
    <div class="row align-items-center g-5">
        <div class="col-lg-6 pe-lg-5" data-aos="fade-right" data-aos-duration="1000">
            <span class="badge-aesthetic mb-3">Kisah Kami</span>
            <h2 class="fw-bold mb-4 text-dark display-6">Jembatan Menuju <br><span class="text-orange">Surga Tersembunyi</span></h2>
            <p class="text-secondary lh-lg mb-4" style="font-size: 1.1rem; text-align: justify;">
                Mulai dari gugusan Pulau Labengki yang eksotis, surga bawah laut Wakatobi yang mendunia, hingga air terjun Moramo yang magis—Sulawesi Tenggara menyimpan sejuta pesona alam yang tak tertandingi.
            </p>
            <p class="text-secondary lh-lg mb-4" style="text-align: justify;">
                <strong>SIPAR-SULTRA (Sistem Informasi Pariwisata Sulawesi Tenggara)</strong> hadir sebagai jembatan digital interaktif. Misi kami sederhana: memperkenalkan kekayaan alam dan budaya nusantara kepada dunia melalui platform yang <strong>lengkap, akurat, dan mudah diakses</strong> oleh semua wisatawan.
            </p>
        </div>
        
        <div class="col-lg-6" data-aos="fade-left" data-aos-duration="1000">
            <div class="position-relative">
                <img src="<?= base_url('uploads/destinasi/default.png') ?>" alt="Kisah Sultra Wisata" class="img-fluid img-aesthetic" style="height: 450px; width: 100%;">
                
                <div class="position-absolute bg-white p-3 rounded-4 shadow-lg d-flex align-items-center" style="bottom: -20px; left: -20px;" data-aos="zoom-in" data-aos-delay="500">
                    <div class="bg-orange text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; font-size: 20px;">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-0">100+</h6>
                        <small class="text-muted">Destinasi Alam</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-light py-5">
    <div class="container my-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge-aesthetic mb-3">Fokus Kami</span>
            <h2 class="fw-bold text-dark">Mengapa Memilih SIPAR-SULTRA?</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card">
                    <div class="icon-box"><i class="fa-solid fa-leaf"></i></div>
                    <h5 class="fw-bold mb-3">Wisata Berkelanjutan</h5>
                    <p class="text-muted small lh-lg mb-0">Kami tidak hanya mempromosikan tempat, tetapi juga mengedukasi wisatawan untuk menjaga kelestarian alam dan lingkungan sekitar destinasi.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card">
                    <div class="icon-box"><i class="fa-solid fa-compass"></i></div>
                    <h5 class="fw-bold mb-3">Informasi Terintegrasi</h5>
                    <p class="text-muted small lh-lg mb-0">Temukan lokasi, harga tiket, ulasan pengunjung, hingga rute perjalanan dalam satu platform yang mudah digunakan tanpa harus pindah aplikasi.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                <div class="value-card">
                    <div class="icon-box"><i class="fa-solid fa-handshake-angle"></i></div>
                    <h5 class="fw-bold mb-3">Pemberdayaan Lokal</h5>
                    <p class="text-muted small lh-lg mb-0">Mendukung ekonomi masyarakat setempat dengan merekomendasikan layanan pemandu wisata lokal dan produk UMKM di sekitar tempat wisata.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="container position-relative z-1 mt-5" data-aos="zoom-in" data-aos-duration="800">
    <div class="newsletter-section d-flex justify-content-between align-items-center shadow-lg flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-1">Dapatkan Info Wisata Terbaru</h3>
            <p class="mb-0 text-white-50">Dengan Mengirimkan Pesan Ke Laman Berikut</p>
        </div>
        <div class="input-group" style="max-width: 300px;">
            <button onclick="window.location.href='<?= base_url('kontak') ?>'" class="btn btn-dark px-5 fw-bold" type="button">Silahkan Kunjungi</button>
        </div>
    </div>
</div> -->

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Inisialisasi AOS (once: true agar animasinya tidak berulang-ulang saat di-scroll naik turun)
    AOS.init({
        once: true,
        offset: 100, // Mulai animasi ketika elemen berjarak 100px dari layar bawah
    });
</script>
<?= $this->endSection() ?>