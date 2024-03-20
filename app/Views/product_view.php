<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <title>CRUD Table</title>
</head>
<body>

<div class="container mt-5">
  <h2 class="mb-4">CRUD Table</h2>
  <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">Create</a>
  <!-- Create Button -->
  <!-- Table -->
  <table class="table table-bordered container-fluid">
    <thead>
      <tr class="row">
        <th class="text-center col-1">No</th>
        <th class="text-center col-6">Name</th>
        <th class="text-center col-2">Price</th>
        <th class="text-center col-3">Action</th>
      </tr>
    </thead>
    <?php 
        $a = 1;
    ?>
    <tbody>
        <?php foreach($product as $row):?>
            <tr class="row">
                
                <td class="text-center col-1"><?= $a++; ?></td>
                <td class="text-center col-6"><?= $row['product_name'];?></td>
                <td class="text-center col-2"><?= $row['product_price'];?></td>
                <td class="text-center col-3">
                    <!-- Show Button -->
                    <a class="btn btn-info me-2 btn-show" href="#" data-bs-toggle="modal" data-bs-target="#showProductModal" 
                      data-name="<?= $row['product_name'];?>" data-price="<?= $row['product_price'];?>">
                      <i class="bi bi-search"></i>
                    </a>

                    <!-- Edit Button -->
                    <a class="btn btn-warning me-2 btn-edit" href="#" data-bs-toggle="modal" data-bs-target="#editProductModal" 
                      data-id="<?= $row['product_id'];?>" data-name="<?= $row['product_name'];?>" data-price="<?= $row['product_price'];?>" 
                      data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <!-- Delete Button -->
                    <a class="btn btn-danger btn-delete" href="#" data-bs-toggle="modal" data-bs-target="#deleteProductModal" 
                      data-id="<?= $row['product_id']; ?>" data-name="<?= $row['product_name']; ?>" 
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

<!-- Bootstrap Modal for Add Product -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/product/save" method="post">
          <div class="mb-3">
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="product_name" name="product_name" required>
          </div>
          <div class="mb-3">
            <label for="product_price" class="form-label">Product Price</label>
            <input type="text" class="form-control" id="product_price" name="product_price" required>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

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
            <label for="show_product_name" class="form-label">Product Name</label>
            <p id="show_product_name"></p>
          </div>
          <div class="mb-3">
            <label for="show_product_price" class="form-label">Product Price</label>
            <p id="show_product_price"></p>
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
        <form action="/product/update" method="post"> <!-- Adjust the action attribute -->
          <div class="mb-3">
            <label for="edit_product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="edit_product_name" name="edit_product_name" required>
          </div>
          <div class="mb-3">
            <label for="edit_product_price" class="form-label">Product Price</label>
            <input type="text" class="form-control" id="edit_product_price" name="edit_product_price" required>
          </div>
          <input type="hidden" id="edit_product_id" name="edit_product_id">
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
                <form id="deleteProductForm" action="/product/delete" method="post">
                    <input type="hidden" id="delete_product_id" name="delete_product_id">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
  // Add your JavaScript code for handling CRUD operations here
  // Function to handle displaying product details in the "Show Product" modal
  function showProductDetails(name, price) {
    document.getElementById('show_product_name').innerText = name;
    document.getElementById('show_product_price').innerText = price;
  }

  // Event listener for the "Show" buttons
  var showButtons = document.querySelectorAll('.btn-show');
  showButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      var productName = this.getAttribute('data-name');
      var productPrice = this.getAttribute('data-price');
      showProductDetails(productName, productPrice);
    });
  });
  function fillEditModal(id, name, price) {
    document.getElementById('edit_product_id').value = id;
    document.getElementById('edit_product_name').value = name;
    document.getElementById('edit_product_price').value = price;
  }

  // Event listener for edit buttons
  var editButtons = document.querySelectorAll('.btn-edit');
  editButtons.forEach(function(button) {
    button.addEventListener('click', function() {
      var productId = this.getAttribute('data-id');
      var productName = this.getAttribute('data-name');
      var productPrice = this.getAttribute('data-price');
      fillEditModal(productId, productName, productPrice);
    });
  });

  document.querySelectorAll('.btn-delete').forEach(button => {
    button.addEventListener('click', function() {
        var productId = this.getAttribute('data-id');
        document.getElementById('delete_product_id').value = productId;
    });
});

</script>
</body>
</html>
