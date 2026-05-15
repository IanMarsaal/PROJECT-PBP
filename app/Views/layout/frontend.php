<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pariwisata - Your World of Joy</title>
    
    <!-- Bootstrap 5 CSS (Wajib) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome (Untuk Ikon Bintang, Sosmed, dll) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Google Fonts (Biar mirip Figma) -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #333;
        }
        /* Warna Oranye Kustom sesuai Figma */
        .text-orange { color: #f26e22; }
        .bg-orange { background-color: #f26e22; }
        .btn-orange { 
            background-color: #f26e22; 
            color: white; 
            border-radius: 50px; /* Tombol bulat */
            padding: 8px 24px;
            font-weight: 600;
        }
        .btn-orange:hover { background-color: #d95e16; color: white; }
        
        /* Footer Styling */
        .footer-section { background-color: #fff9f6; padding: 60px 0 20px 0; }
        .footer-link { color: #555; text-decoration: none; font-size: 14px; margin-bottom: 10px; display: block; }
        .footer-link:hover { color: #f26e22; }
        .footer-title { font-weight: 700; margin-bottom: 20px; font-size: 16px; }
        .social-icon { color: #555; font-size: 18px; margin-right: 15px; text-decoration: none; }
        .social-icon:hover { color: #f26e22; }
    </style>
</head>
<body>

    <!-- ================= NAVBAR (BAGIAN ATAS) ================= -->
    <nav class="navbar navbar-expand-lg bg-white py-3">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold text-dark fs-4" href="<?= base_url('/') ?>">
                <i class="fa-solid fa-leaf text-orange"></i> Dlabjo
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Search Bar di Tengah (Mirip Figma) -->
                <form class="d-none d-lg-flex mx-auto" style="width: 300px;">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-0"><i class="fa-solid fa-search text-muted"></i></span>
                        <input type="text" class="form-control bg-light border-0" placeholder="Search destinations...">
                    </div>
                </form>

                <!-- Menu Kanan -->
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item fw-semibold mx-2"><a class="nav-link text-dark" href="#">Destinasi Wisata</a></li>
                    <li class="nav-item fw-semibold mx-2"><a class="nav-link text-dark" href="#">Kategori</a></li>
                    <li class="nav-item fw-semibold mx-2"><a class="nav-link text-dark" href="#">Review</a></li>
                    <li class="nav-item fw-semibold mx-2"><a class="nav-link text-dark" href="<?= base_url('register') ?>">Sign Up</a></li>
                    <li class="nav-item ms-3">
                        <a class="btn btn-orange" href="<?= base_url('login') ?>">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- ================= KONTEN UTAMA (DINAMIS) ================= -->
    <!-- Di sinilah nanti isi halaman beranda, halaman detail, dll disisipkan -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- ================= FOOTER (BAGIAN BAWAH) ================= -->
    <footer class="footer-section mt-5">
        <div class="container">
            <!-- Bagian Atas Footer -->
            <div class="row mb-5 align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 fw-semibold">Speak to our expert at <span class="text-orange">1-800-453-6744</span></p>
                </div>
                <div class="col-md-6 text-md-end">
                    <span class="fw-semibold me-3">Follow Us</span>
                    <a href="#" class="social-icon"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>

            <!-- Bagian Tengah Footer -->
            <div class="row mb-4">
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-title">Contact</h5>
                    <p class="text-muted fs-6" style="font-size: 14px;">123 Queensberry Street, North Melbourne VIC 3051, Australia.</p>
                    <p class="text-muted" style="font-size: 14px;">hi@viatours.com</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-title">Company</h5>
                    <a href="#" class="footer-link">About Us</a>
                    <a href="#" class="footer-link">Tour Reviews</a>
                    <a href="#" class="footer-link">Contact Us</a>
                    <a href="#" class="footer-link">Travel Guides</a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-title">Support</h5>
                    <a href="#" class="footer-link">Get in Touch</a>
                    <a href="#" class="footer-link">Help center</a>
                    <a href="#" class="footer-link">Live chat</a>
                    <a href="#" class="footer-link">How it works</a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-title">Newsletter</h5>
                    <p class="text-muted" style="font-size: 14px;">Subscribe to the free newsletter and stay up to date</p>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Your email address">
                        <button class="btn btn-dark" type="button">Send</button>
                    </div>
                </div>
            </div>

            <!-- Bagian Bawah Footer (Copyright) -->
            <div class="row border-top pt-4 mt-4 text-muted align-items-center" style="font-size: 13px;">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    &copy; Copyright Viatours 2026. All rights reserved.
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <!-- Icon Pembayaran -->
                    <i class="fa-brands fa-cc-visa fs-4 mx-1"></i>
                    <i class="fa-brands fa-cc-mastercard fs-4 mx-1"></i>
                    <i class="fa-brands fa-cc-paypal fs-4 mx-1"></i>
                    <i class="fa-brands fa-cc-apple-pay fs-4 mx-1"></i>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>