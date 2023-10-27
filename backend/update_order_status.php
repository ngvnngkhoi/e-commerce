<?php
include 'db_config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $sql = "UPDATE orders SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $status, $order_id);

    if ($stmt->execute()) {
        header('Location: ../admin_dashboard.php?message=Order status updated successfully');
    } else {
        header('Location: ../admin_dashboard.php?error=Failed to update order status');
    }

    $stmt->close();
}

$conn->close();
?>
