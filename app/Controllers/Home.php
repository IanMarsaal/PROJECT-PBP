<?php

namespace App\Controllers;

use App\Models\DestinasiModel;
use App\Models\KategoriModel;
use App\Models\Destinasi_ImageModel;
use App\Models\ReviewModel; 

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

    // 1. Halaman Beranda (Menampilkan 8 Destinasi Terbaru + Rating)
    public function index()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        
        // KEMBANGAN: Menggunakan Query Builder untuk menghitung rata-rata rating secara real-time
        $db = \Config\Database::connect();
        $builder = $db->table('destinasi');
        $builder->select('destinasi.*, ROUND(AVG(review.rating), 1) as rating_rata_rata');
        $builder->join('review', 'review.destination_review_id = destinasi.id', 'left');
        $builder->groupBy('destinasi.id');
        $builder->orderBy('destinasi.created_at', 'DESC');
        $builder->limit(8);
        
        $destinasi = $builder->get()->getResultArray();

        // Ambil foto utama untuk setiap destinasi
        foreach ($destinasi as &$dest) {
            $gambar = $this->imageModel->where('destination_id', $dest['id'])->first();
            $dest['image'] = $gambar ? $gambar['image_path'] : 'default.png';
        }

        $data['destinasi'] = $destinasi;
        return view('Home', $data);
    }

    public function destinasi()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        
        $kategori = $this->request->getVar('kategori');
        $search = $this->request->getVar('search');

        $db = \Config\Database::connect();
        $builder = $db->table('destinasi');
        $builder->select('destinasi.*, ROUND(AVG(review.rating), 1) as rating_rata_rata');
        $builder->join('review', 'review.destination_review_id = destinasi.id', 'left');

        if ($kategori) {
            $builder->where('destinasi.kategori_id', $kategori);
        }
        
        if ($search) {
            $builder->groupStart()
                    ->like('destinasi.name', $search)
                    ->orLike('destinasi.address', $search)
                    ->groupEnd();
        }

        $builder->groupBy('destinasi.id');
        $builder->orderBy('destinasi.name', 'ASC');
        
        $allDestinasi = $builder->get()->getResultArray();

        foreach ($allDestinasi as &$dest) {
            $gambar = $this->imageModel->where('destination_id', $dest['id'])->first();
            $dest['image'] = $gambar ? $gambar['image_path'] : 'default.png';
        }

        $data['destinasi'] = $allDestinasi;
        
        // PASTIKAN BARIS INI MEMANGGIL FILE KATALOG YANG BENAR
        return view('layout/destinasi', $data);
    }

    // 3. Detail: Saat user mengklik salah satu destinasi
    public function detailDestinasi($id)
    {
        // PENGAMAN UTAMA: Jika rute tersasar dan $id bukan berupa angka (misal teks "destinasi")
        // Langsung lempar atau alihkan ke fungsi destinasi() katalog utama agar tidak error!
        if (!is_numeric($id)) {
            return $this->destinasi();
        }

        $db = \Config\Database::connect();
        $builder = $db->table('destinasi');
        $builder->select('destinasi.*, ROUND(AVG(review.rating), 1) as rating_rata_rata');
        $builder->join('review', 'review.destination_review_id = destinasi.id', 'left');
        $builder->where('destinasi.id', $id);
        $builder->groupBy('destinasi.id');
        
        $destinasiData = $builder->get()->getRowArray();

        // Cek jika data memang tidak ada di database
        if (!$destinasiData || is_null($destinasiData['id'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Destinasi dengan ID $id tidak ditemukan.");
        }
        
        $data['destinasi'] = $destinasiData;
        $data['images'] = $this->imageModel->where('destination_id', $id)->findAll();
        
        $reviewModel = new \App\Models\ReviewModel();
        $data['reviews'] = $reviewModel->select('review.*, users.username as nama_user')
                                       ->join('users', 'users.id = review.user_id', 'LEFT')
                                       ->where('review.destination_review_id', $id) 
                                       ->orderBy('review.created_at', 'DESC')
                                       ->findAll();
        
        return view('layout/detail_destinasi', $data);
    }
    // 4. Menyimpan Review Baru dari Form User
    public function simpanReview()
    {
        $destination_id = $this->request->getPost('destination_id');
        $user_id = session()->get('id'); 

        // Validasi perlindungan: Jika user iseng menembak form lewat inspect elemen tanpa login
        if (empty($user_id)) {
            return redirect()->back()->with('error', 'Anda harus login terlebih dahulu untuk memberikan ulasan!');
        }

        $data = [
            'destination_review_id' => $destination_id,
            'user_id'               => $user_id,
            'rating'                => $this->request->getPost('rating'),
            'comment'               => $this->request->getPost('comment')
        ];

        $reviewModel = new \App\Models\ReviewModel(); 
        
        if ($reviewModel->insert($data) === false) {
            return redirect()->back()->withInput()->with('errors', $reviewModel->errors()); 
        }

        // Kembali ke halaman detail destinasi dengan notifikasi sukses
        return redirect()->to('destinasi/detail/' . $destination_id)->with('success', 'Ulasan dan rating Anda berhasil diterbitkan!');
    }

    // 5. Form Kontak dan Fitur SMTP Pengaduan Email Gmail
    public function kirimPesan()
    {
        $rules = [
            'nama'  => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'pesan' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Format alamat email tidak valid! Silakan periksa kembali.');
        }

        $namaUser  = $this->request->getPost('nama');
        $emailUser = $this->request->getPost('email');
        $pesanUser = $this->request->getPost('pesan');

        $domain = substr(strrchr($emailUser, "@"), 1);
        $domainAman = ['gmail.com', 'yahoo.com', 'yahoo.co.id'];

        if (!in_array(strtolower($domain), $domainAman)) {
            return redirect()->back()->with('error', 'Pesan ditolak! Anda wajib menggunakan alamat email resmi (Gmail atau Yahoo).');
        }

        $emailService = \Config\Services::email();
        $emailService->setFrom('siparsultra@gmail.com', 'Sistem SIPAR-SULTRA');
        $emailService->setTo('siparsultra@gmail.com'); 
        $emailService->setSubject('Pengaduan/Pesan Baru dari - ' . $namaUser);
        
        $pesanEmail = "<h3>Pesan Baru dari Form Kontak SIPAR-SULTRA</h3>";
        $pesanEmail .= "<p><strong>Nama Pengirim:</strong> " . esc($namaUser) . "</p>";
        $pesanEmail .= "<p><strong>Email Pengirim:</strong> " . esc($emailUser) . "</p>";
        $pesanEmail .= "<p><strong>Isi Pesan / Keluhan:</strong><br>" . nl2br(esc($pesanUser)) . "</p>";
        
        $emailService->setMessage($pesanEmail);

        if ($emailService->send()) {
            return redirect()->back()->with('success', 'Pesan Anda berhasil dikirim! Tim SIPAR-SULTRA akan segera meninjau laporan Anda.');
        } else {
            return redirect()->back()->with('error', 'Sistem gagal mengirimkan pesan. Silakan coba kembali.');
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