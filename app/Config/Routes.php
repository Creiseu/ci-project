<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Route For Authentication
$routes->post('/login/data', 'AuthController::login');
$routes->get('/register', 'AuthController::register');
$routes->post('storeRegister', 'AuthController::storeRegister');
$routes->get('logout', 'AuthController::logout');

// Route For Admin
$routes->get('admin', 'AdminController::index');
$routes->get('/admin/productForm', 'AdminController::getForm');
$routes->post('/admin/saveProduct', 'AdminController::saveProduct');
$routes->post('/admin/delete', 'AdminController::delete');
$routes->post('/admin/update', 'AdminController::updateProduct');

// Route For Customer
$routes->get('customer', 'CustomerController::index');
$routes->post('/customer/cart', 'CustomerController::addToCart');
$routes->get('cart', 'CustomerController::viewCart');

$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
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