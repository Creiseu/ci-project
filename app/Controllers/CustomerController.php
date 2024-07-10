<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Cart;
use App\Models\Product;
use CodeIgniter\HTTP\ResponseInterface;

class CustomerController extends BaseController
{
    public function index()
    {
        $session = session();

        // Periksa apakah user_id ada di sesi
        if ($session->get('user_id') === null) {
            // Redirect ke halaman login
            return redirect()->to('/login')->with('error', 'You need to log in first.');
        }

        $model = new Product();
        $product = $model->getProduct();

        return view('Customer/index', ['product' => $product]);
    }

    public function viewCart()
    {
        $cartModel = new Cart();
    
        // Ambil semua produk dari cart berdasarkan user yang sedang login
        $products = $cartModel->select('carts.product_id, products.product_name, products.stock, products.image, products.price')
                             ->join('products', 'products.id = carts.product_id')
                             ->where('carts.created_by', session()->get('user_id'))
                             ->findAll();
    
        // Menggabungkan produk yang memiliki product_id yang sama menjadi satu dengan quantity yang sesuai
        $cartItems = [];
        foreach ($products as $product) {
            $productId = $product['product_id'];
            if (isset($cartItems[$productId])) {
                // Jika product_id sudah ada di array, tambahkan quantity
                $cartItems[$productId]['quantity'] += 1; // Default 1 jika belum ditambahkan
            } else {
                // Jika product_id belum ada di array, tambahkan dengan quantity 1
                $cartItems[$productId] = $product;
                $cartItems[$productId]['quantity'] = 1;
            }
        }
    
        // Ubah array assosiatif ke array numerik untuk mengirimkan ke view
        $products = array_values($cartItems);
    
        return view('Cart/index', ['products' => $products]);
    }

    public function addToCart()
    {
        $session = session();
    
        // Mendapatkan ID produk dari form
        $productId = $this->request->getPost('product_id');
    
        // Mendapatkan user_id dari session (asumsikan user sudah login)
        $userId = $session->get('user_id');
    
        // Buat model Cart
        $cartModel = new Cart();
    
        // Menambahkan produk ke keranjang
        $cartModel->insert([
            'product_id' => $productId,
            'created_by' => $userId,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    
        // Set flashdata
        $session->setFlashdata('success', 'Produk telah ditambahkan ke cart.');
    
        // Redirect ke halaman keranjang atau halaman lain sesuai kebutuhan
        return redirect()->to('/customer');
    }
    
}
