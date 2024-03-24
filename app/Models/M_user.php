<?php

namespace App\Models;

use CodeIgniter\Model;

class M_user extends Model
{
    protected $table = 'users';

    public function get_data($role)
    {
        return $this->db->table($this->table)
            ->where('role', $role)
            ->get()
            ->getRowArray();
    }

    public function product()
    {
        $muser = new M_user();
        $product = $muser->get_products(); // Mengambil data produk dari model

        // Kirim data produk ke view product_view.php
        return view('product_view', ['product' => $product]);
    }
}
