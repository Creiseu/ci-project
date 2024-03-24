<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/data', 'Login::login_action');
$routes->post('/login/peserta', 'Login::login_action');
$routes->post('/data/save', 'Peserta::save'); // Rute untuk menyimpan data
$routes->post('/kursus/data/save', 'Kursus::updateKursus');
$routes->get('/kursus', 'Kursus::index');
$routes->post('/kursus/delete', 'Kursus::delete');
$routes->get('/hello', 'Hello::index');
$routes->get('/product', "Product::index");
$routes->get('/product/new', "Product::add_new");
$routes->post('/product/update', 'Product::updateProduct');
$routes->post('/product/save', 'Product::save');
$routes->post('/product/new/save', "Product::save");
$routes->post('/product/delete', 'Product::delete');
