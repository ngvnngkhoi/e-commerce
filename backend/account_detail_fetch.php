
<?php
session_start();
include 'backend/db_config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$current_role = $row['role'];
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$email = $row['email'];

$sql = "SELECT * FROM addresses WHERE user_id = $user_id";
$address_result = $conn->query($sql);
$address = $address_result->fetch_assoc();
$conn->close();

?>