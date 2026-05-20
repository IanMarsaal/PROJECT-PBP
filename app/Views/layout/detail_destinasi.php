<?= $this->extend('layout/frontend') ?> 

<?= $this->section('styles') ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* --- GALERI INTERAKTIF --- */
    .main-image-container {
        border-radius: 24px; overflow: hidden;
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        margin-bottom: 15px; position: relative;
    }
    .main-img {
        width: 100%; height: 400px; object-fit: cover;
        transition: opacity 0.3s ease;
    }
    .thumb-img {
        height: 90px; width: 100%; object-fit: cover;
        border-radius: 12px; cursor: pointer;
        opacity: 0.6; transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .thumb-img:hover, .thumb-img.active {
        opacity: 1; border-color: #f26e22; transform: translateY(-3px);
    }

    /* --- SISTEM RATING BINTANG INTERAKTIF --- */
    .star-rating-ui {
        display: flex; flex-direction: row-reverse; justify-content: flex-end; gap: 5px;
    }
    .star-rating-ui input { display: none; }
    .star-rating-ui label {
        cursor: pointer; font-size: 2.2rem; color: #e5e7eb; transition: color 0.2s ease;
    }
    /* Warna saat di-hover atau dipilih */
    .star-rating-ui input:checked ~ label,
    .star-rating-ui label:hover,
    .star-rating-ui label:hover ~ label {
        color: #ffc107; /* Kuning Emas */
    }

    /* --- KOTAK ULASAN & MAPS --- */
    .review-card {
        background: #ffffff; border: 1px solid rgba(0,0,0,0.05);
        border-radius: 24px; box-shadow: 0 15px 40px rgba(0,0,0,0.03);
    }
    
    /* Scrollbar Kustom untuk Daftar Ulasan */
    .review-list-container {
        max-height: 400px; overflow-y: auto; padding-right: 10px;
    }
    .review-list-container::-webkit-scrollbar { width: 6px; }
    .review-list-container::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    .review-list-container::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 10px; }
    .review-list-container::-webkit-scrollbar-thumb:hover { background: #f26e22; }

    /* Frame Peta */
    .map-frame {
        width: 100%; height: 250px; border: none; border-radius: 16px;
        background-color: #f8f9fa; margin-bottom: 15px;
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container my-5 pt-3">
    
    <a href="<?= base_url('destinasi') ?>" class="btn btn-white border shadow-sm rounded-pill px-4 mb-4 fw-semibold hover-orange" data-aos="fade-right">
        <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Katalog
    </a>

    <div class="row g-5">
        
        <div class="col-lg-7">
            
            <div data-aos="fade-up">
                <span class="badge bg-orange text-white px-3 py-2 rounded-pill mb-2 shadow-sm">Detail Destinasi</span>
                <h1 class="fw-bold mb-2 display-6 text-dark"><?= esc($destinasi['name']) ?></h1>
                <p class="text-muted fs-6 mb-4"><i class="fa-solid fa-location-dot me-2 text-danger"></i><?= esc($destinasi['address']) ?></p>
            </div>
            
            <div class="mb-5" data-aos="zoom-in" data-aos-delay="100">
                <?php if(!empty($images)): ?>
                    <div class="main-image-container">
                        <img id="mainImage" src="<?= base_url('uploads/destinasi/' . $images[0]['image_path']) ?>" class="main-img" alt="<?= esc($destinasi['name']) ?>">
                    </div>
                    <div class="row g-2">
                        <?php foreach($images as $index => $img): ?>
                            <div class="col-3 col-md-2">
                                <img src="<?= base_url('uploads/destinasi/' . $img['image_path']) ?>" 
                                     class="thumb-img <?= $index === 0 ? 'active' : '' ?>" 
                                     onclick="changeMainImage(this, '<?= base_url('uploads/destinasi/' . $img['image_path']) ?>')" 
                                     alt="Gallery Thumb">
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="main-image-container">
                        <img src="<?= base_url('uploads/destinasi/default.png') ?>" class="main-img" alt="Default Image">
                    </div>
                <?php endif; ?>
            </div>

            <div data-aos="fade-up" data-aos-delay="200">
                <h4 class="fw-bold mb-3 border-bottom pb-2">Pesona Destinasi</h4>
                <p class="text-secondary lh-lg mb-5" style="font-size: 1.05rem; text-align: justify;">
                    <?= nl2br(esc($destinasi['description'])) ?>
                </p>
            </div>

            <?php if(!empty($destinasi['latitude']) && !empty($destinasi['longitude'])): ?>
                <div class="card border-0 bg-light p-4 rounded-4 shadow-sm mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold mb-0"><i class="fa-solid fa-map-location-dot me-2 text-primary"></i> Peta & Lokasi Akurat</h5>
                        <div class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill">
                            Lat: <?= esc($destinasi['latitude']) ?> | Lng: <?= esc($destinasi['longitude']) ?>
                        </div>
                    </div>
                    
                    <p class="small text-muted mb-3">Jelajahi area sekitar lokasi wisata secara interaktif melalui peta di bawah ini.</p>
                    
                    <iframe class="map-frame" 
                            src="https://maps.google.com/maps?q=<?= $destinasi['latitude'] ?>,<?= $destinasi['longitude'] ?>&hl=id&z=14&output=embed" 
                            allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    
                    <a href="https://www.google.com/maps/search/?api=1&query=<?= $destinasi['latitude'] ?>,<?= $destinasi['longitude'] ?>" target="_blank" class="btn btn-outline-primary rounded-pill w-100 fw-bold py-2 mt-2 transition">
                        <i class="fa-solid fa-location-arrow me-2"></i> Buka Rute Arah di Google Maps App
                    </a>
                </div>
            <?php endif; ?>
        </div>


        <div class="col-lg-5">
            <div class="review-card p-4 p-md-5 position-sticky" style="top: 100px; z-index: 10;" data-aos="fade-left" data-aos-delay="200">
                
                <h4 class="fw-bold mb-1">Berikan Ulasan Anda</h4>
                <p class="text-muted small mb-4">Pengalaman Anda sangat berharga bagi wisatawan lain!</p>
                
                <form action="<?= base_url('destinasi/review/store') ?>" method="post" class="mb-5">
                    <input type="hidden" name="destination_id" value="<?= $destinasi['id'] ?>">

                    <div class="mb-4 text-center bg-light p-3 rounded-4 border">
                        <label class="d-block small fw-bold text-dark mb-2">Seberapa puas Anda?</label>
                        <div class="star-rating-ui">
                            <input type="radio" id="star5" name="rating" value="5" required />
                            <label for="star5" title="Sangat Istimewa"><i class="fa-solid fa-star"></i></label>
                            
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" title="Bagus Sekali"><i class="fa-solid fa-star"></i></label>
                            
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" title="Cukup Menarik"><i class="fa-solid fa-star"></i></label>
                            
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" title="Kurang Puas"><i class="fa-solid fa-star"></i></label>
                            
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label for="star1" title="Buruk/Kecewa"><i class="fa-solid fa-star"></i></label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold text-dark">Ceritakan Pengalaman Anda</label>
                        <textarea class="form-control bg-light border-0" name="comment" rows="4" placeholder="Misal: Pemandangannya sangat indah saat matahari terbenam..." required style="border-radius: 12px;"></textarea>
                    </div>

                    <button type="submit" class="btn text-white w-100 fw-bold py-3 fs-6 rounded-pill" style="background-color: #f26e22; box-shadow: 0 8px 20px rgba(242, 110, 34, 0.3);">
                        <i class="fa-solid fa-paper-plane me-2"></i> Kirim Ulasan Saya
                    </button>
                </form>

                <hr class="text-muted mb-4 opacity-25">

                <h6 class="fw-bold mb-4 d-flex justify-content-between align-items-center">
                    Ulasan Pengunjung 
                    <span class="badge bg-dark rounded-pill"><?= count($reviews) ?></span>
                </h6>
                
                <div class="review-list-container">
                    <?php if(!empty($reviews)): ?>
                        <?php foreach($reviews as $rev): ?>
                            <div class="bg-white p-3 rounded-4 mb-3 border shadow-sm">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name=<?= urlencode($rev['nama_user'] ?? 'P') ?>&background=random&color=fff&size=35&rounded=true" alt="Avatar">
                                        <div>
                                            <span class="fw-bold small text-dark d-block"><?= esc($rev['nama_user'] ?? 'Pengguna') ?></span>
                                            <small class="text-muted" style="font-size: 0.7rem;"><?= date('d M Y', strtotime($rev['created_at'])) ?></small>
                                        </div>
                                    </div>
                                    <div class="text-warning small">
                                        <?= str_repeat('⭐', $rev['rating']) ?>
                                    </div>
                                </div>
                                <p class="text-secondary mb-0 small lh-base" style="text-align: justify;">
                                    "<?= esc($rev['comment']) ?>"
                                </p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="text-center py-5 bg-light rounded-4 border border-dashed">
                            <i class="fa-regular fa-comment-dots fs-1 text-muted mb-3 opacity-25"></i>
                            <p class="small text-muted mb-0 fw-semibold">Belum ada ulasan.</p>
                            <p class="small text-muted mb-0">Jadilah orang pertama yang menceritakan pengalaman di sini!</p>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>

    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // 1. Inisialisasi Animasi AOS
    AOS.init({ once: true, offset: 50 });

    // 2. Fungsi Galeri: Mengganti Gambar Utama saat Thumbnail di-klik
    function changeMainImage(thumbElement, newSrc) {
        // Ganti sumber gambar utama
        const mainImg = document.getElementById('mainImage');
        mainImg.style.opacity = '0'; // Efek fade out singkat
        
        setTimeout(() => {
            mainImg.src = newSrc;
            mainImg.style.opacity = '1'; // Efek fade in
        }, 150);

        // Pindahkan status 'active' (garis oranye) ke thumbnail yang diklik
        const thumbs = document.querySelectorAll('.thumb-img');
        thumbs.forEach(t => t.classList.remove('active'));
        thumbElement.classList.add('active');
    }
</script>
<?= $this->endSection() ?>