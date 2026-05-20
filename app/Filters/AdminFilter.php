<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Cek apakah sudah login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // 2. Cek apakah dia benar-benar seorang Admin
        if (session()->get('role') !== 'admin') {
            // Jika pengunjung biasa mencoba menyusup, tendang ke beranda!
            return redirect()->to('/beranda')->with('error', 'Akses Ditolak! Anda tidak memiliki izin untuk masuk ke ruang Admin.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}