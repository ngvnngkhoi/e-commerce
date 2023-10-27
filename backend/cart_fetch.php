<?php
session_start();
include 'backend/db_config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT products.id, products.name, products.description, products.price, cart.quantity 
        FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = $user_id";

$result = $conn->query($sql);

$total_price = 0;
$item_summary = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $total_price += $row["price"] * $row["quantity"];
        $item_summary[] = array('name' => $row["name"], 'quantity' => $row["quantity"]);
    }

    $result->data_seek(0);
}

?>