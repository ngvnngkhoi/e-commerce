<?php
session_start();
include 'db_config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

if (isset($_POST['switch_role'])) {
    $new_role = $_POST['switch_role'];
    $user_id = $_SESSION['user_id'];
    $sql = "UPDATE users SET role = '$new_role' WHERE id = $user_id";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['role'] = $new_role;
        echo json_encode(['message' => 'Role updated successfully']);
    } else {
        echo json_encode(['error' => 'Unable to update role']);
    }
}
$conn->close();
?>
