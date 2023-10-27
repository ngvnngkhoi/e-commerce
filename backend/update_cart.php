<?php
session_start();
include 'db_config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['message' => 'User not logged in']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'];
$user_id = $_SESSION['user_id'];
$quantity = $data['quantity'];

$sql = "UPDATE cart SET quantity = $quantity WHERE user_id = $user_id AND product_id = $product_id";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'Product quantity updated successfully.']);
} else {
    echo json_encode(['message' => 'Error: ' . $sql . '<br>' . $conn->error]);
}

$conn->close();
?>
