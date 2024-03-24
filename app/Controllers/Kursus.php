<?php

namespace App\Controllers;
use App\Models\Kursus_model;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Kursus extends BaseController
{
    public function index()
    {
        $model = new Kursus_model();
        $data['kursus'] = $model->getKursus(); // Assuming this method fetches all kursus data
    
        return view('kursus_view', $data);
    }

    public function product()
    {
        $muser = new Kursus_model();
        $kursus = $muser->getKursus(); // Mengambil data produk dari model

        // Kirim data produk ke view product_view.php
        return view('product_view', ['product' => $kursus]);
    }
    // public function add_new()
    // {
    //     echo view('add_product_view');
    // }
 
    // public function save()
    // {
    //     $model = new Kursus_model();
    //     $data = array(
    //         'product_name'  => $this->request->getPost('product_name'),
    //         'product_price' => $this->request->getPost('product_price'),
    //     );
    //     $model->saveProduct($data);
    //     return redirect()->to('/product');
    // }

    public function edit($id)
    {
        $model = new Kursus_model();
        $data['kursus'] = $model->getProduct($id);

        echo view('kursus_view', $data);
    }

    public function updateKursus()
    {
        $model = new Kursus_model();
        // Mengambil nomor urutan terakhir dan menambahkannya
        $lastNomorDaftar = $model->getLastNomorDaftar();
        $nextNomorDaftar = $lastNomorDaftar + 1;
        // Menghasilkan nomor daftar baru dengan format yang diinginkan
        $nomorDaftar = str_pad($nextNomorDaftar, 3, '0', STR_PAD_LEFT) . '/' . date('d/m/Y');
        $materi = $this->request->getPost('edit_materi');
        $waktu = $this->request->getPost('edit_waktu');
        $kelas = $this->request->getPost('edit_kelas');
        // Logika perhitungan biaya berdasarkan pilihan
        if ($materi == 'B.Inggris' && ($waktu == 'Pagi - Siang' || $waktu == 'Sore - Malam') && $kelas == 'Reguler') {
            $biayaKursus = 10000000;
            $biayaKelas = 1000000;
        } else if ($materi == 'B.Mandarin' && ($waktu == 'Pagi - Siang' || $waktu == 'Sore - Malam') && $kelas == 'Reguler') {
            $biayaKursus = 5000000;
            $biayaKelas = 500000;
        } else if ($materi == 'B.Jerman' && ($waktu == 'Pagi - Siang' || $waktu == 'Sore - Malam') && $kelas == 'Reguler') {
            $biayaKursus = 1000000;
            $biayaKelas = 100000;
        } else if (($materi == 'B.Inggris' || $materi == 'B.Mandarin' || $materi == 'B.Jerman') && ($waktu == 'Pagi - Siang' || $waktu == 'Sore - Malam') && $kelas == 'Intensif') {
            $biayaKursus = 3000000;
            $biayaKelas = 300000;
        }
        $total = $biayaKursus + $biayaKelas;
        $id = $this->request->getPost('edit_id');

        $data = [
            'nomor_daftar' => $nomorDaftar,
            'nama'         => $this->request->getPost('edit_nama'),
            'materi'       => $this->request->getPost('edit_materi'),
            'waktu'        => $this->request->getPost('edit_waktu'),
            'kelas'        => $this->request->getPost('edit_kelas'),
            'biaya_kursus' => $biayaKursus,
            'biaya_kelas'  => $biayaKelas,
            'total'        => $total
        ];

        $model->updateKursus($id, $data);
        return redirect()->to('/kursus');
    }
    public function delete()
    {
        $id = $this->request->getPost('delete_id');
        $model = new Kursus_model();
        $model->deleteKursus($id);
        return redirect()->to('/kursus');
    }
}
