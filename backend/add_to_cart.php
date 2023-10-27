<?php

session_start();
include 'db_config.php';

$data = json_decode(file_get_contents('php://input'), true);
$product_id = $data['product_id'];
$user_id = $_SESSION['user_id'];

$checkSql = "SELECT quantity FROM cart WHERE user_id = $user_id AND product_id = $product_id";
$checkResult = $conn->query($checkSql);

if ($checkResult->num_rows > 0) {
    $row = $checkResult->fetch_assoc();
    $newQuantity = $row['quantity'] + 1;
    $updateSql = "UPDATE cart SET quantity = $newQuantity WHERE user_id = $user_id AND product_id = $product_id";
    if ($conn->query($updateSql) === TRUE) {
        echo json_encode(['message' => 'Product quantity updated successfully.']);
    } else {
        echo json_encode(['message' => 'Error: ' . $updateSql . '<br>' . $conn->error]);
    }
} else {
    $insertSql = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)";
    if ($conn->query($insertSql) === TRUE) {
        echo json_encode(['message' => 'Product added to cart successfully.']);
    } else {
        echo json_encode(['message' => 'Error: ' . $insertSql . '<br>' . $conn->error]);
    }
}

$conn->close();

?>
