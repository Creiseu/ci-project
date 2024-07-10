<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peserta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    .center {
        border: 5px solid;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        padding: 10px;
    }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#materi, #waktu, #kelas').change(function() {
                var materi = $('#materi').val();
                var waktu = $('#waktu').val();
                var kelas = $('#kelas').val();

                // Setelah mendapatkan nilai, lakukan pengecekan dan hitung biaya
                var biayaKursus = "";
                var biayaKelas = "";

                if (materi == 'Men' && (waktu == 'Pagi - Siang' || waktu == 'Sore - Malam') && kelas == 'Reguler') {
                    biayaKursus = 10000000;
                    biayaKelas = 1000000;
                    $('#biaya_kursus').val(biayaKursus);
                    $('#biaya_kelas').val(biayaKelas);
                    $('#total').val(biayaKursus + biayaKelas);
                } else if (materi == 'Women' && (waktu == 'Pagi - Siang' || waktu == 'Sore - Malam') && kelas == 'Reguler') {
                    biayaKursus = 5000000;
                    biayaKelas = 500000;
                    $('#biaya_kursus').val(biayaKursus);
                    $('#biaya_kelas').val(biayaKelas);
                    $('#total').val(biayaKursus + biayaKelas);
                } else if (materi == 'Kids' && (waktu == 'Pagi - Siang' || waktu == 'Sore - Malam') && kelas == 'Reguler') {
                    biayaKursus = 1000000;
                    biayaKelas = 100000;
                    $('#biaya_kursus').val(biayaKursus);
                    $('#biaya_kelas').val(biayaKelas);
                    $('#total').val(biayaKursus + biayaKelas);
                } else if ((materi == 'Men' || materi == 'Women' || materi == 'Kids') && (waktu == 'Pagi - Siang' || waktu == 'Sore - Malam') && kelas == 'Intensif') {
                    biayaKursus = 3000000;
                    biayaKelas = 300000;
                    $('#biaya_kursus').val(biayaKursus);
                    $('#biaya_kelas').val(biayaKelas);
                    $('#total').val(biayaKursus + biayaKelas);
                }
                var biaya1 = document.getElementById("biaya_kursus").value = biayaKursus;
                var biaya2 = document.getElementById("biaya_kelas").value = biayaKelas;
                var total_semua = biaya1 + biaya2
                document.getElementById("total").value = total_semua;
                // Set nilai biaya kursus, biaya kelas, dan total ke dalam input
                $('#biaya_kursus').val(biayaKursus);
                $('#biaya_kelas').val(biayaKelas);
                $('#total').val(biayaKursus + biayaKelas);
            });
        });
    </script>

</head>
<body>
    <div class="container center">
    <form class="row g-3" action="/data/save" method="post">
        <div class="col-md-6">
            <label for="nomor_daftar" class="form-label">Nomor Daftar</label>
            <?php
                // Mengambil nomor urutan terakhir dan menambahkannya
                $lastNomorDaftar = 1; // Misalnya 1, Anda bisa mengganti ini dengan mendapatkan data terakhir dari database
                // Menghasilkan nomor daftar baru dengan format yang diinginkan
                $nomorDaftar = str_pad($lastNomorDaftar, 3, '0', STR_PAD_LEFT) . '/' . date('d/n/Y');
            ?>
            <input type="text" name="nomor_daftar" class="form-control" value="<?= $nomorDaftar ?>" readonly>
        </div>
        <div class="col-md-6">
            <label for="inputPassword4" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control">
        </div>
        <div class="col-md-4">
            <label for="materi" class="form-label">Pilihan Materi</label>
            <select id="materi" name="materi" class="form-select">
                <option selected disabled>Choose...</option>
                <option value="Men">Men</option>
                <option value="Women">Women</option>
                <option value="Kids">Kids</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="waktu" class="form-label">Pilihan Waktu</label>
            <select id="waktu" name="waktu" class="form-select">
                <option selected disabled>Choose...</option>
                <option value="Pagi - Siang">Pagi - Siang</option>
                <option value="Sore - Malam">Sore - Malam</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="kelas" class="form-label">Kelas</label>
            <select id="kelas" name="tipe_kelas" class="form-select">
                <option selected disabled>Choose...</option>
                <option value="Reguler">Reguler</option>
                <option value="Intensif">Intensif</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="biaya_kursus" class="form-label">Biaya Kursus</label>
            <input type="text" class="form-control" id="biaya_kursus" name="biaya_kursus" value="" readonly>
        </div>
        <div class="col-md-6">
            <label for="biaya_kelas" class="form-label">Biaya Kelas</label>
            <input type="text" class="form-control" id="biaya_kelas" name="biaya_kelas" readonly>
        </div>
        <div class="col-md-12">
            <label for="total" class="form-label">Total</label>
            <input type="text" class="form-control" id="total" name="total" readonly>
        </div>
        <input type="hidden" name="biaya_kursus" id="biaya_kursus_input">
        <input type="hidden" name="biaya_kelas" id="biaya_kelas_input">
        <input type="hidden" name="total" id="total_input">
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</body>

</html>