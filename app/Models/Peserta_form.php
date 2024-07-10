<?php

namespace App\Models;

use CodeIgniter\Model;

class Peserta_form extends Model
{
    protected $table            = 'kursus';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['nomor_daftar', 'nama', 'materi', 'waktu', 'kelas', 'biaya_kursus', 'harga', 'total'];

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
}
