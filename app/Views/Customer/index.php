<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Customer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 250px;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
            margin: 10px;
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card img {
            width: 100%;
            border-bottom: 1px solid #eee;
        }

        .card h1 {
            font-size: 18px;
            margin: 15px 0;
        }

        .card .price {
            color: grey;
            font-size: 16px;
            margin: 0;
        }

        .card p {
            font-size: 14px;
            margin: 15px;
            color: #777;
        }

        .card button {
            border: none;
            outline: 0;
            padding: 10px;
            color: white;
            background-color: #007bff;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            border-radius: 0 0 10px 10px;
            transition: background-color 0.3s ease;
        }

        .card button:hover {
            background-color: #0056b3;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <p style="text-align: center; font-size: 20px;">PRODUCT LIST</p>
    <a href="cart" style="text-align: right; font-size: 20px;">CART</a>
    <div class="card-container">
        <?php foreach($product as $row): ?>
            <div class="card">
                <img src="<?= base_url('uploads/' . $row['image']); ?>" alt="Product Image">
                <h1><?= $row['product_name']; ?></h1>
                <p class="price">Rp.<?= $row['price']; ?></p>
                <p><?= $row['description']; ?></p>
                <form action="/customer/cart" method="post" style="margin-top: auto;">
                    <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <script>
            alert('<?= session()->getFlashdata('success'); ?>');
        </script>
    <?php endif; ?>
</body>
</html>
