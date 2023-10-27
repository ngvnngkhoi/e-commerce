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

$sql = "DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id";
if ($conn->query($sql) === TRUE) {
    echo json_encode(['message' => 'Product removed from cart successfully.']);
} else {
    echo json_encode(['message' => 'Error: ' . $sql . '<br>' . $conn->error]);
}

$conn->close();
?>
