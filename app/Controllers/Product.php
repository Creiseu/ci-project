<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\Product_model;
 
class Product extends Controller
{
    public function index()
    {
        $model = new Product_model();
        $data['product'] = $model->getProduct();
        echo view('product_view',$data);
    }
    public function add_new()
    {
        echo view('add_product_view');
    }
 
    public function save()
    {
        $model = new Product_model();
        $data = array(
            'product_name'  => $this->request->getPost('product_name'),
            'product_price' => $this->request->getPost('product_price'),
        );
        $model->saveProduct($data);
        return redirect()->to('/product');
    }

//     public function edit($id)
// {
//     $model = new Product_model();
//     $data['product'] = $model->getProduct($id);

//     echo view('edit_product_view', $data);
// }

    public function updateProduct()
    {
        $model = new Product_model();
        $id = $this->request->getPost('edit_product_id');

        $data = [
            'product_name' => $this->request->getPost('edit_product_name'),
            'product_price' => $this->request->getPost('edit_product_price'),
        ];

        $model->updateProduct($id, $data);
        return redirect()->to('/product');
    }
    public function delete()
    {
        $id = $this->request->getPost('delete_product_id');
        $model = new Product_model();
        $model->deleteProduct($id);
        return redirect()->to('/product');
    }
    
    public function newProduct()
    {
        echo view('peserta_form2');
    }
}