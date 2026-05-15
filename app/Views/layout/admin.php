<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Viatours</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background-color: #343a40; }
        .sidebar a { color: #cfd8dc; text-decoration: none; padding: 12px 20px; display: block; border-bottom: 1px solid #454d55; }
        .sidebar a:hover, .sidebar a.active { background-color: #f26e22; color: white; }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar Kiri -->
    <div class="sidebar text-white" style="width: 250px;">
        <h4 class="text-center py-4 mb-0 fw-bold border-bottom border-secondary">
            <i class="fa-solid fa-leaf text-warning"></i> Admin Panel
        </h4>
        <div class="mt-2">
            <a href="<?= base_url('admin/dashboard') ?>"><i class="fa-solid fa-house me-2"></i> Dashboard</a>
            <a href="<?= base_url('admin/kategori') ?>"><i class="fa-solid fa-tags me-2"></i> Kategori Wisata</a>
            <a href="<?= base_url('admin/destinasi') ?>"><i class="fa-solid fa-map-location-dot me-2"></i> Destinasi Wisata</a>
            <a href="<?= base_url('logout') ?>" class="text-danger"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a>
        </div>
    </div>

    <!-- Konten Kanan -->
    <div class="flex-grow-1 p-4">
        <!-- Notifikasi jika sukses input data -->
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fa-solid fa-circle-check me-2"></i> <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Lubang untuk form/tabel yang akan berganti-ganti -->
        <?= $this->renderSection('content') ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>