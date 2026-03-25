<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Authentication 
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::authenticate');
$routes->get('/dashboard', 'Auth::dashboard');
$routes->get('/logout', 'Auth::logout');

// Katalog Buku
$routes->get('/katalog', 'Katalog::index');

// Proses Peminjaman
$routes->get('/peminjaman/(:num)', 'Peminjaman::pinjam/$1');
$routes->post('/peminjaman/proses', 'Peminjaman::proses_peminjaman');
$routes->get('/peminjaman/perpanjang/(:num)', 'Peminjaman::perpanjang/$1');
$routes->post('/peminjaman/proses-perpanjang', 'Peminjaman::proses_perpanjang');
$routes->get('/peminjaman/kembalikan/(:num)', 'Peminjaman::kembalikan/$1');
$routes->post('/peminjaman/proses-kembalikan', 'Peminjaman::proses_kembalikan');
$routes->get('/peminjamanku', 'PeminjamanKu::index');

// Peminjaman Buku user

// Boking buku
$routes->get('/reservasi', 'Reservasi::index');

// Riwayat denda
$routes->get('/riwayat-denda', 'Denda::index');

$routes->get('/pengaturan', 'Pengaturan::index');

$routes->setAutoRoute(false);