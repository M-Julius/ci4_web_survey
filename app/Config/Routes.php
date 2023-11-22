<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::doLogin');
$routes->get('/logout', 'Auth::logout');
$routes->get('/register', 'Auth::doRegister');

$routes->get('/barang', 'Barang::index');
$routes->post('/barang', 'Barang::store');
$routes->get('/barang/(:num)', 'Barang::delete/$0');

$routes->get('/lokasi', 'Lokasi::index');
$routes->post('/lokasi', 'Lokasi::store');
$routes->get('/lokasi/(:num)', 'Lokasi::delete/$0');