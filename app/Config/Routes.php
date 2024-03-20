<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/hello', 'Hello::index');
$routes->get('/product', "Product::index");
$routes->get('/product/new', "Product::add_new");
$routes->post('/product/update', 'Product::updateProduct');
$routes->post('/product/save', 'Product::save');
$routes->post('/product/new/save', "Product::save");
$routes->post('/product/delete', 'Product::delete');
