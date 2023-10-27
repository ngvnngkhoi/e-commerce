<?php
include 'db_config.php';
include 'mailer.php';

$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
$email = $_POST['email'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];



if(empty($username) || empty($password)) {
    echo "Username and password cannot be empty.";
    exit;
}

if ($password != $password2) {
    echo "Passwords do not match.";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";
    exit;
}

if (!preg_match("/^[a-zA-Z ]*$/",$firstname) || !preg_match("/^[a-zA-Z ]*$/",$lastname)) {
    echo "Only letters and white space allowed.";
    exit;
}

if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
    echo "Only letters and numbers allowed.";
    exit;
}

if (strlen($password) < 8) {
    echo "Password must be at least 8 characters.";
    exit;
}

if (!preg_match("/[A-Z]/",$password)) {
    echo "Password must contain at least one uppercase character.";
    exit;
}

if (!preg_match("/[a-z]/",$password)) {
    echo "Password must contain at least one lowercase character.";
    exit;
}

if (!preg_match("/[0-9]/",$password)) {
    echo "Password must contain at least one number.";
    exit;
}



$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    echo "Username already exists.";
    $conn->close();
    exit;
}

$password_hashed = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password, last_name, first_name, email) VALUES ('$username', '$password_hashed', '$lastname', '$firstname', '$email')";

if ($conn->query($sql) === TRUE) {
    sendAccountCreatedEmail($email, $firstname);
    header('Location: ../login.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
