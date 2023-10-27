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
<form action="backend/get_lost_pw.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>
    <input type="submit" value="Send Password Reset">
</form>

<?php

?>
</body>