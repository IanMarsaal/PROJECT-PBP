<?= $this->extend('layout/frontend') ?> 

<?= $this->section('styles') ?>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

<style>
    /* --- EFEK PENCARIAN & KATEGORI --- */
    .search-container { 
        transition: all 0.3s ease; 
        border: 2px solid transparent; 
    }
    .search-container:focus-within { 
        border-color: rgba(242, 110, 34, 0.4); 
        box-shadow: 0 10px 25px rgba(242, 110, 34, 0.15) !important; 
        transform: translateY(-2px); 
    }
    
    .kategori-pill { 
        transition: all 0.3s ease; 
        font-weight: 500; 
        padding: 8px 24px;
    }
    .kategori-pill:hover { 
        transform: translateY(-3px); 
        box-shadow: 0 5px 15px rgba(0,0,0,0.08); 
    }
    .kategori-active { 
        background-color: #0b1c3c !important; 
        color: white !important; 
        box-shadow: 0 8px 20px rgba(11, 28, 60, 0.2); 
        border: none;
    }
    .kategori-inactive { 
        background-color: white; 
        color: #6c757d; 
        border: 1px solid #e5e7eb; 
    }
    .kategori-inactive:hover { 
        color: #f26e22; 
        border-color: #f26e22; 
    }

    /* --- KARTU DESTINASI --- */
    .card-wisata {
        border: none; border-radius: 24px; 
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
        box-shadow: 0 10px 30px rgba(0,0,0,0.04); 
        background: #fff;
    }
    .card-wisata:hover {
        transform: translateY(-12px);
        box-shadow: 0 20px 40px rgba(242, 110, 34, 0.12);
    }
    
    .img-wrapper { 
        overflow: hidden; border-radius: 24px 24px 0 0; position: relative; 
    }
    .card-img-top { 
        transition: transform 0.6s ease; height: 240px; object-fit: cover; 
    }
    .card-wisata:hover .card-img-top { transform: scale(1.08); } 

    /* Badge Rating Glassmorphism */
    .badge-rating {
        background: rgba(255, 255, 255, 0.85) !important; 
        color: #1f2937 !important;
        backdrop-filter: blur(8px); 
        border: 1px solid rgba(255,255,255,0.5);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1); 
        transition: all 0.4s ease;
        z-index: 10;
    }
    .card-wisata:hover .badge-rating { 
        background: #fcfcfc !important; 
        color: #f26e22 !important; 
        transform: scale(1.1);
    }

    .btn-detail { 
        background-color: #f26e22; color: white; 
        transition: all 0.3s ease; 
        border-radius: 14px;
    }
    .btn-detail:hover { 
        background-color: #d95e16; color: white; 
        transform: translateY(-2px); 
        box-shadow: 0 5px 15px rgba(242, 110, 34, 0.3);
    }
</style>
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container my-5 pt-3">
    
    <div class="row justify-content-center mb-5 pb-3" data-aos="fade-down" data-aos-duration="1000">
        <div class="col-md-8 text-center">
            <span class="badge bg-white text-orange px-3 py-2 rounded-pill mb-3 shadow-sm border" style="color: #f26e22; letter-spacing: 1px;">EKSPLORASI</span>
            <h2 class="fw-bold mb-3 text-dark display-6">Cari Destinasi Wisata</h2>
            <p class="text-muted fs-5 mb-4">Temukan destinasi impian Anda di Sulawesi Tenggara</p>
            
            <form action="<?= base_url('destinasi') ?>" method="get" class="d-flex gap-2 mb-5 shadow-sm rounded-pill p-2 bg-white search-container">
                <div class="d-flex align-items-center ps-3 text-muted">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <input type="text" name="search" class="form-control border-0 bg-transparent ps-3" placeholder="Ketik nama tempat atau lokasi wisata..." value="<?= request()->getVar('search') ?>">
                <button type="submit" class="btn text-white px-5 rounded-pill fw-bold" style="background-color: #f26e22;">Cari</button>
            </form>

            <?php 
                // Logika Cerdas: Deteksi Kategori dari Kata Kunci Pencarian
                $searchKeyword = strtolower(trim(request()->getVar('search') ?? ''));
                $activeKategoriId = request()->getVar('kategori');
                
                if (empty($activeKategoriId) && !empty($searchKeyword)) {
                    foreach($kategori as $kat) {
                        if (strpos($searchKeyword, strtolower(trim($kat['name']))) !== false) {
                            $activeKategoriId = $kat['id']; 
                            break; 
                        }
                    }
                }
            ?>
            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="<?= base_url('destinasi') ?>" class="btn rounded-pill kategori-pill <?= empty($activeKategoriId) ? 'kategori-active' : 'kategori-inactive' ?>">
                    <i class="fa-solid fa-border-all me-1"></i> Semua
                </a>
                <?php foreach($kategori as $kat): ?>
                    <a href="<?= base_url('destinasi?kategori=' . $kat['id']) ?>" 
                       class="btn rounded-pill kategori-pill <?= ($activeKategoriId == $kat['id']) ? 'kategori-active' : 'kategori-inactive' ?>">
                        <?= esc($kat['name']) ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-end mb-4" data-aos="fade-up">
        <h5 class="fw-bold mb-0 text-dark">Ditemukan <span style="color: #f26e22;"><?= count($destinasi) ?></span> destinasi</h5>
        <div class="bg-orange rounded" style="width: 50px; height: 4px; background-color: #f26e22;"></div>
    </div>
    
    <div class="row g-4">
        <?php if(!empty($destinasi)): ?>
            <?php 
            $delay = 100; 
            foreach($destinasi as $dest): 
            ?>
                <div class="col-md-4" data-aos="fade-up" data-aos-duration="800" data-aos-delay="<?= $delay ?>">
                    <div class="card h-100 card-wisata position-relative">
                        
                        <span class="badge badge-rating position-absolute top-0 end-0 m-3 py-2 px-3 rounded-pill fw-bold">
                            <i class="fa-solid fa-star text-warning me-1"></i> <?= isset($dest['rating_rata_rata']) ? $dest['rating_rata_rata'] : '0.0' ?>
                        </span>

                        <div class="img-wrapper">
                            <img src="<?= base_url('uploads/destinasi/' . $dest['image']) ?>" class="card-img-top" alt="<?= esc($dest['name']) ?>">
                        </div>
                        
                        <div class="card-body p-4 d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title fw-bold text-dark mb-2"><?= esc($dest['name']) ?></h5>
                                <p class="text-muted small mb-3">
                                    <i class="fa-solid fa-location-dot me-2" style="color: #f26e22;"></i><?= esc($dest['address']) ?>
                                </p>
                            </div>
                            
                            <div class="d-grid mt-3">
                                <a href="<?= base_url('destinasi/detail/' . $dest['id']) ?>" class="btn btn-detail py-2 fw-semibold">
                                    Lihat Detail Wisata
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
                $delay = $delay >= 300 ? 100 : $delay + 100; 
            endforeach; 
            ?>

        <?php else: ?>
            <div class="col-12 text-center py-5 my-5" data-aos="zoom-in">
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4" style="width: 100px; height: 100px;">
                    <i class="fa-solid fa-map-location-dot fs-1 text-muted opacity-50"></i>
                </div>
                <h4 class="fw-bold text-dark">Destinasi Tidak Ditemukan</h4>
                <p class="text-muted">Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        once: true, 
        offset: 50, 
    });
</script>
<?= $this->endSection() ?>