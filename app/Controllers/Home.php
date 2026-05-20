<?php

namespace App\Controllers;

use App\Models\DestinasiModel;
use App\Models\KategoriModel;
use App\Models\Destinasi_ImageModel;
// use App\Models\ReviewModel; // Buka komentar ini nanti kalau tabel review sudah siap

class Home extends BaseController
{
    protected $destinasiModel;
    protected $kategoriModel;
    protected $imageModel;

    public function __construct()
    {
        // Instansiasi semua model yang dibutuhkan halaman depan
        $this->destinasiModel = new DestinasiModel();
        $this->kategoriModel = new KategoriModel();
        $this->imageModel = new Destinasi_ImageModel();
    }

    // GAMBAR 1 & 2: Halaman Beranda / Destinasi
    public function index()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        $destinasi = $this->destinasiModel->orderBy('created_at', 'DESC')->findAll(8);

        foreach ($destinasi as &$dest) {
            $gambar = $this->imageModel->where('destination_id', $dest['id'])->first();
            $dest['image'] = $gambar ? $gambar['image_path'] : 'default.png';
        }

        $data['destinasi'] = $destinasi;
        return view('Home', $data);
    }

    // 2. Destinasi: Katalog lengkap + Fitur cari & filter kategori
    public function destinasi()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        
        $kategori = $this->request->getVar('kategori');
        $search = $this->request->getVar('search');

        $query = $this->destinasiModel;
        if ($kategori) $query = $query->where('kategori_id', $kategori);
        if ($search)   $query = $query->like('name', $search)->orLike('address', $search);

        $allDestinasi = $query->findAll();

        foreach ($allDestinasi as &$dest) {
            $gambar = $this->imageModel->where('destination_id', $dest['id'])->first();
            $dest['image'] = $gambar ? $gambar['image_path'] : 'default.png';
        }

        $data['destinasi'] = $allDestinasi;
        return view('layout/destinasi', $data);
    }

    // 3. Detail: Saat user mengklik salah satu destinasi (untuk lihat lokasi/review)
    public function detailDestinasi($id)
    {
        $data['destinasi'] = $this->destinasiModel->find($id);
        if (!$data['destinasi']) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data['images'] = $this->imageModel->where('destination_id', $id)->findAll();
        $reviewModel = new \App\Models\ReviewModel();
        $data['reviews'] = $reviewModel->select('review.*, users.username as nama_user')
                                       ->join('users', 'users.id = review.user_id', 'LEFT')
                                       ->where('review.destination_review_id', $id) 
                                       ->orderBy('review.created_at', 'DESC')
                                       ->findAll();
        
        return view('layout/detail_destinasi', $data);
    }

    public function simpanReview()
    {
            
    {
        $destination_id = $this->request->getPost('destination_id');
        
        // Cek: Apakah saat login, ID user disetel dengan nama 'id', 'user_id', atau 'id_user'?
        // Sesuaikan dengan nama yang Anda pakai saat membuat session login!
        $user_id = session()->get('id'); 

        // JEBAKAN 1: Jika ternyata user belum login / session kosong
        if (empty($user_id)) {
            dd("GAGAL: ID User kosong. Pastikan Anda sudah login dan nama session-nya benar.");
        }

        // Siapkan data
        $data = [
            'destination_review_id' => $destination_id,
            'user_id'               => $user_id,
            'rating'                => $this->request->getPost('rating'),
            'comment'               => $this->request->getPost('comment')
        ];

        $reviewModel = new \App\Models\ReviewModel(); 
        
        // JEBAKAN 2: Coba paksa masukkan data (insert)
        if ($reviewModel->insert($data) === false) {
            // Jika gagal, layar akan mati dan mencetak alasan persisnya dari Model
            dd($reviewModel->errors()); 
        }

        // Jika berhasil melewati semua jebakan di atas, kembalikan ke halaman wisata
        return redirect()->to('destinasi/detail/' . $destination_id)->with('success', 'Ulasan Anda berhasil ditambahkan!');
    }

    }


    public function kirimPesan()
    {
        $nama  = $this->request->getPost('nama');
        $email = $this->request->getPost('email'); // Email si pengisi form
        $pesan = $this->request->getPost('pesan');

        // Memanggil layanan Email CodeIgniter
        $emailService = \Config\Services::email();

        // Konfigurasi isi Email
        $emailService->setFrom($email, $nama); // Dari siapa
        $emailService->setTo('sipar.sultra@gmail.com'); // Tujuan email (Email Admin Anda)
        $emailService->setSubject('Pengaduan/Pesan Baru - SIPAR SULTRA');
        $emailService->setMessage("
            <h3>Pesan Baru dari Pengunjung Website</h3>
            <p><strong>Nama:</strong> {$nama}</p>
            <p><strong>Email:</strong> {$email}</p>
            <hr>
            <p><strong>Isi Pesan:</strong></p>
            <p>{$pesan}</p>
        ");

        // Proses Kirim
        if ($emailService->send()) {
            return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Tim kami akan segera menindaklanjutinya.');
        } else {
            // Menampilkan error jika gagal terkirim (biasanya karena belum setting SMTP .env)
            return redirect()->back()->with('error', 'Gagal mengirim pesan. Pastikan koneksi dan pengaturan email server benar.');
        }
    }

    
    public function tentang()
    {
        return view('layout/tentang');
    }


    public function kontak()
    {
        return view('layout/kontak');
    }

    public function profil()
{
   
    return view('layout/profil');
}
}