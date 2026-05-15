<?php

namespace App\Controllers;

use App\Models\UsersModel;
use CodeIgniter\Controller;

class AuthController extends BaseController
{
    public function register()
    {
        return view('Auth/register');
    }

    public function attemptRegister()
    {
        $userModel = new UsersModel();

        // Validasi input
        $rules = [
            'username'     => 'required|min_length[3]|is_unique[users.username]',
            'email'        => 'required|valid_email|is_unique[users.email]',
            'password'     => 'required|min_length[6]',
            'phone_number' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Simpan data
        $userModel->save([
            'username'     => $this->request->getPost('username'),
            'email'        => $this->request->getPost('email'),
            'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'phone_number' => $this->request->getPost('phone_number'),
            'role'         => 'pengunjung', // Default role
            'api_token'    => bin2hex(random_bytes(16)) // Token otomatis untuk REST API nanti
        ]);

        return redirect()->to('/login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function login()
    {
        return view('Auth/login');
    }

    public function attemptLogin()
    {
        $session = session();
        $model = new UsersModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $model->where('email', $email)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session->set([
                    'id'       => $user['id'],
                    'username' => $user['username'],
                    'role'     => $user['role'],
                    'isLoggedIn' => true,
                ]);

                // Redirect berdasarkan role
                return ($user['role'] == 'admin') ? redirect()->to('/admin/dashboard') : redirect()->to('/');
            }
        }

        return redirect()->back()->with('error', 'Email atau Password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}