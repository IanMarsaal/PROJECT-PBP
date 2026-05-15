<?php

namespace App\Controllers;

use App\Models\DestinasiModel;

class Home extends BaseController
{
    public function index()
    {
        $destinationModel = new DestinasiModel();
        
        // Mengambil 8 destinasi terbaru dari database untuk ditampilkan di Beranda
        $data['destinasi'] = $destinationModel->orderBy('created_at', 'DESC')->findAll(8);

        // Memanggil file view 'home' dan mengirimkan data destinasi
        return view('Home', $data);
    }
}