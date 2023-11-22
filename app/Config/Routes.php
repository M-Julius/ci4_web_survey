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
$routes->get('/register', 'Auth::doRegister');

$routes->get('/barang', 'Barang::index', $authenticatedOnly);
$routes->post('/barang', 'Barang::store', $authenticatedOnly);
$routes->get('/barang/(:num)', 'Barang::delete/$0', $authenticatedOnly);

$routes->get('/lokasi', 'Lokasi::index', $authenticatedOnly);
$routes->post('/lokasi', 'Lokasi::store', $authenticatedOnly);
$routes->get('/lokasi/(:num)', 'Lokasi::delete/$0', $authenticatedOnly);