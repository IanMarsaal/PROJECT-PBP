<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UsersController extends BaseController
{
   public function profil()
    {
        // Ambil ID pengguna yang sedang login dari Session
        $userId = session()->get('id');
        
        // Tarik data terbaru dari database (agar Email & No HP ikut terbawa)
        $userModel = new UsersModel();
        $data['user'] = $userModel->find($userId);

        // Tampilkan ke View Profil dengan membawa data tersebut
        return view('layout/profil', $data);
    }

    // Nanti fungsi destinasi(), kategori(), dll akan ditaruh di sini
}
