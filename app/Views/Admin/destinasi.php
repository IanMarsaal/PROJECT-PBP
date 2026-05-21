<?= $this->extend('Admin/dashboard') ?> 

<?= $this->section('styles') ?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<style>
    /* Styling untuk kotak peta di form */
    #mapPicker {
        height: 350px;
        width: 100%;
        border-radius: 8px;
        border: 1px solid #dee2e6;
        z-index: 1; 
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row">
        
        <div class="col-md-4">
            <?php 
                $isEdit = isset($destinasi_single); 
                $actionUrl = $isEdit ? base_url('admin/destinasi/update/' . $destinasi_single['id']) : base_url('admin/destinasi/store');
            ?>
            
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h5 class="fw-bold mb-0"><?= $isEdit ? 'Edit Destinasi' : 'Tambah Destinasi' ?></h5>
                </div>
                <div class="card-body p-4">
                    
                    <?php if(session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger small py-2">
                            <ul class="mb-0 ps-3">
                                <?php foreach(session()->getFlashdata('errors') as $err): ?>
                                    <li><?= $err ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form action="<?= $actionUrl ?>" method="post" enctype="multipart/form-data">
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Destinasi</label>
                            <input type="text" class="form-control" name="name" 
                                   value="<?= $isEdit ? esc($destinasi_single['name']) : old('name') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Kategori Wisata</label>
                            <select name="kategori_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach($kategori as $kat): ?>
                                    <option value="<?= $kat['id'] ?>"<?= ($isEdit && $destinasi_single['kategori_id'] == $kat['id']) ? 'selected' : '' ?>>
                                        <?= esc($kat['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat Lengkap</label>
                            <input type="text" class="form-control" name="address" 
                                   value="<?= $isEdit ? esc($destinasi_single['address']) : old('address') ?>" required>
                        </div>

                        <div class="row mb-2">
                            <div class="col-6">
                                <label class="form-label fw-semibold">Latitude</label>
                                <input type="text" class="form-control koordinat-input bg-light" id="lat" name="latitude" placeholder="-4.XXXX" 
                                       value="<?= $isEdit ? esc($destinasi_single['latitude']) : old('latitude') ?>" required>
                            </div>
                            <div class="col-6">
                                <label class="form-label fw-semibold">Longitude</label>
                                <input type="text" class="form-control koordinat-input bg-light" id="lng" name="longitude" placeholder="-122,XXX" 
                                       value="<?= $isEdit ? esc($destinasi_single['longitude']) : old('longitude') ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block mb-2"><i class="fa-solid fa-hand-pointer me-1"></i> Geser dan klik area pada peta di bawah ini untuk mengunci koordinat SULTRA.</small>
                            <div id="mapPicker"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea class="form-control" name="description" rows="3"><?= $isEdit ? esc($destinasi_single['description']) : old('description') ?></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Foto Destinasi (Bisa pilih lebih dari 1 foto)</label>
                            
                            <input type="file" class="form-control" name="images[]" multiple accept="image/*" <?= $isEdit ? '' : 'required' ?>>
                            
                            <?php if($isEdit): ?>
                                <small class="text-info d-block mt-1 fw-semibold">
                                    INFO: Mengunggah foto baru akan MENGHAPUS & MENGGANTI foto lama. Kosongkan jika tidak ingin mengubah foto.
                                </small>
                            <?php endif; ?>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('admin/destinasi') ?>" class="btn btn-light border">Batal</a>
                            <button type="submit" class="btn" style="background-color: #f26e22; color: white;">
                                <?= $isEdit ? 'Update' : 'Simpan' ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                    <h5 class="fw-bold mb-0">Daftar Destinasi</h5>
                </div>
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 50px;">No</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th class="text-center" style="width: 140px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($destinasi)): ?>
                                    <?php $no = 1; foreach($destinasi as $dest): ?>
                                        <tr>
                                            <td class="fw-semibold text-secondary"><?= $no++ ?></td>
                                            <td>
                                                <img src="<?= base_url('uploads/destinasi/' . $dest['image']) ?>" alt="Foto" class="rounded object-fit-cover" style="width: 60px; height: 60px;">
                                            </td>
                                            <td class="fw-bold"><?= esc($dest['name']) ?></td>
                                            <td class="text-muted small"><?= esc($dest['address']) ?></td>
                                            <td class="text-center">
                                                <div class="btn-group gap-1">
                                                    <a href="<?= base_url('admin/destinasi/edit/'. $dest['id']) ?>" class="btn btn-sm btn-outline-warning rounded">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger rounded btn-hapus" 
                                                            data-id="<?= $dest['id'] ?>" data-name="<?= esc($dest['name']) ?>">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4 small">Belum ada destinasi yang dibuat.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        
        // --- LOGIKA SWEET ALERT ---
        <?php if(session()->getFlashdata('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= session()->getFlashdata('success') ?>',
                confirmButtonColor: '#f26e22'
            }).then(() => {
                if ("<?= $isEdit ?>") {
                    window.location.href = "<?= base_url('admin/destinasi') ?>";
                }
            });
        <?php endif; ?>

        const deleteButtons = document.querySelectorAll('.btn-hapus');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                
                Swal.fire({
                    title: 'Hapus Destinasi?',
                    text: `Destinasi "${name}" beserta fotonya akan dihapus permanen!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `<?= base_url('admin/destinasi/delete') ?>/${id}`;
                    }
                });
            });
        });

        // --- LOGIKA INTERAKTIF PETA LEAFLET (Pusat Sulawesi Tenggara) ---
        
        var isEditMode = <?= $isEdit ? 'true' : 'false' ?>;
        
        // Jika mode edit, titik di lokasi data. Jika tambah baru, titik berpusat di tengah Sultra.
        var startLat = <?= $isEdit && !empty($destinasi_single['latitude']) ? $destinasi_single['latitude'] : '-4.1406' ?>;
        var startLng = <?= $isEdit && !empty($destinasi_single['longitude']) ? $destinasi_single['longitude'] : '122.1746' ?>;
        
        // Zoom lebih kecil (8) untuk mode tambah agar terlihat se-Sultra, Zoom 14 untuk mode edit agar fokus
        var startZoom = isEditMode ? 14 : 8;

        // Inisialisasi Peta
        var mapPicker = L.map('mapPicker').setView([startLat, startLng], startZoom);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(mapPicker);

        var penanda;

        // Jika mode Edit, langsung tampilkan pin di koordinat yang tersimpan di database
        if (isEditMode) {
            penanda = L.marker([startLat, startLng]).addTo(mapPicker)
                       .bindPopup("<b>Lokasi Tersimpan</b>").openPopup();
        }

        // Tangkap event klik untuk mengambil koordinat secara interaktif
        mapPicker.on('click', function(e) {
            var koordinatLat = e.latlng.lat;
            var koordinatLng = e.latlng.lng;

            // Tembak angka ke dalam input form Latitude dan Longitude
            document.getElementById('lat').value = koordinatLat;
            document.getElementById('lng').value = koordinatLng;

            // Geser pin ke titik klik baru atau buat pin baru
            if (penanda) {
                penanda.setLatLng(e.latlng);
            } else {
                penanda = L.marker(e.latlng).addTo(mapPicker);
            }
            penanda.bindPopup("<b>Lokasi Terpilih!</b><br>Koordinat siap disimpan.").openPopup();
        });
    });
</script>
<?= $this->endSection() ?>