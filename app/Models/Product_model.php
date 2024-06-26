<?php namespace App\Models;
use CodeIgniter\Model;
 
class Product_model extends Model
{
    protected $table = ['product', 'users'];
    protected $primaryKey = 'product_id';
    protected $allowedFields = ['product_name', 'product_price'];
    public function getProduct($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['product_id' => $id]);
        }   
    }
    public function saveProduct($data)
    {
        $query = $this->db->table($this->table)->insert($data);
        return $query;
    }
    
    public function updateProduct($id, $data)
    {
        return $this->update($id, $data);
    }
    public function deleteProduct($id)
{
    return $this->db->table('product')->delete(['product_id' => $id]);
}
}