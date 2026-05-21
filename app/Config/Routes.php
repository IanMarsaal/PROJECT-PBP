<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==========================================================
// ZONA 1: PUBLIK 
// ==========================================================
    $routes->get('/', 'AuthController::login');
    $routes->get('/login', 'AuthController::login');
    $routes->post('/login', 'AuthController::attemptLogin');
    $routes->get('/register', 'AuthController::register');
    $routes->post('register', 'AuthController::attemptRegister');
    $routes->get('/logout', 'AuthController::logout');


// ==========================================================
// ZONA 2: PENGUNJUNG BIASA 
// ==========================================================;
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Home::index');
    $routes->get('beranda', 'Home::index');
    $routes->get('destinasi', 'Home::destinasi');
    $routes->get('destinasi/detail/(:num)', 'Home::detailDestinasi/$1');
    $routes->post('destinasi/review/store', 'Home::simpanReview');
    $routes->get('tentang', 'Home::tentang');
    $routes->get('kontak', 'Home::kontak');
    $routes->get('profil', 'Home::profil');
    $routes->post('kontak/kirim', 'Home::kirimPesan');
});


// ==========================================================
// ZONA 3: KHUSUS ADMIN 
// ==========================================================
    $routes->group('admin', ['filter' => 'admin'], function($routes) {
    
    // Rute Dashboard Admin
    $routes->get('dashboard', 'AdminController::dashboard');

    // CRUD KATEGORI 
    $routes->get('kategori', 'AdminController::index');
    $routes->post('kategori/store', 'AdminController::store');
    $routes->get('kategori/edit/(:num)', 'AdminController::edit/$1');
    $routes->post('kategori/update/(:num)', 'AdminController::update/$1');
    $routes->get('kategori/delete/(:num)', 'AdminController::delete/$1');

    // CRUD DESTINASI
    $routes->get('destinasi', 'AdminController::destinasiIndex');
    $routes->post('destinasi/store', 'AdminController::destinasiStore');
    $routes->get('destinasi/edit/(:num)', 'AdminController::destinasiEdit/$1');
    $routes->post('destinasi/update/(:num)', 'AdminController::destinasiUpdate/$1');
    $routes->get('destinasi/delete/(:num)', 'AdminController::destinasiDelete/$1');
    $routes->get('review', 'AdminController::reviewIndex');
    $routes->get('review/delete/(:num)', 'AdminController::reviewDelete/$1');
});

// ==========================================================
// ZONA 4: REST API 
// ==========================================================;
    
    $routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->post('login', 'AuthApi::login');
    $routes->get('destinasi', 'DestinasiApi::index');
    $routes->get('lokasi/(:num)', 'ApiController::getLokasi/$1');
});