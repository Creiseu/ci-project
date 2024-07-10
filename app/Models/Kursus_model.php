<?php

namespace App\Models;

use CodeIgniter\Model;

class Kursus_model extends Model
{
    protected $table            = 'kursus';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'nomor_daftar', 'nama', 'materi', 'waktu', 'kelas', 'biaya_kursus', 'harga', 'total'];

    public function getKursus($id = false)
    {
        if($id === false){
            return $this->findAll();
        }else{
            return $this->getWhere(['id' => $id]);
        }   
    }
    public function kursus()
    {
        $muser = new Kursus_model();
        $kursus = $muser->getKursus(); // Mengambil data produk dari model

        // Kirim data produk ke view product_view.php
        return view('kursus_view', ['kursus' => $kursus]);
    }
    // public function saveKursus($data)
    // {
    //     $query = $this->db->table($this->table)->insert($data);
    //     return $query;
    // }
    
    public function updateKursus($id, $data)
    {
        return $this->update($id, $data);
    }

    public function getLastNomorDaftar()
    {
        $lastEntry = $this->selectMax('nomor_daftar')->first();
        if ($lastEntry) {
            $lastNomorDaftar = (int) explode('/', $lastEntry['nomor_daftar'])[0];
            return $lastNomorDaftar;
        } else {
            return 0;
        }
    }
    public function deleteKursus($id)
    {
        return $this->db->table('kursus')->delete(['id' => $id]);
    }
    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
