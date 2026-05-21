<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - SIPAR SULTRA</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        /* --- PENGATURAN DASAR --- */
        body { 
            font-family: 'Poppins', sans-serif; 
            background-color: #f4f7f6;
            overflow-x: hidden;
        }

        /* --- SIDEBAR PREMIUM --- */
        .sidebar { 
            min-height: 100vh; 
            width: 260px; 
            background: linear-gradient(180deg, #0b1c3c 0%, #050d1e 100%);
            box-shadow: 4px 0 10px rgba(0,0,0,0.05);
            position: fixed; 
            z-index: 1000;
            transition: all 0.3s ease;
        }
        
        .sidebar-brand {
            padding: 20px;
            font-weight: 700;
            color: white;
            font-size: 1.2rem;
            letter-spacing: 1px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
        }

        .sidebar-menu {
            padding: 20px 15px;
        }

        .sidebar-menu a { 
            color: #a3aed1; 
            text-decoration: none; 
            padding: 12px 20px; 
            display: flex; 
            align-items: center;
            border-radius: 12px;
            margin-bottom: 8px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .sidebar-menu a i {
            margin-right: 15px;
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover { 
            color: #ffffff; 
            background-color: rgba(255,255,255,0.05);
            transform: translateX(5px);
        }

        .sidebar-menu a.active { 
            background-color: #f26e22; 
            color: white; 
            box-shadow: 0 4px 15px rgba(242, 110, 34, 0.3);
        }

        .sidebar-menu a.logout-btn {
            margin-top: 30px;
            color: #ff6b6b;
            background-color: rgba(255, 107, 107, 0.1);
        }
        .sidebar-menu a.logout-btn:hover {
            background-color: #ff6b6b;
            color: white;
            transform: translateY(-2px);
        }

        /* --- KONTEN UTAMA & TOPBAR --- */
        .main-wrapper {
            margin-left: 260px; 
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
        }

        .topbar {
            background-color: #ffffff;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .content-area {
            padding: 30px;
            flex-grow: 1;
        }

        .alert-custom {
            border: none;
            border-radius: 15px;
            font-weight: 500;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        /* PERKEMBANGAN: Mencegah konflik tampilan CSS Leaflet Map dengan template utama */
        .leaflet-container {
            font-family: 'Poppins', sans-serif !important;
        }
    </style>

    <?= $this->renderSection('styles') ?>
</head>
<body>

    <nav class="sidebar">
        <div class="sidebar-brand">
            <div class="bg-orange text-white rounded d-flex align-items-center justify-content-center me-2 shadow-sm" style="width: 35px; height: 35px; background-color: #f26e22;">
                <i class="fa-solid fa-plane-departure small"></i>
            </div>
            SIPAR Admin
        </div>
        
        <div class="sidebar-menu">
            <p class="text-uppercase small fw-bold mb-2 px-3" style="color: rgba(255,255,255,0.3); letter-spacing: 1px;">Menu Utama</p>
            
            <a href="<?= base_url('admin/dashboard') ?>" class="<?= url_is('admin/dashboard') ? 'active' : '' ?>">
                <i class="fa-solid fa-border-all"></i> Dashboard
            </a>
            
            <a href="<?= base_url('admin/kategori') ?>" class="<?= url_is('admin/kategori*') ? 'active' : '' ?>">
                <i class="fa-solid fa-tags"></i> Kategori Wisata
            </a>
            
            <a href="<?= base_url('admin/destinasi') ?>" class="<?= url_is('admin/destinasi*') ? 'active' : '' ?>">
                <i class="fa-solid fa-map-location-dot"></i> Destinasi Wisata
            </a>
            
            <a href="<?= base_url('admin/review') ?>" class="<?= url_is('admin/review*') ? 'active' : '' ?>">
                <i class="fa-solid fa-star-half-stroke"></i> Review Pengguna
            </a>
            
            <a href="<?= base_url('logout') ?>" class="logout-btn">
                <i class="fa-solid fa-right-from-bracket"></i> Keluar Sistem
            </a>
        </div>
    </nav>

    <div class="main-wrapper">
        
        <header class="topbar">
            <div class="d-flex align-items-center">
             <h5 class="mb-0 fw-bold text-dark d-none d-md-block">
                    <?php 
                        date_default_timezone_set('Asia/Makassar'); 
                        $jam = (int) date('H');

                        if ($jam >= 7 && $jam <= 10) {
                            echo 'Selamat Pagi,';
                        } elseif ($jam >= 11 && $jam <= 14) { 
                            echo 'Selamat Siang,';
                        } elseif ($jam >= 15 && $jam <= 17) { 
                            echo 'Selamat Sore,';
                        } elseif ($jam >= 18 || $jam == 0) { 
                            echo 'Selamat Malam,';
                        } else { 
                            echo 'Selamat Tengah Malam, Sebaiknya istirahat'; 
                        }
                    ?> 
                    <span style="color: #f26e22;"><?= session()->get('username') ?? 'Admin' ?></span> 👋
                </h5>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-sm-block">
                    <p class="mb-0 fw-bold text-dark" style="font-size: 0.9rem;"><?= session()->get('username') ?? 'Administrator' ?></p>
                    <p class="mb-0 text-muted" style="font-size: 0.75rem;"><i class="fa-solid fa-circle text-success" style="font-size: 0.5rem; margin-right: 3px;"></i> Online</p>
                </div>
                <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('username') ?? 'Admin') ?>&background=0b1c3c&color=fff&rounded=true" alt="Admin" style="width: 40px; height: 40px; border-radius: 50%; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            </div>
        </header>

        <main class="content-area">
            
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success alert-custom alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fa-solid fa-circle-check fs-4 me-3 text-success"></i>
                        <div>
                            <strong>Berhasil!</strong><br>
                            <span class="small"><?= session()->getFlashdata('success') ?></span>
                        </div>
                    </div>
                    <button type="button" class="btn-close mt-2" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
            
        </main>
        
        <footer class="text-center py-3 text-muted small mt-auto">
            &copy; <?= date('Y') ?> <strong>SIPAR-SULTRA</strong>. Dibuat dengan antusiasme untuk memajukan pariwisata.
        </footer>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Mengatasi bug Leaflet Map di mana ubin peta (tiles) kadang abu-abu jika dimuat di dalam card Bootstrap
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                if (typeof mapPicker !== 'undefined') {
                    mapPicker.invalidateSize();
                }
            }, 400);
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>
</html>