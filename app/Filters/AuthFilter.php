<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // 1. Cek Login (Perhatikan huruf besar/kecilnya: isLoggedIn)
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Akses ditolak! Silakan login terlebih dahulu.');
        }

        // 2. Cek Hak Akses (Wajib Admin)
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('error', 'Akses ilegal! Anda bukan Admin.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada aksi setelah halaman dimuat
    }
}