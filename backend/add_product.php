<?php
include 'db_config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (empty($name) || empty($description) || !is_numeric($price)) {
        header('Location: admin_dashboard.php?error=Invalid input');
        exit;
    }

    $sql = "INSERT INTO products (name, description, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssd", $name, $description, $price);

    if ($stmt->execute()) {
        header('Location: ../admin_dashboard.php?message=Product added successfully');
    } else {
        header('Location: ../admin_dashboard.php?error=Failed to add product');
    }

    $stmt->close();
}

$conn->close();
?>
