<?php

namespace App\Controllers;
use App\Models\KategoriModel;
use App\Models\DestinasiModel;
use App\Models\Destinasi_ImageModel;

class AdminController extends BaseController
{          
    protected $kategoriModel;
    protected $destinasiModel;
    protected $imageModel;

    public function dashboard()

    {
        
   return view('Admin/dashboard');

    }

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
        $this->destinasiModel = new DestinasiModel();
        $this->imageModel = new Destinasi_ImageModel();

    }

    public function index()
    
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        return view('Admin/kategori', $data);   
    }

    public function store()
    {
        // Validasi input Kategori
        $rules = [
            'name' => 'required|min_length[3]|is_unique[kategori.name]',
            'description' => 'permit_empty|string'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        // Eksekusi simpan ke database
        $this->kategoriModel->save([
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ]);
    // ajuan rederic agar mengembalikan nilai nya 
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');

    }

     public function edit($id) 
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['kategori_single'] = $this->kategoriModel->find($id);       
        return view('Admin/kategori', $data);
    }

    public function update ($id) 
    {
      $rules = [
            'name' => [
                'rules'  => "required|min_length[3]|is_unique[kategori.name,id,{$id}]",
                'errors' => [
                    'required'   => 'Nama kategori wajib diisi.',
                    'min_length' => 'Nama kategori minimal harus 3 huruf.',
                    'is_unique'  => 'Nama kategori ini sudah terdaftar!'
                ]
            ],
            'description' => 'permit_empty|string'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $this->kategoriModel->update($id, [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
        ]);

        return redirect()->to('admin/kategori')->with('success', 'Kategori berhasil diperbarui!');

    }
   
    public function delete($id)
    {
        // Fitur hapus data
        $this->kategoriModel->delete($id);
        return redirect()->back() ->with('success', 'Kategori berhasil dihapus.');   
    }
 

    // DESTINASI 

    public function destinasiIndex() 

    {
        $data['kategori'] = $this->kategoriModel->findAll(); 
        $allDestinasi = $this->destinasiModel->findAll();
        foreach ($allDestinasi as &$dest) {
            
        $gambarUtama = $this->imageModel->where('destination_id', $dest['id'])->first();
            
        
        $dest['image'] = $gambarUtama ? $gambarUtama['image_path'] : 'default.png';
         }

        $data['destinasi'] = $allDestinasi;
        return view('Admin/destinasi', $data);
       
    }


    public function destinasiStore()

    {
         // 1. Validasi Input Data Teks & Peta 
        $rules = [
            'kategori_id'   => 'required|numeric',
            'name'          => 'required|min_length[3]',
            'description'   => 'required',
            'address'       => 'required',
            'latitude'      => 'permit_empty|decimal',
            'longitude'     => 'permit_empty|decimal',
            'images.*'      => 'uploaded[images]|max_size[images,2048]|ext_in[images,jpg,jpeg,png]' // Max 2MB per gambar
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 2. Simpan Data Destinasi 
        $this->destinasiModel->insert([
            'kategori_id'   => $this->request->getPost('kategori_id'),
            'admin_id'      => session()->get('id'), 
            'name'          => $this->request->getPost('name'),
            'description'   => $this->request->getPost('description'),
            'address'       => $this->request->getPost('address'),
            'latitude'      => $this->request->getPost('latitude'),
            'longitude'     => $this->request->getPost('longitude')
        ]);

        
        $destinasiId = $this->destinasiModel->getInsertID();
        if ($imagefile = $this->request->getFiles()) {
            foreach ($imagefile['images'] as $img) {
                if ($img->isValid() && !$img->hasMoved()) {
                    $newName = $img->getRandomName();
                    $img->move('uploads/destinasi', $newName);
                    
                    // Simpan nama file ke database destination_images
                    $this->imageModel->save([
                        'destination_id' => $destinasiId,
                        'image_path'     => $newName,
                        'is_primary'     => false
                    ]);
                }
            }
        }

        return redirect()->to('admin/destinasi')->with('success', 'Destinasi dan gambar berhasil disimpan.');

    }


    public function destinasiEdit($id)

    {
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['destinasi_single'] = $this->destinasiModel->find($id);
        $allDestinasi = $this->destinasiModel->findAll();
        foreach ($allDestinasi as &$dest) {
            $gambarUtama = $this->imageModel->where('destination_id', $dest['id'])->first();
            $dest['image'] = $gambarUtama ? $gambarUtama['image_path'] : 'default.png';
        }
        
        $data['destinasi'] = $allDestinasi;
        return view('Admin/destinasi', $data);
    }


    public function destinasiUpdate($id)
    
    {
        $rules = [
            'name'        => 'required|min_length[3]',
            'kategori_id' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // 1. UPDATE DATA TEKS (
        $this->destinasiModel->update($id, [
            'kategori_id' => $this->request->getPost('kategori_id'),
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'address'     => $this->request->getPost('address'),
            'latitude'    => $this->request->getPost('latitude'),
            'longitude'   => $this->request->getPost('longitude'),
        ]);

        // 2. LOGIKA PENGGANTIAN FOTO LAMA KE FOTO BARU
        if ($imagefile = $this->request->getFiles()) {
            if (isset($imagefile['images']) && $imagefile['images'][0]->isValid()) { 
                $gambarLama = $this->imageModel->where('destination_id', $id)->findAll();
                foreach ($gambarLama as $imgLama) {
                    if (file_exists('uploads/destinasi/' . $imgLama['image_path'])) {
                        unlink('uploads/destinasi/' . $imgLama['image_path']);
                    }
                }
                
                // menghapus foto lama yang tersimpan di dalam database
                $this->imageModel->where('destination_id', $id)->delete();


                // === Logika penambahan foto baru dan pergantian/dihapus nya foto lama jika ada gambar yang baru
                foreach ($imagefile['images'] as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $newName = $img->getRandomName();
                        $img->move('uploads/destinasi', $newName);
                        
                        // Simpan foto baru ke tabel destination_images
                        $this->imageModel->save([
                            'destination_id' => $id,
                            'image_path'     => $newName,
                            'is_primary'     => false
                        ]);
                    }
                }
            }
        }

        return redirect()->to('admin/destinasi')->with('success', 'Data destinasi dan foto berhasil diperbarui!');
    }

    public function destinasiDelete($id)

    {
        $gambarDestinasi = $this->imageModel->where('destination_id', $id)->findAll();
        foreach ($gambarDestinasi as $img) {
            if (file_exists('uploads/destinasi/' . $img['image_path'])) {
                unlink('uploads/destinasi/' . $img['image_path']);
            }
        }
        $this->imageModel->where('destination_id', $id)->delete();
        $this->destinasiModel->delete($id);
        return redirect()->to('admin/destinasi')->with('success', 'Destinasi wisata beserta semua fotonya berhasil dihapus permanen.');

    }

    public function reviewIndex()
    {
        $reviewModel = new \App\Models\ReviewModel();

        // 1. Variabel diubah menjadi $data['reviews'] (Pakai 's')
        $data['reviews'] = $reviewModel->select('review.*, users.username as nama_user, destinasi.name as nama_destinasi')
                                       // 2. Nama tabel diperbaiki menjadi 'users'
                                       ->join('users', 'users.id = review.user_id', 'LEFT')
                                       // 3. Ditambahkan 'review.' di depan destination_review_id
                                       ->join('destinasi', 'destinasi.id = review.destination_review_id', 'LEFT')
                                       ->orderBy('review.created_at', 'DESC')
                                       ->findAll();

        return view('Admin/review', $data);
    }

    public function reviewDelete($id)
    {
        $reviewModel = new \App\Models\ReviewModel();
        
        // Hapus ulasan berdasarkan ID
        $reviewModel->delete($id);
        
        // Kembalikan ke halaman daftar review
        return redirect()->to('admin/review')->with('success', 'Ulasan berhasil dihapus.');
    }

 }


