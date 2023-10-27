<?php
session_start();
include 'db_config.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];

    // User details
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];

    // Address details
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postal_code = $_POST['postal_code'];
    $country = $_POST['country'];

    // Update user details
    $user_sql = "UPDATE users SET first_name=?, last_name=?, email=? WHERE id=?";
    $user_stmt = $conn->prepare($user_sql);
    $user_stmt->bind_param("sssi", $first_name, $last_name, $email, $user_id);
    $user_stmt->execute();

    // Update address details
    $address_sql = "INSERT INTO addresses (user_id, street_address, city, state, postal_code, country) 
                    VALUES (?, ?, ?, ?, ?, ?)
                    ON DUPLICATE KEY UPDATE street_address = VALUES(street_address), city = VALUES(city),
                                            state = VALUES(state), postal_code = VALUES(postal_code),
                                            country = VALUES(country)";
    $address_stmt = $conn->prepare($address_sql);
    $address_stmt->bind_param("isssss", $user_id, $street_address, $city, $state, $postal_code, $country);
    $address_stmt->execute();

    if ($user_stmt->affected_rows > 0 || $address_stmt->affected_rows > 0) {
        echo json_encode(['message' => 'Profile and address updated successfully.']);
    } else {
        echo json_encode(['error' => 'Unable to update profile or address, or no changes made.']);
    }
}
$conn->close();
?>
