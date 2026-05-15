<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 1. JALUR WEB (Halaman Pengunjung & Admin dengan Bootstrap 5)
$routes->get('/', 'Home::index'); 
$routes->get('/register', 'AuthController::register');
$routes->post('/register/process', 'AuthController::attemptRegister');
$routes->get('/login', 'AuthController::login');
$routes->post('/login/process', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');


// Group khusus Admin 
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    
    // Dashboard Admin
    $routes->get('dashboard', 'AdminController::index');

    // CRUD KATEGORI
    $routes->get('kategori', 'KategoriController::index');
    $routes->get('kategori/create', 'KategoriController::create');
    $routes->post('kategori/store', 'KategoriController::store');
    $routes->get('kategori/edit/(:num)', 'KategoriController::edit/$1');
    $routes->post('kategori/update/(:num)', 'KategoriController::update/$1');
    $routes->get('kategori/delete/(:num)', 'KategoriController::delete/$1');

    // CRUD Destinasi (Termasuk Upload Gambar & Peta)
    $routes->get('destinasi', 'DestinasiController::index');
    $routes->get('destinasi/create', 'DestinasiController::create');
    $routes->post('destinasi/store', 'DestinasiController::store');
    $routes->get('destinasi/edit/(:num)', 'DestinasiController::edit/$1');
    $routes->post('destinasi/update/(:num)', 'DestinasiController::update/$1');
    $routes->get('destinasi/delete/(:num)', 'DestinasiController::delete/$1');

}); // <--- INI YANG HILANG (Penutup Grup Admin)


// 2. JALUR REST API (Untuk tugas web service / mobile apps)
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->post('login', 'AuthApi::login');
    $routes->get('destinasi', 'DestinasiApi::index'); 
});