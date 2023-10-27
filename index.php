<?php
include 'backend/db_config.php';

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include 'top_bar.php'; ?>

<h1>Product List</h1>
<div class="product-list">
    <?php
    $sql = "SELECT id, name, description, price FROM products";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div class='product'>";
            echo "<h2>" . $row["name"] . "</h2>";
            echo "<img src='backend/products/images/" . $row['id'] . ".jpg' width='200' height='200'>";
            echo "<p>" . $row["description"] . "</p>";
            echo "<p>Price: $" . $row["price"] . "</p>";
            if (isset($_SESSION['user_id'])) {
                echo "<button onclick='addToCart(" . $row["id"] . ")'>Add to Cart</button>";
            }
            echo "</div>";
        }
    } else {
        echo "No products found.";
    }
    $conn->close();
    ?>
</div>
<script>
    function addToCart(productId) {
        fetch('backend/add_to_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({product_id: productId}),
        })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
            });
    }
</script>
</body>
</html>