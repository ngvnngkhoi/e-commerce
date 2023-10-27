<?php
include 'db_config.php';
include 'mailer.php';
$username = $_POST['username'];


if(empty($username)) {
    echo "Username cannot be empty.";
    exit;
}

if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
    echo "Only letters and numbers allowed.";
    exit;
}

$sql = "SELECT * FROM users WHERE username = '$username'";

$result = $conn->query($sql);

// foreach($result as $row) {
//     //echo $row['column_name']; // Print a single column data
//     echo print_r($row);       // Print the entire row data
// }

if($result->num_rows > 0) {
    $data = $result -> fetch_all();
    $name = $data[0][4];
    $email = $data[0][6];
    $verification_code = random_int(100000, 999999);

    $send_otp = "UPDATE users SET verification_code = '$verification_code' WHERE username = '$username'";
    $result = $conn->query($send_otp);

    sendPasswordResetEmail($email, $name, $verification_code);
    header("Location: ../verification_form.php");
    
}
else {
    echo "Username does not exist.";
    exit;
}
?>