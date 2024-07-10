<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        /* Styling untuk cart items */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }

        .cart-items {
            margin-top: 20px;
        }

        .cart-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
            display: flex;
            align-items: center;
        }
        
        .cart-item img {
            width: 80px;
            margin-right: 20px;
        }
        
        .cart-item .details {
            flex: 1;
        }
        
        .cart-item .details h3 {
            margin: 0;
            font-size: 18px;
        }
        
        .cart-item .details p {
            margin: 5px 0;
            color: #777;
        }

        .cart-item .details .price {
            font-weight: bold;
        }

        .cart-item .quantity-input {
            margin-left: auto;
        }

        .cart-item .quantity-input input {
            width: 40px;
            text-align: center;
        }

        .checkout-btn {
            margin-top: 20px;
            margin-left: auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .checkout-btn:hover {
            background-color: #0056b3;
        }

        .subtotal {
            margin-top: 20px;
            text-align: right;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <h1>Your Shopping Cart</h1>
    <div class="cart-items">
        <?php 
        $total = 0;
        foreach ($products as $product): 
            $subtotal = $product['price'] * $product['quantity'];
            $total += $subtotal;
        ?>
            <div class="cart-item">
                <img src="<?= base_url('uploads/' . $product['image']); ?>" alt="Product Image">
                <div class="details">
                    <h3><?= $product['product_name']; ?></h3>
                    <p>Stock: <?= $product['stock']; ?></p>
                    <p class="price">Price: Rp.<?= $product['price']; ?></p>
                </div>
                <div class="quantity-input">
                    <input type="number" name="quantity[]" value="<?= $product['quantity']; ?>" min="1">
                </div>
                <div class="subtotal">
                    Subtotal: Rp.<?= $subtotal; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="subtotal">
        <h3>Total: Rp.<?= $total; ?></h3>
    </div>

    <button class="checkout-btn">Checkout</button>
</body>
</html>
