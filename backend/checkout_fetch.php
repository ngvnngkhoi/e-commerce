<?php
session_start();
include 'backend/db_config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$sql_user = "SELECT * FROM users WHERE id = $user_id";
$result_user = $conn->query($sql_user);
$user = $result_user->fetch_assoc();

$sql_address = "SELECT * FROM addresses WHERE user_id = $user_id";
$result_address = $conn->query($sql_address);
$address = $result_address->fetch_assoc();

$sql_cart = "SELECT products.id, products.name, products.price, cart.quantity 
             FROM cart 
             JOIN products ON cart.product_id = products.id 
             WHERE cart.user_id = $user_id";
$result_cart = $conn->query($sql_cart);

$total_price = 0;
$cart_summary = array();
while($row = $result_cart->fetch_assoc()) {
    $total_price += $row["price"] * $row["quantity"];
    $cart_summary[] = array('name' => $row["name"], 'quantity' => $row["quantity"], 'price' => $row["price"]);
}

$conn->close();
?>