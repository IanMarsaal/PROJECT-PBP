<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIPAR-SULTRA</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body {
      
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden; 
        }

        /* --- KUSTOMISASI TOMBOL --- */
        .btn-orange { 
            background: linear-gradient(135deg, #f26e22 0%, #d95e16 100%); 
            color: white; 
            font-weight: 600; 
            border-radius: 50px;
            padding: 12px;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 8px 20px rgba(242, 110, 34, 0.25);
        }
        .btn-orange:hover { 
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(242, 110, 34, 0.4);
            color: white; 
        }

        /* --- TOMBOL DAFTAR (OUTLINE) --- */
        .btn-outline-orange {
            border: 2px solid #f26e22;
            color: #f26e22;
            background: transparent;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
        }
        .btn-outline-orange:hover {
            background-color: #f26e22;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(242, 110, 34, 0.2);
        }

        .text-orange { color: #f26e22; transition: all 0.3s; }
        .text-orange:hover { color: #d95e16; text-decoration: underline !important; }

        /* --- KUSTOMISASI INPUT FORM --- */
        .input-group {
            background: #f8f9fa;
            border-radius: 50px;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            overflow: hidden;
        }
        .input-group:focus-within {
            border-color: rgba(242, 110, 34, 0.5);
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(242, 110, 34, 0.1);
        }
        .input-group-text {
            background: transparent;
            border: none;
            padding-left: 20px;
        }
        .form-control {
            background: transparent;
            border: none;
            padding: 12px 15px;
            box-shadow: none !important;
        }

        /* --- EFEK BACKGROUND KANAN --- */
        .bg-image-container {
            position: relative;
            overflow: hidden;
        }
        .bg-image {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url('https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?auto=format&fit=crop&w=1920&q=80');
            background-size: cover; 
            background-position: center;
            animation: zoomBg 20s infinite alternate linear;
            z-index: 1;
        }
        .bg-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(11,28,60,0.8) 0%, rgba(242,110,34,0.4) 100%);
            z-index: 2;
        }
        @keyframes zoomBg {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        /* --- EFEK GLASSMORPHISM (KACA TRANSPARAN) --- */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            padding: 40px;
            z-index: 3;
            text-align: center;
            box-shadow: 0 25px 50px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid vh-100 p-0">
        <div class="row h-100 g-0">
            
           <div class="col-lg-5 d-flex align-items-center justify-content-center bg-white p-4 py-5 position-relative z-3 overflow-auto">
                <div class="w-100" style="max-width: 420px;" data-aos="fade-right" data-aos-duration="1200">
                    
                    <div class="mb-5 d-flex align-items-center">
                       <div class="text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow" style="width: 45px; height: 45px; font-weight: bold; font-size: 1.2rem; background-color: #f26e22;">S</div>
                        <h3 class="mb-0 fw-bold" style="color: #0b1c3c; letter-spacing: 1px;">SIPAR-SULTRA</h3>
                    </div>
                    
                    <h2 class="fw-bold mb-2 text-dark">Selamat Datang! 👋</h2>
                    <p class="text-muted mb-4 pb-2">Masuk ke akun Anda untuk menjelajahi keindahan tersembunyi Sulawesi Tenggara.</p>

                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger small py-3 rounded-4 border-0 shadow-sm fw-medium"><i class="fa-solid fa-triangle-exclamation me-2"></i> <?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success small py-3 rounded-4 border-0 shadow-sm fw-medium"><i class="fa-solid fa-circle-check me-2"></i> <?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>

                    <form action="<?= base_url('login') ?>" method="post" autocomplete="off">
                        
                        <div class="mb-4">
                            <label class="form-label small fw-bold text-dark ps-2">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text text-muted"><i class="fa-regular fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="contoh@gmail.com" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-dark ps-2">Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text text-muted"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan kata sandi Anda" autocomplete="new-password" required>
                                <span class="input-group-text text-muted toggle-password pe-4" style="cursor: pointer;" title="Tampilkan/Sembunyikan Sandi">
                                    <i class="fa-regular fa-eye"></i> 
                                </span>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-5 small">
                           <div class="form-check">
                             <input class="form-check-input shadow-sm" type="checkbox" name="remember" id="remember" required>
                              <label class="form-check-label text-muted fw-medium" for="remember">
                                Ingat Saya
                            </label>
                            </div>
                            <a href="#" class="text-orange text-decoration-none fw-semibold">Lupa Sandi?</a>
                        </div>

                            <button type="submit" class="btn btn-orange w-100 py-3 fs-6">Masuk ke Sistem</button>
                        
                        <div class="d-flex align-items-center my-4">
                            <hr class="flex-grow-1 text-muted opacity-25">
                            <span class="mx-3 small text-muted fw-medium">atau belum punya akun?</span>
                            <hr class="flex-grow-1 text-muted opacity-25">
                        </div>

                        <a href="<?= base_url('register') ?>" class="btn btn-outline-orange w-100 py-3 fs-6 text-decoration-none d-block text-center mb-2">
                            Buat Akun Baru Sekarang
                        </a>
                    </form>
                </div>
            </div>

            <div class="col-lg-7 d-none d-lg-flex align-items-center justify-content-center text-white bg-image-container">
                <div class="bg-image"></div>
                <div class="bg-overlay"></div>
                
                <div class="glass-card mx-5" data-aos="zoom-in" data-aos-duration="1500" data-aos-delay="300">
                    <span class="badge bg-white text-orange px-3 py-2 rounded-pill mb-3 shadow-sm fw-bold" style="letter-spacing: 1px;">EKSPLORASI TANPA BATAS</span>
                    <h1 class="display-4 fw-bold mb-3 text-white" style="line-height: 1.2;">Mulai Petualangan<br>Anda Hari Ini</h1>
                    <p class="fs-5 fw-light text-white-50 mb-0">Temukan destinasi wisata alam, budaya, dan kuliner eksotis yang tak terlupakan bersama SIPAR-SULTRA.</p>
                </div>
            </div>

        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inisialisasi AOS Animasi
            AOS.init({ once: true });

            // Logika Toggle Password
            const toggleIcons = document.querySelectorAll('.toggle-password');
            toggleIcons.forEach(function(icon) {
                icon.addEventListener('click', function() {
                    const input = this.closest('.input-group').querySelector('input');
                    const eyeIcon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        eyeIcon.classList.remove('fa-eye');
                        eyeIcon.classList.add('fa-eye-slash');
                        eyeIcon.classList.add('text-orange');
                    } else {
                        input.type = 'password';
                        eyeIcon.classList.remove('fa-eye-slash');
                        eyeIcon.classList.remove('text-orange');
                        eyeIcon.classList.add('fa-eye');
                    }
                });
            });
        });
    </script>
</body>
</html>