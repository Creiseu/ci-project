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

</head>
<body>
    <div class="container center">
        <form class="row g-3" action="/admin/saveProduct" method="post" enctype="multipart/form-data">
            <div class="col-md-6">
                <label for="inputNamaProduct" class="form-label">Nama Product</label>
                <input type="text" name="nama" class="form-control">
            </div>
            <div class="col-md-4">
                <label for="materi" class="form-label">Pilihan Kategori</label>
                <select id="materi" name="materi" class="form-select">
                    <option selected disabled>Choose...</option>
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                    <option value="Kids">Kids</option>
                </select>
            </div>
            <div class="col-md-12">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description"></textarea>
            </div>
            <div class="col-md-6">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="Stock" name="stock" >
            </div>
            <div class="col-md-6">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price" >
            </div>
            <div class="col-md-12">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</body>

</html>