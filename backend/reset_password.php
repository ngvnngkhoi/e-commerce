<?php
include 'mailer.php';
include 'db_config.php';

$input_code = $_POST['verification_code'];
$new_password = $_POST['new_password'];
$new_password2 = $_POST['new_password2'];

$sql = 'SELECT 1 FROM users WHERE verification_code = '.$input_code;
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Verification code does not exist.1";
    exit;
}

if ($new_password != $new_password2) {
    echo "Passwords do not match.";
    exit;
}

if (strlen($new_password) < 8) {
    echo "Password must be at least 8 characters.";
    exit;
}

if (!preg_match("/[A-Z]/", $new_password)) {
    echo "Password must contain at least one uppercase character.";
    exit;
}

if (!preg_match("/[a-z]/", $new_password)) {
    echo "Password must contain at least one lowercase character.";
    exit;
}

if (!preg_match("/[0-9]/", $new_password)) {
    echo "Password must contain at least one number.";
    exit;
}

$temp_pw = password_hash($new_password, PASSWORD_DEFAULT);

// $stmt = $conn->prepare('SELECT name, email FROM users WHERE verification_code = ?');
// $stmt->bind_param('s', $input_code);
// $stmt->execute();
// $result = $stmt->get_result();

$sql = 'SELECT first_name, email FROM users WHERE verification_code = '.$input_code;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();
    $name = $data['first_name'];
    $email = $data['email'];
}
else {
    echo "Verification code does not exist.";
    exit;
}


$stmt = $conn->prepare('UPDATE users SET password = ? WHERE verification_code = ?');
$stmt->bind_param('ss', $temp_pw, $input_code);
$stmt->execute();

sendPasswordChangedEmail($email, $name);
header('Location: ../login.php');
?>