<?php

// 1. Sesuaikan namespace agar masuk ke sub-folder Api
namespace App\Controllers\Api;

// 2. WAJIB mengimpor library ResourceController agar sistem tidak error
use CodeIgniter\RESTful\ResourceController;

class ApiController extends ResourceController
{
    // Menggunakan Format Response JSON bawaan CodeIgniter 4
    protected $format = 'json';

    public function getLokasi($id)
    {
        // 1. Panggil model Destinasi Anda (Pastikan nama model sesuai dengan milik Anda)
        $destinasiModel = new \App\Models\DestinasiModel();
        
        // 2. Cari data destinasi berdasarkan ID yang dikirim oleh Frontend
        $destinasi = $destinasiModel->find($id);

        // 3. Jika data ditemukan, semburkan koordinatnya dalam format JSON
        if ($destinasi) {
            return $this->respond([
                'status'    => 'success',
                'id'        => $destinasi['id'],
                'nama'      => $destinasi['name'], 
                'latitude'  => $destinasi['latitude'],
                'longitude' => $destinasi['longitude']
            ], 200);
        } else {
            // Jika ID tidak ada, kirim status error 404 beserta pesan bawaan RESTful
            return $this->failNotFound('Data lokasi destinasi tidak ditemukan.');
        }
    }
}