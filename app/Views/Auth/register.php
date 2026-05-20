<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SIPAR-SULTRA</title>
    
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

        /* --- EFEK BACKGROUND KIRI --- */
        .bg-image-container {
            position: relative;
            overflow: hidden;
        }
        .bg-image {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-image: url('https://images.unsplash.com/photo-1506905925246-bb0932340e48?auto=format&fit=crop&w=1920&q=80');
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

        /* --- EFEK GLASSMORPHISM --- */
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
            
            <div class="col-lg-5 d-none d-lg-flex flex-column align-items-center justify-content-center text-white bg-image-container">
                <div class="bg-image"></div>
                <div class="bg-overlay"></div>
                
                <div class="glass-card mx-4" data-aos="zoom-in" data-aos-duration="1500" data-aos-delay="300">
                    <div class="bg-white text-orange rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4 shadow" style="width: 70px; height: 70px; font-size: 30px;">
                        <i class="fa-solid fa-map-location-dot"></i>
                    </div>
                    <h1 class="display-5 fw-bold mb-3 text-white">Mari Eksplorasi</h1>
                    <p class="fs-6 fw-light text-white-50 mb-0">Bergabunglah bersama ribuan wisatawan lainnya dan temukan surga tersembunyi di Sulawesi Tenggara.</p>
                </div>
            </div>

            <div class="col-lg-7 d-flex align-items-center justify-content-center bg-white p-4 py-5 overflow-auto">
                <div class="w-100" style="max-width: 500px;" data-aos="fade-left" data-aos-duration="1200">
                    
                    <div class="mb-4 d-flex align-items-center">
                       <div class="text-white rounded-circle d-flex align-items-center justify-content-center me-3 shadow" style="width: 45px; height: 45px; font-weight: bold; font-size: 1.2rem; background-color: #f26e22;">S</div>
                        <h4 class="mb-0 fw-bold" style="color: #0b1c3c; letter-spacing: 1px;">SIPAR-SULTRA</h4>
                    </div>
                    
                    <h2 class="fw-bold mb-1 text-dark">Buat Akun Baru ✨</h2>
                    <p class="text-muted mb-4 small">Lengkapi data diri Anda untuk memulai petualangan.</p>

                    <?php if(session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger small py-3 rounded-4 border-0 shadow-sm mb-4">
                            <div class="fw-bold mb-2"><i class="fa-solid fa-triangle-exclamation me-2"></i> Terdapat Kesalahan:</div>
                            <?php foreach(session()->getFlashdata('errors') as $err): ?>
                                <div class="mb-1 text-muted ps-4">• <?= $err ?></div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('register') ?>" method="post">
                        
                        <?= csrf_field() ?> <div class="mb-3">
                            <label class="form-label small fw-bold text-dark ps-2">Nama Lengkap</label>
                            <div class="input-group">
                                <span class="input-group-text text-muted"><i class="fa-regular fa-user"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Masukkan nama Anda" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark ps-2">Alamat Email</label>
                            <div class="input-group">
                                <span class="input-group-text text-muted"><i class="fa-regular fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control" placeholder="contoh@gmail.com" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark ps-2">Nomor Telepon / WA</label>
                            <div class="input-group">
                                <span class="input-group-text text-muted"><i class="fa-solid fa-phone"></i></span>
                                <input type="text" name="phone_number" class="form-control" placeholder="+62 8xx xxxx xxxx" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-dark ps-2">Buat Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text text-muted"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Buat kata sandi yang kuat" required>
                                <span class="input-group-text text-muted toggle-password pe-4" style="cursor: pointer;" title="Tampilkan/Sembunyikan Sandi">
                                    <i class="fa-regular fa-eye"></i>
                                </span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center mb-4 small text-muted">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input shadow-sm" id="terms" required>
                                <label class="form-check-label fw-medium" for="terms">
                                    Saya setuju dengan <a href="#" class="text-orange text-decoration-none fw-bold">Syarat & Ketentuan</a> serta <a href="#" class="text-orange text-decoration-none fw-bold">Kebijakan Privasi</a>.
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-orange w-100 py-3 mb-4 fs-6">Daftar Sekarang</button>
                        
                        <div class="text-center small text-muted fw-medium pb-4 pb-lg-0">
                            Sudah memiliki akun? <a href="<?= base_url('login') ?>" class="text-orange text-decoration-none fw-bold">Masuk di sini</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inisialisasi AOS
            AOS.init({ once: true });

            // Logika Toggle Password (Dengan efek perubahan warna ikon)
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