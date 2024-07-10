<a href="<?= base_url('logout') ?>">Logout</a>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>CRUD Table</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

<div class="container mt-5">
  <a href="/admin/productForm">ADD NEW PRODUCT</a>
  <h2 class="mb-4">CRUD Table</h2>
  <a href="<?= base_url('logout') ?>">Logout</a>
  <table class="table table-bordered container-fluid">
    <thead>
      <tr class="row">
        <th class="text-center col-1">No</th>
        <th class="text-center col-2">Nama Produk</th>
        <th class="text-center col-1">Kategori</th>
        <th class="text-center col-1">Description</th>
        <th class="text-center col-1">Stock</th>
        <th class="text-center col-1">Price</th>
        <th class="text-center col-2">Image</th>
        <th class="text-center col-1">Created by</th>
        <th class="text-center col-2">Action</th>
      </tr>
    </thead>
    <?php 
        $a = 1;
    ?>
    <tbody>
        <?php foreach($product as $row):?>
            <tr class="row">   
              <td class="text-center col-1"><?= $a++; ?></td>
              <td class="text-center col-2"><?= $row['product_name'];?></td>
              <td class="text-center col-1"><?= $row['category'];?></td>
              <td class="text-center col-1"><?= $row['description'];?></td>
              <td class="text-center col-1"><?= $row['stock'];?></td>
              <td class="text-center col-1"><?= $row['price'];?></td>
              <td class="text-center col-2">
                <img src="<?= base_url('uploads/' . $row['image']); ?>" width="200px">
              </td>
              <td class="text-center col-1"><?= $row['created_by'];?></td>
              <td class="text-center col-2">
                  <!-- Show Button -->
                  <a class="btn btn-info me-2 btn-show" href="#" data-bs-toggle="modal" data-bs-target="#showProductModal" 
                    data-product_name="<?= $row['product_name'];?>" data-category="<?= $row['category'];?>" 
                    data-description="<?= $row['description'];?>" data-stock="<?= $row['stock'];?>" 
                    data-price="<?= $row['price'];?>" data-image="<?= $row['image'];?>">
                    <i class="bi bi-search"></i>
                  </a>

                  <!-- Edit Button -->
                  <a class="btn btn-warning me-2 btn-edit" href="#" data-bs-toggle="modal" data-bs-target="#editProductModal" 
                    data-id="<?= $row['id'];?>" data-product_name="<?= $row['product_name'];?>" data-category="<?= $row['category'];?>" 
                    data-description="<?= $row['description'];?>" data-stock="<?= $row['stock'];?>" 
                    data-price="<?= $row['price'];?>" data-image="<?= $row['image'];?>"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                    <i class="bi bi-pencil"></i>
                  </a>

                  <!-- Delete Button -->
                  <a class="btn btn-danger btn-delete" href="#" data-bs-toggle="modal" data-bs-target="#deleteProductModal" 
                    data-id="<?= $row['id'];?>" data-product_name="<?= $row['product_name'];?>" data-category="<?= $row['category'];?>" 
                    data-description="<?= $row['description'];?>" data-stock="<?= $row['stock'];?>" 
                    data-price="<?= $row['price'];?>" data-image="<?= $row['image'];?>"
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
        <h5 class="modal-title" id="showProductModalLabel">Show Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="mb-3">
                <label for="show_product_name" class="form-label">Nama Produk</label>
                <p id="show_product_name"></p>
            </div>
            <div class="mb-3">
                <label for="show_category" class="form-label">Kategori</label>
                <p id="show_category"></p>
            </div>
            <div class="mb-3">
                <label for="show_description" class="form-label">Deskripsi</label>
                <p id="show_description"></p>
            </div>
            <div class="mb-3">
                <label for="show_stock" class="form-label">Stok</label>
                <p id="show_stock"></p>
            </div>
            <div class="mb-3">
                <label for="show_price" class="form-label">Harga</label>
                <p id="show_price"></p>
            </div>
            <div class="mb-3">
                <label for="show_image" class="form-label">Gambar</label>
                <img id="show_image" src="" alt="Product Image" width="200px">
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
            <h5 class="modal-title" id="editProductModalLabel">Edit Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/admin/update" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="edit_product_name" class="form-label">Nama Produk</label>
                    <input type="text" class="form-control" id="edit_product_name" name="edit_product_name" required>
                </div>
                <div class="mb-3">
                    <label for="edit_category" class="form-label">Kategori</label>
                    <input type="text" class="form-control" id="edit_category" name="edit_category" required>
                </div>
                <div class="mb-3">
                    <label for="edit_description" class="form-label">Deskripsi</label>
                    <textarea class="form-control" id="edit_description" name="edit_description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="edit_stock" class="form-label">Stok</label>
                    <input type="number" class="form-control" id="edit_stock" name="edit_stock" required>
                </div>
                <div class="mb-3">
                    <label for="edit_price" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="edit_price" name="edit_price" required>
                </div>
                <div class="mb-3">
                    <label for="edit_image" class="form-label">Gambar</label>
                    <input type="file" class="form-control" id="edit_image" name="edit_image">
                    <img id="current_image" src="" alt="Current Image" style="max-width: 100%; margin-top: 10px;">
                </div>
                <input type="hidden" id="edit_id" name="edit_id">
                <input type="hidden" id="current_image_path" name="current_image_path">
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
                <p>Are you sure you want to delete <span id="delete_product_name"></span>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteProductForm" action="/admin/delete" method="post">
                    <input type="hidden" id="delete_id" name="delete_id">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // Function to handle displaying product details in the "Show Product" modal
    function showProductDetails(product_name, category, description, stock, price, image) {
        document.getElementById('show_product_name').innerText = product_name;
        document.getElementById('show_category').innerText = category;
        document.getElementById('show_description').innerText = description;
        document.getElementById('show_stock').innerText = stock;
        document.getElementById('show_price').innerText = price;
        document.getElementById('show_image').src = '<?= base_url('uploads/'); ?>' + image;
    }   

    // Event listener for the "Show" buttons
    var showButtons = document.querySelectorAll('.btn-show');
    showButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var product_name = this.getAttribute('data-product_name');
        var category = this.getAttribute('data-category');
        var description = this.getAttribute('data-description');
        var stock = this.getAttribute('data-stock');
        var price = this.getAttribute('data-price');
        var image = this.getAttribute('data-image');
        showProductDetails(product_name, category, description, stock, price, image);
    });
    });


    function fillEditModal(id, product_name, category, description, stock, price, image) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_product_name').value = product_name;
        document.getElementById('edit_category').value = category;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_stock').value = stock;
        document.getElementById('edit_price').value = price;
        document.getElementById('current_image').src = '<?= base_url('uploads/'); ?>' + image;
        document.getElementById('current_image_path').value = image;
    }

    // Event listener for edit buttons
    var editButtons = document.querySelectorAll('.btn-edit');
    editButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            var product_name = this.getAttribute('data-product_name');
            var category = this.getAttribute('data-category');
            var description = this.getAttribute('data-description');
            var stock = this.getAttribute('data-stock');
            var price = this.getAttribute('data-price');
            var image = this.getAttribute('data-image');
            fillEditModal(id, product_name, category, description, stock, price, image);
        });
    });

    // Event listener for delete buttons
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function() {
            var productId = this.getAttribute('data-id');
            document.getElementById('delete_id').value = productId;
        });
    });
</script>
</body>
</html>
