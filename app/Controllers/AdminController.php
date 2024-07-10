<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Product;
use CodeIgniter\HTTP\ResponseInterface;

class AdminController extends BaseController
{
    public function index(){

        $model = new Product();
        $product = $model->getProduct();
        return view('Admin/index', ['product' => $product]);
    }
    public function getForm(){
        return view('Admin/create');
    }

    public function saveProduct()
    {
        $session = session();
    
        // Validasi input (opsional)
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required|min_length[3]|max_length[100]',
            'materi' => 'required',
            'description' => 'required|min_length[3]|max_length[255]',
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'image' => 'uploaded[image]|max_size[image,1024]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]'
        ]);
    
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        // Get the uploaded file
        $image = $this->request->getFile('image');
    
        // Handle the uploaded image
        $imageName = null;
        if ($image->isValid() && !$image->hasMoved()) {
            // Pindahkan file gambar ke direktori public/uploads
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads', $newName);
            $imageName = $newName;
        } else {
            // Handle invalid or no uploaded image
            $session->setFlashdata('error', 'Uploaded image is not valid or could not be moved.');
            return redirect()->back()->withInput();
        }
    
        // Simpan data ke database
        $productModel = new Product();
        $data = [
            'product_name' => $this->request->getPost('nama'),
            'category' => $this->request->getPost('materi'),
            'description' => $this->request->getPost('description'),
            'stock' => $this->request->getPost('stock'),
            'price' => $this->request->getPost('price'),
            'image' => $imageName, // Simpan nama file gambar ke database
            'created_by' => $session->get('user_id'), // Mendapatkan user_id dari session
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    
        $productModel->insert($data);
    
        // Redirect ke halaman daftar produk atau halaman lainnya
        return redirect()->to('/admin');
    }
    public function delete()
    {
        $session = session();
        $productModel = new Product();

        $id = $this->request->getPost('delete_id');

        // Pastikan produk ada sebelum menghapus
        $product = $productModel->find($id);
        if ($product) {
            // Hapus gambar dari direktori jika ada
            if ($product['image'] && file_exists(ROOTPATH . 'public/uploads/' . $product['image'])) {
                unlink(ROOTPATH . 'public/uploads/' . $product['image']);
            }

            // Hapus data produk dari database
            if ($productModel->delete($id)) {
                return redirect()->to('/admin')->with('status', 'Product deleted successfully');
            } else {
                return redirect()->to('/admin')->with('status', 'Failed to delete product');
            }
        } else {
            return redirect()->to('/admin')->with('status', 'Product not found');
        }
    }
    public function updateProduct()
    {
        $session = session();
        $productModel = new Product();

        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'edit_product_name' => 'required|min_length[3]|max_length[100]',
            'edit_category' => 'required',
            'edit_description' => 'required|min_length[3]|max_length[255]',
            'edit_stock' => 'required|integer',
            'edit_price' => 'required|integer',
            'edit_image' => 'if_exist|max_size[edit_image,1024]|is_image[edit_image]|mime_in[edit_image,image/jpg,image/jpeg,image/png]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $id = $this->request->getPost('edit_id');
        $data = [
            'product_name' => $this->request->getPost('edit_product_name'),
            'category' => $this->request->getPost('edit_category'),
            'description' => $this->request->getPost('edit_description'),
            'stock' => $this->request->getPost('edit_stock'),
            'price' => $this->request->getPost('edit_price')
        ];

        // Handle file upload
        $file = $this->request->getFile('edit_image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Move file to public/uploads directory
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $newName);
            $data['image'] = $newName;
        } else {
            // Use existing image if no new image uploaded
            $data['image'] = $this->request->getPost('current_image_path');
        }

        // Update database record
        if ($productModel->update($id, $data)) {
            return redirect()->to('/admin')->with('status', 'Product updated successfully');
        } else {
            return redirect()->to('/admin')->with('status', 'Failed to update product');
        }
    }

}
