<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\DestinasiModel;
use App\Models\Destinasi_ImageModel;

class DestinasiController extends BaseController
{
    protected $destinationModel;
    protected $categoryModel;
    protected $imageModel;

    public function __construct()
    {
        $this->destinationModel = new DestinasiModel();
        $this->categoryModel = new KategoriModel();
        $this->imageModel = new Destinasi_ImageModel();
    }

    public function index()
    {
        // Mengambil semua destinasi
        $data['destinasi'] = $this->destinationModel->findAll();
        return view('admin/destinasi/index', $data);
    }

    public function create()
    {
        // Melempar data kategori ke form agar bisa dipilih di Dropdown (Select)
        $data['ketegori'] = $this->categoryModel->findAll();
        return view('admin/destinasi/create', $data);
    }

    public function store()
    {
        // 1. Validasi Input Data Teks & Peta
        $rules = [
            'ketegori_id'   => 'required|numeric',
            'name'          => 'required|min_length[3]',
            'description'   => 'required',
            'address'       => 'required',
            'ticket_price'  => 'required|numeric',
            'latitude'      => 'permit_empty|decimal',
            'longitude'     => 'permit_empty|decimal',
            'images.*'      => 'uploaded[images]|max_size[images,2048]|ext_in[images,jpg,jpeg,png]' // Max 2MB per gambar
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Simpan Data Destinasi (Tabel Utama)
        $this->destinationModel->insert([
            'ketegori_id'   => $this->request->getPost('ketegori_id'),
            'admin_id'      => session()->get('id'), // Mengambil ID admin yang sedang login
            'name'          => $this->request->getPost('name'),
            'description'   => $this->request->getPost('description'),
            'address'       => $this->request->getPost('address'),
            'ticket_price'  => $this->request->getPost('ticket_price'),
            'opening_hours' => $this->request->getPost('opening_hours'),
            'latitude'      => $this->request->getPost('latitude'),
            'longitude'     => $this->request->getPost('longitude')
        ]);

        // Ambil ID destinasi yang baru saja berhasil dibuat
        $destinasiId = $this->destinationModel->getInsertID();

        // 3. Logika Upload Gambar Banyak (Multiple Files) ke Tabel Pendukung
        if ($imagefile = $this->request->getFiles()) {
            foreach ($imagefile['images'] as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    // Generate nama acak agar tidak bentrok
                    $newName = $img->getRandomName();
                    // Pindahkan gambar ke folder public/uploads/destinations
                    $img->move('public/uploads/destinasi', $newName);
                    
                    // Simpan nama file ke database destination_images
                    $this->imageModel->save([
                        'destination_id' => $destinationId,
                        'image_path'     => $newName,
                        'is_primary'     => false
                    ]);
                }
            }
        }

        return redirect()->to('/admin/destinasi')->with('success', 'Destinasi dan gambar berhasil disimpan.');
    }

    public function delete($id)
    {
        // Berdasarkan aturan database CASCADE, gambar di database akan ikut terhapus otomatis.
        // Nanti kita tambahkan logika menghapus file fisiknya jika diperlukan.
        $this->destinationModel->delete($id);
        return redirect()->to('/admin/destinasi')->with('success', 'Destinasi dihapus.');
    }
}