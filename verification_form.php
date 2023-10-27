<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">

</head>
<?php include 'top_bar.php';
?>
<body>
<form action="backend/reset_password.php" method="post">
    <label for="verification_code">Verification Code:</label>
    <input type="text" id="verification_code" name="verification_code" required><br>
    <label for="new_password">New Password:</label>
    <input type="password" id="new_password" name="new_password" required><br>
    <label for="new_password2">Confirm New Password:</label>
    <input type="password" id="new_password2" name="new_password2" required><br>
    <input type="submit" value="Reset Password">
</form>

<?php

?>
</body>