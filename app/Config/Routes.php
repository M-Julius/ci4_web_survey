<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$authenticatedOnly = ['filter' => 'auth'];

$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');
$routes->get('/register', 'Auth::register');
$routes->post('/register', 'Auth::doRegister');

$routes->get('/dashboard', 'Dashboard::index', $authenticatedOnly);

$routes->get('/barang', 'Barang::index', $authenticatedOnly);
$routes->post('/barang', 'Barang::store', $authenticatedOnly);
$routes->get('/barang/(:num)', 'Barang::delete/$1', $authenticatedOnly);

$routes->get('/lokasi', 'Lokasi::index', $authenticatedOnly);
$routes->post('/lokasi', 'Lokasi::store', $authenticatedOnly);
$routes->get('/lokasi/(:num)', 'Lokasi::delete/$1', $authenticatedOnly);

$routes->get('/marketing', 'Marketing::index', $authenticatedOnly);
$routes->post('/marketing', 'Marketing::store', $authenticatedOnly);
$routes->get('/marketing/(:num)', 'Marketing::delete/$1', $authenticatedOnly);

$routes->get('/survey', 'Survey::index', $authenticatedOnly);
$routes->post('/survey', 'Survey::store', $authenticatedOnly);