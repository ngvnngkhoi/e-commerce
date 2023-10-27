<?php
include 'backend/db_config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

$sql_products = "SELECT id, name, description, price FROM products";
$product_result = $conn->query($sql_products);

$sql_orders = "SELECT orders.order_id, orders.customer_name, orders.email, orders.address, orders.status, 
                      order_items.item_name, order_items.quantity 
               FROM orders 
               JOIN order_items ON orders.order_id = order_items.order_id";
$order_result = $conn->query($sql_orders);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'top_bar.php'; ?>

<h1>Admin Dashboard</h1>
<br><a href = 'backend/sales_data.csv'>Download Sales Data</a><br>

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $product_result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td>
                <form action="backend/delete_product.php" method="post" onsubmit="return confirm('Are you sure you want to delete this product?');">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <button type="submit">Delete</button>
                </form></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

<h2>Add New Product</h2>
<form action="backend/add_product.php" method="post">
    <label for="name">Product Name</label>
    <input type="text" id="name" name="name" required>

    <label for="description">Description</label>
    <input type="text" id="description" name="description" required>

    <label for="price">Price</label>
    <input type="text" id="price" name="price" required>

    <button type="submit">Add Product</button>
</form>
<h2>Manage Orders</h2>
<table>
    <thead>
    <tr>
        <th>Order ID</th>
        <th>Customer Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Item Name</th>
        <th>Quantity</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $order_result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['customer_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['item_name']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td>
                <form action="backend/update_order_status.php" method="post">
                    <select name="status" required>
                        <option value="" disabled selected>Select a status</option>
                        <option value="Paid" <?php echo $row['status'] == 'Paid' ? 'selected' : ''; ?>>Paid</option>
                        <option value="Processing" <?php echo $row['status'] == 'Processing' ? 'selected' : ''; ?>>Processing</option>
                        <option value="Shipped" <?php echo $row['status'] == 'Shipped' ? 'selected' : ''; ?>>Shipped</option>
                        <option value="Completed" <?php echo $row['status'] == 'Completed' ? 'selected' : ''; ?>>Completed</option>
                        <option value="Cancelled" <?php echo $row['status'] == 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                    </select>
                    <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                    <button type="submit">Update Status</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>

<?php $conn->close(); ?>