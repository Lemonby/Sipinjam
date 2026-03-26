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

// Riwayat denda
$routes->get('/riwayat-denda', 'Denda::index');

$routes->get('/pengaturan', 'Pengaturan::index');

$routes->setAutoRoute(false);