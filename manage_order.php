<?php
include 'backend/db_config.php';
session_start();

// Check if user is logged in and is a customer
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'customer') {
    header('Location: login.php');
    exit;
}

$email = $_SESSION['email'];

// Fetch orders and order items for the logged-in customer
$sql = "SELECT orders.order_id, orders.status, GROUP_CONCAT(CONCAT(order_items.item_name, ' (', order_items.quantity, ')') SEPARATOR ', ') AS items
        FROM orders
        JOIN order_items ON orders.order_id = order_items.order_id
        WHERE orders.email = ?
        GROUP BY orders.order_id";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Order</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'top_bar.php'; ?>

<h1>Manage Orders</h1>

<table>
    <thead>
    <tr>
        <th>Order ID</th>
        <th>Items</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?php echo $row['order_id']; ?></td>
            <td><?php echo $row['items']; ?></td>
            <td><?php echo $row['status']; ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>

<?php $conn->close(); ?>
