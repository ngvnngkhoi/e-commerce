<?php
include 'db_config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_POST['product_id']) || !is_numeric($_POST['product_id'])) {
        header('Location: ../admin_dashboard.php?error=Invalid product ID');
        exit;
    }

    $product_id = $_POST['product_id'];

    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);

    if ($stmt->execute()) {
        header('Location: ../admin_dashboard.php?message=Product deleted successfully');
    } else {
        header('Location: ../admin_dashboard.php?error=Failed to delete product');
    }

    $stmt->close();
}

$conn->close();
?>
