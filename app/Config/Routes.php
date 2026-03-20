<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::authenticate');

$routes->get('/dashboard', 'Auth::dashboard');
$routes->get('/logout', 'Auth::logout');
$routes->get('/katalog', 'Katalog::index');
$routes->get('/peminjamanku', 'Peminjamanku::index');
$routes->get('/reservasi', 'Reservasi::index');
$routes->get('/riwayat-denda', 'Denda::index');

$routes->setAutoRoute(false);