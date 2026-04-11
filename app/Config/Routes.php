<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Authentication 
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::authenticate');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/logout', 'Auth::logout');

// Katalog Buku
$routes->get('/katalog', 'Katalog::index');

// Proses Peminjaman
$routes->get('/peminjaman/(:num)', 'Peminjaman::loan/$1');
$routes->post('/peminjaman/proses', 'Peminjaman::loanProses');
$routes->get('/peminjaman/perpanjang/(:num)', 'Peminjaman::extend/$1');
$routes->post('/peminjaman/proses-perpanjang', 'Peminjaman::extendProses');
$routes->get('/peminjaman/kembalikan/(:num)', 'Peminjaman::return/$1');
$routes->post('/peminjaman/proses-kembalikan', 'Peminjaman::returnProses');
$routes->get('/peminjamanku', 'PeminjamanKu::index');

// Peminjaman Buku user

// Boking buku
$routes->get('/reservasi', 'Reservasi::index');
$routes->get('/reservasi/reserve/(:num)', 'Reservasi::reserve/$1');
$routes->post('/reservasi/cancel/(:num)', 'Reservasi::cancel/$1');

// Riwayat denda
$routes->get('/riwayat-denda', 'Denda::index');
$routes->post('/denda/pay-with-proof/(:num)', 'Denda::payWithProof/$1');

$routes->get('/pengaturan', 'Pengaturan::index');
$routes->post('/pengaturan/update-profil', 'Pengaturan::updateProfile');
$routes->post('/pengaturan/update-password', 'Pengaturan::updatePassword');

$routes->setAutoRoute(false);