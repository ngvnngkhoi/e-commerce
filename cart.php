<?php include 'backend/cart_fetch.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="style.css?v=2">
</head>
<body>
<?php include 'top_bar.php'; ?>
<div class="sidebar"><h2>Cart Summary</h2>
    <ul>
        <?php
        foreach ($item_summary as $item) {
            echo "<li>" . $item['name'] . ": " . $item['quantity'] . "</li>";
        }
        ?>
    </ul>
    <p>Total Price: $<?php echo number_format($total_price, 2); ?></p>
    <a href="checkout.php" class="checkout-button">Checkout</a>
</div>
<h1>Your Cart</h1>
<div class="product-list">
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<h2>" . $row["name"] . "</h2>";
            echo "<p>" . $row["description"] . "</p>";
            echo "<p>Price: $" . $row["price"] . " | Quantity: ";
            echo "<input type='number' id='quantity_" . $row["id"] . "' value='" . $row["quantity"] . "' min='1'>";
            echo "<button onclick='updateQuantity(" . $row["id"] . ")'>Update Quantity</button></p>";
            echo "<button onclick='removeFromCart(" . $row["id"] . ")'>Remove</button>";
            echo "</div>";
        }
    } else {
        echo "No products in cart.";
    }
    $conn->close();
    ?>

    <script>
        function removeFromCart(productId) {
            fetch('backend/remove_from_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({product_id: productId}),
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                });
        }

        function updateQuantity(productId) {
            var quantity = document.getElementById('quantity_' + productId).value;
            fetch('backend/update_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({product_id: productId, quantity: quantity}),
            })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    location.reload();
                });
        }
    </script>


</body>
</html>
