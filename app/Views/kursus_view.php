<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>CRUD Table</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#edit_materi, #edit_waktu, #edit_kelas').change(function() {
                var materi = $('#edit_materi').val();
                var waktu = $('#edit_waktu').val();
                var kelas = $('#edit_kelas').val();

                // Setelah mendapatkan nilai, lakukan pengecekan dan hitung biaya
                var biayaKursus = "";
                var biayaKelas = "";

                if (materi == 'Men' && (waktu == 'Pagi - Siang' || waktu == 'Sore - Malam') && kelas == 'Reguler') {
                    biayaKursus = 10000000;
                    biayaKelas = 1000000;
                    $('#edit_biaya_kursus').val(biayaKursus);
                    $('#edit_biaya_kelas').val(biayaKelas);
                    $('#edit_total').val(biayaKursus + biayaKelas);
                } else if (materi == 'Women' && (waktu == 'Pagi - Siang' || waktu == 'Sore - Malam') && kelas == 'Reguler') {
                    biayaKursus = 5000000;
                    biayaKelas = 500000;
                    $('#edit_biaya_kursus').val(biayaKursus);
                    $('#edit_biaya_kelas').val(biayaKelas);
                    $('#edit_total').val(biayaKursus + biayaKelas);
                } else if (materi == 'Kids' && (waktu == 'Pagi - Siang' || waktu == 'Sore - Malam') && kelas == 'Reguler') {
                    biayaKursus = 1000000;
                    biayaKelas = 100000;
                    $('#edit_biaya_kursus').val(biayaKursus);
                    $('#edit_biaya_kelas').val(biayaKelas);
                    $('#edit_total').val(biayaKursus + biayaKelas);
                } else if ((materi == 'Men' || materi == 'Women' || materi == 'Kids') && (waktu == 'Pagi - Siang' || waktu == 'Sore - Malam') && kelas == 'Intensif') {
                    biayaKursus = 3000000;
                    biayaKelas = 300000;
                    $('#edit_biaya_kursus').val(biayaKursus);
                    $('#edit_biaya_kelas').val(biayaKelas);
                    $('#edit_total').val(biayaKursus + biayaKelas);
                }
                var biaya1 = document.getElementById("biaya_kursus").value = biayaKursus;
                var biaya2 = document.getElementById("biaya_kursus").value = biayaKelas;
                var total_semua = biaya1 + biaya2
                document.getElementById("total").value = total_semua;
                // Set nilai biaya kursus, biaya kelas, dan total ke dalam input
                $('#edit_biaya_kursus').val(biayaKursus);
                $('#edit_biaya_kelas').val(biayaKelas);
                $('#edit_total').val(biayaKursus + biayaKelas);
            });
        });
    </script>
</head>
<body>

<div class="container mt-5">
  <a href="/login/data/new">ADD NEW PRODUCT</a>
  <h2 class="mb-4">CRUD Table</h2>
  <table class="table table-bordered container-fluid">
    <thead>
      <tr class="row">
        <th class="text-center col-1">No</th>
        <th class="text-center col-1">Nomor Daftar</th>
        <th class="text-center col-1">Nama</th>
        <th class="text-center col-1">Materi</th>
        <th class="text-center col-1">Waktu</th>
        <th class="text-center col-1">Kelas</th>
        <th class="text-center col-1">Biaya Kursus</th>
        <th class="text-center col-1">Biaya Kelas</th>
        <th class="text-center col-1">Total</th>
        <th class="text-center col-3">Action</th>
      </tr>
    </thead>
    <?php 
        $a = 1;
    ?>
    <tbody>
        <?php foreach($kursus as $row):?>
            <tr class="row">   
              <td class="text-center col-1"><?= $a++; ?></td>
              <td class="text-center col-1"><?= $row['nomor_daftar'];?></td>
              <td class="text-center col-1"><?= $row['nama'];?></td>
              <td class="text-center col-1"><?= $row['materi'];?></td>
              <td class="text-center col-1"><?= $row['waktu'];?></td>
              <td class="text-center col-1"><?= $row['kelas'];?></td>
              <td class="text-center col-1"><?= $row['biaya_kursus'];?></td>
              <td class="text-center col-1"><?= $row['biaya_kursus'];?></td>
              <td class="text-center col-1"><?= $row['total'];?></td>
              <td class="text-center col-3">
                  <!-- Show Button -->
                  <a class="btn btn-info me-2 btn-show" href="#" data-bs-toggle="modal" data-bs-target="#showProductModal" 
                    data-nomor-daftar="<?= $row['nomor_daftar'];?>" data-nama="<?= $row['nama'];?>" 
                    data-materi="<?= $row['materi'];?>"  data-waktu="<?= $row['waktu'];?>" data-kelas="<?= $row['kelas'];?>"
                    data-biaya-kursus="<?= $row['biaya_kursus'];?>" data-biaya-kelas="<?= $row['biaya_kursus'];?>" data-total="<?= $row['total'];?>">
                    <i class="bi bi-search"></i>
                  </a>

                  <!-- Edit Button -->
                  <a class="btn btn-warning me-2 btn-edit" href="#" data-bs-toggle="modal" data-bs-target="#editProductModal" 
                    data-id="<?= $row['id'];?>" data-nomor-daftar="<?= $row['nomor_daftar'];?>" data-nama="<?= $row['nama'];?>" 
                    data-materi="<?= $row['materi'];?>"  data-waktu="<?= $row['waktu'];?>" data-kelas="<?= $row['kelas'];?>"
                    data-biaya-kursus="<?= $row['biaya_kursus'];?>" data-biaya-kelas="<?= $row['biaya_kursus'];?>" data-total="<?= $row['total'];?>"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                    <i class="bi bi-pencil"></i>
                  </a>

                  <!-- Delete Button -->
                  <a class="btn btn-danger btn-delete" href="#" data-bs-toggle="modal" data-bs-target="#deleteProductModal" 
                    data-id="<?= $row['id'];?>" data-nomor-daftar="<?= $row['nomor_daftar'];?>" data-nama="<?= $row['nama'];?>" 
                    data-materi="<?= $row['materi'];?>"  data-waktu="<?= $row['waktu'];?>" data-kelas="<?= $row['kelas'];?>"
                    data-biaya-kursus="<?= $row['biaya_kursus'];?>" data-biaya-kelas="<?= $row['biaya_kursus'];?>" data-total="<?= $row['total'];?>" 
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                    <i class="bi bi-trash"></i>
                  </a>
              </td>
            </tr>
        <?php endforeach;?>
    </tbody>
  </table>
</div>
<!-- Bootstrap JS and Popper.js (required for some Bootstrap components) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/bootstrap-icons@1.19.0/font/bootstrap-icons.js"></script> 

<!-- Your custom script for handling CRUD operations -->
<script>
  // Add your JavaScript code for handling CRUD operations here
</script>
<!-- Bootstrap Modal for Show Product -->
<div class="modal fade" id="showProductModal" tabindex="-1" aria-labelledby="showProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showProductModalLabel">Show Kursus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="mb-3">
                <label for="show_nomor_daftar" class="form-label">Nomor Daftar</label>
                <p id="show_nomor_daftar"></p>
            </div>
            <div class="mb-3">
                <label for="show_nama" class="form-label">Nama</label>
                <p id="show_nama"></p>
            </div>
            <div class="mb-3">
                <label for="show_materi" class="form-label">Materi</label>
                <p id="show_materi"></p>
            </div>
            <div class="mb-3">
                <label for="show_waktu" class="form-label">Waktu</label>
                <p id="show_waktu"></p>
            </div><div class="mb-3">
                <label for="show_kelas" class="form-label">Kelas</label>
                <p id="show_kelas"></p>
            </div>
            <div class="mb-3">
                <label for="show_biaya_kursus" class="form-label">Biaya kursus</label>
                <p id="show_biaya_kursus"></p>
            </div><div class="mb-3">
                <label for="show_biaya_kelas" class="form-label">Biaya Kelas</label>
                <p id="show_biaya_kelas"></p>
            </div>
            <div class="mb-3">
                <label for="show_total" class="form-label">Total</label>
                <p id="show_total"></p>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Bootstrap Modal for Edit Product -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editProductModalLabel">Edit Kursus</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/kursus/data/save" method="post">
                <div class="mb-3">
                    <label for="edit_nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="edit_nama" name="edit_nama" required>
                </div>
                <div class="mb-3">
                    <label for="edit_materi" class="form-label">Materi</label>
                    <select id="edit_materi" name="edit_materi" class="form-select">
                        <option selected disabled>Choose...</option>
                        <option value="Men">Men</option>
                        <option value="Women">Women</option>
                        <option value="Kids">Kids</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="edit_waktu" class="form-label">Waktu</label>
                    <select id="edit_waktu" name="edit_waktu" class="form-select">
                        <option selected disabled>Choose...</option>
                        <option value="Pagi - Siang">Pagi - Siang</option>
                        <option value="Sore - Malam">Sore - Malam</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="edit_kelas" class="form-label">Kelas</label>
                    <select id="edit_kelas" name="edit_kelas" class="form-select">
                        <option selected disabled>Choose...</option>
                        <option value="Reguler">Reguler</option>
                        <option value="Intensif">Intensif</option>
                    </select>
                </div><div class="mb-3">
                    <label for="edit_biaya_kursus" class="form-label">Biaya Kursus</label>
                    <input type="text" class="form-control" id="edit_biaya_kursus" name="edit_biaya_kursus" required readonly>
                </div>
                <div class="mb-3">
                    <label for="edit_biaya_kelas" class="form-label">Biaya Kelas</label>
                    <input type="text" class="form-control" id="edit_biaya_kelas" name="edit_biaya_kelas" required readonly>
                </div><div class="mb-3">
                    <label for="edit_total" class="form-label">Total</label>
                    <input type="text" class="form-control" id="edit_total" name="edit_total" required readonly>
                </div>
                <input type="hidden" id="edit_id" name="edit_id">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
  </div>
</div>
<!-- Modal untuk konfirmasi delete -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <span id="delete_kursus_name"></span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteKursusForm" action="/kursus/delete" method="post">
                    <input type="hidden" id="delete_id" name="delete_id">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
  // Add your JavaScript code for handling CRUD operations here
  // Function to handle displaying product details in the "Show Product" modal
  function showKursusDetails(nomor_daftar, nama, materi, waktu, kelas, biaya_kursus, biaya_kursus, total) {
    document.getElementById('show_nomor_daftar').innerText = nomor_daftar;
    document.getElementById('show_nama').innerText = nama;
    document.getElementById('show_materi').innerText = materi;
    document.getElementById('show_waktu').innerText = waktu;
    document.getElementById('show_kelas').innerText = kelas;
    document.getElementById('show_biaya_kursus').innerText = biaya_kursus;
    document.getElementById('show_biaya_kelas').innerText = biaya_kursus;
    document.getElementById('show_total').innerText = total;
  }

  // Event listener for the "Show" buttons
  var showButtons = document.querySelectorAll('.btn-show');
  showButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      var nomor_daftar = this.getAttribute('data-nomor-daftar');
      var nama = this.getAttribute('data-nama');
      var materi = this.getAttribute('data-materi');
      var waktu = this.getAttribute('data-waktu');
      var kelas = this.getAttribute('data-kelas');
      var biaya_kursus = this.getAttribute('data-biaya-kursus');
      var biaya_kursus = this.getAttribute('data-biaya-kelas');
      var total = this.getAttribute('data-total');
      showKursusDetails(nomor_daftar, nama, materi, waktu, kelas, biaya_kursus, biaya_kursus, total);
    });
  });

  function fillEditModal(id, nama, materi, waktu, kelas, biaya_kursus, biaya_kursus, total) {
    document.getElementById('edit_id').value = id;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_materi').value = materi;
    document.getElementById('edit_waktu').value = waktu;
    document.getElementById('edit_kelas').value = kelas;
    document.getElementById('edit_biaya_kursus').value = biaya_kursus;
    document.getElementById('edit_biaya_kelas').value = biaya_kursus;
    document.getElementById('edit_total').value = total;
  }

  // Event listener for edit buttons
  var editButtons = document.querySelectorAll('.btn-edit');
  editButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var id =this.getAttribute('data-id')
        var nama = this.getAttribute('data-nama');
        var materi = this.getAttribute('data-materi');
        var waktu = this.getAttribute('data-waktu');
        var kelas = this.getAttribute('data-kelas');
        var biaya_kursus = this.getAttribute('data-biaya-kursus');
        var biaya_kursus = this.getAttribute('data-biaya-kelas');
        var total = this.getAttribute('data-total');
      fillEditModal(id, nama, materi, waktu, kelas, biaya_kursus, biaya_kursus, total);
    });
  });

  document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function() {
        var productId = this.getAttribute('data-id');
        document.getElementById('delete_id').value = productId;
    });
});

</script>
</body>
</html>
