<?= $this->extend('layout/frontend') ?>

<?= $this->section('content') ?>

<!-- 1. HERO SECTION (Banner Pemandangan) -->
<section class="position-relative d-flex align-items-center justify-content-center" 
         style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1920&q=80') center/cover; height: 70vh;">
    <div class="text-center text-white w-100 px-3">
        <h1 class="display-3 fw-bold mb-3">Destinasi Labuan Bajo</h1>
        <p class="fs-5 mb-5">Sebuah tempat destinasi wisata yang sangat indah dan menarik di mata internasional</p>
        
        <!-- Search Form Melayang -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="bg-white p-3 rounded-pill shadow d-flex align-items-center justify-content-between">
                        <div class="d-flex w-100 px-3 text-start">
                            <div class="border-end pe-3 me-3 w-50">
                                <small class="text-muted d-block">Mencari Destinasi</small>
                                <input type="text" class="form-control border-0 p-0 fw-semibold" placeholder="Search destinations">
                            </div>
                            <div class="w-50">
                                <small class="text-muted d-block">Pilih Destinasi</small>
                                <select class="form-select border-0 p-0 fw-semibold">
                                    <option>All Destinasi</option>
                                    <option>Nature</option>
                                    <option>City</option>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-orange rounded-pill px-4 py-2">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. WHY CHOOSE US -->
<section class="container mt-5 pt-5">
    <h3 class="fw-bold mb-4">Why choose Tourz</h3>
    <div class="row">
        <div class="col-md-3 mb-4">
            <i class="fa-solid fa-ticket text-orange fs-2 mb-3"></i>
            <h5 class="fw-bold fs-6">Ultimate flexibility</h5>
            <p class="text-muted small">You're in control, with free cancellation and payment options to satisfy any plan or budget.</p>
        </div>
        <div class="col-md-3 mb-4">
            <i class="fa-solid fa-map-location-dot text-orange fs-2 mb-3"></i>
            <h5 class="fw-bold fs-6">Memorable experiences</h5>
            <p class="text-muted small">Browse and book tours and activities so incredible, you'll want to tell your friends.</p>
        </div>
        <div class="col-md-3 mb-4">
            <i class="fa-solid fa-gem text-orange fs-2 mb-3"></i>
            <h5 class="fw-bold fs-6">Quality at our core</h5>
            <p class="text-muted small">High quality standards. Millions of reviews. A tourz company.</p>
        </div>
        <div class="col-md-3 mb-4">
            <i class="fa-solid fa-headset text-orange fs-2 mb-3"></i>
            <h5 class="fw-bold fs-6">Award-winning support</h5>
            <p class="text-muted small">New price? New plan? No problem. We're here to help, 24/7.</p>
        </div>
    </div>
</section>

<!-- 3. FIND POPULAR TOURS (DATA DINAMIS DARI DATABASE) -->
<section class="container mt-5 pt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0">Tempat Rekomendasi</h3>
        <a href="#" class="text-decoration-none text-dark small fw-semibold">See all</a>
    </div>
    
    <div class="row">
        <?php if(!empty($destinasi)): ?>
            <?php foreach($destinasi as $dest): ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                        <!-- Placeholder gambar sementara sampai fitur upload jalan -->
                        <img src="https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=500&q=60" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Tour Image">
                        <div class="card-body">
                            <small class="text-muted"><i class="fa-solid fa-location-dot"></i> <?= esc($dest['address']) ?></small>
                            <h6 class="card-title fw-bold mt-2"><?= esc($dest['name']) ?></h6>
                            <p class="text-muted small mb-0">From</p>
                            <h5 class="fw-bold text-orange">Rp <?= number_format($dest['ticket_price'], 0, ',', '.') ?></h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12 text-center py-5 bg-light rounded-4">
                <i class="fa-solid fa-box-open fs-1 text-muted mb-3"></i>
                <h5>Belum ada destinasi wisata</h5>
                <p class="text-muted">Silakan tambahkan data destinasi melalui panel Admin nanti.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- 4. PROMO BANNER -->
<section class="container mt-5 mb-5 pb-5">
    <div class="row align-items-center bg-orange rounded-4 overflow-hidden shadow" style="background-color: #fff9f6 !important;">
        <div class="col-md-6 p-5">
            <h2 class="fw-bold display-5 mb-3">Grab up to <span class="text-orange">35% off</span><br>on your favorite<br>Destination</h2>
            <p class="text-muted mb-4">Limited time offer, don't miss the opportunity.</p>
            <button class="btn btn-orange px-4 py-2">Book Now</button>
        </div>
        <div class="col-md-6 p-0">
            <img src="https://images.unsplash.com/photo-1548574505-5e239809ee19?auto=format&fit=crop&w=800&q=80" class="img-fluid h-100 object-fit-cover" alt="Promo">
        </div>
    </div>
</section>

<?= $this->endSection() ?>