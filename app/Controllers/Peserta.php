<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Peserta_form;

class Peserta extends BaseController
{
    public function save()
    {
        $model = new Peserta_form();
        // Mengambil nomor urutan terakhir dan menambahkannya
        $lastNomorDaftar = $model->getLastNomorDaftar();
        $nextNomorDaftar = $lastNomorDaftar + 1;
        // Menghasilkan nomor daftar baru dengan format yang diinginkan
        // $nomorDaftar = str_pad($nextNomorDaftar, 3, '0', STR_PAD_LEFT) . '/' . date('d/m/Y');
        $materi = $this->request->getPost('materi');
        $waktu = $this->request->getPost('waktu');
        $kelas = $this->request->getPost('tipe_kelas');
        // Logika perhitungan biaya berdasarkan pilihan
        if ($materi == 'Men' && ($waktu == 'Pagi - Siang' || $waktu == 'Sore - Malam') && $kelas == 'Reguler') {
            $biayaKursus = 10000000;
            $biayaKelas = 1000000;
        } else if ($materi == 'Women' && ($waktu == 'Pagi - Siang' || $waktu == 'Sore - Malam') && $kelas == 'Reguler') {
            $biayaKursus = 5000000;
            $biayaKelas = 500000;
        } else if ($materi == 'Kids' && ($waktu == 'Pagi - Siang' || $waktu == 'Sore - Malam') && $kelas == 'Reguler') {
            $biayaKursus = 1000000;
            $biayaKelas = 100000;
        } else if (($materi == 'Men' || $materi == 'Women' || $materi == 'Kids') && ($waktu == 'Pagi - Siang' || $waktu == 'Sore - Malam') && $kelas == 'Intensif') {
            $biayaKursus = 3000000;
            $biayaKelas = 300000;
        }
        $total = $biayaKursus + $biayaKelas;
        $data = [
            'nomor_daftar'  => $nomorDaftar,
            'nama'          => $this->request->getPost('nama'),
            'materi'        => $this->request->getPost('materi'),
            'waktu'         => $this->request->getPost('waktu'),
            'kelas'         => $this->request->getPost('tipe_kelas'),
            'biaya_kursus'  => $biayaKursus,
            'harga'   => $biayaKelas,
            'total'         => $total
        ];

        $model->insert($data);

        return view('peserta_form', ['nomorDaftar' => $nomorDaftar]) ; // Redirect ke halaman lain setelah data disimpan
    }
}
