<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<?php include 'top_bar.php'; ?>
<body>
<form action="backend/create_account.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    <label for='password2'>Confirm Password:</label>
    <input type='password' id='password2' name='password2' required><br>
    <label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname" required><br>    
    <label for="lastname">Last Name:</label>
    <input type="text" id="lastname" name="lastname" required><br>
    <label for='email'>Email:</label>
    <input type='email' id='email' name='email' required><br>
    <input type="submit" value="Register">
</form>
</body>
</html>
