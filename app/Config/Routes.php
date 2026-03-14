<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Pages::about');
$routes->get('/contact', 'Pages::contact'); 
$routes->get('/faqs', 'Pages::faqs');
$routes->get('/news', 'News::index');
$routes->setAutoRoute(false);