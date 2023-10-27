<?php include 'backend/account_detail_fetch.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include 'top_bar.php'; ?>
<h1>Account Management</h1>
<p>Current Role: <?php echo $current_role; ?></p>
<form action="backend/role_management.php" method="post">
    <label for="switch_role">Switch Role:</label>
    <select name="switch_role" id="switch_role">
        <option value="admin" <?php echo ($current_role == 'admin') ? 'selected' : ''; ?>>Admin</option>
        <option value="customer" <?php echo ($current_role == 'customer') ? 'selected' : ''; ?>>Customer</option>
    </select>
    <button type="submit">Switch Role</button>
</form>
<script>
    document.querySelector('form').addEventListener('submit', function(event) {
        event.preventDefault();

        var switchRole = document.getElementById('switch_role').value;
        var formData = new FormData();
        formData.append('switch_role', switchRole);

        fetch('backend/role_management.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message);
                    location.reload();
                } else if (data.error) {
                    alert(data.error);
                }
            });
    });
</script>

<?php
if (isset($_GET['message'])) {
    echo "<p class='success'>" . $_GET['message'] . "</p>";
}
if (isset($_GET['error'])) {
    echo "<p class='error'>" . $_GET['error'] . "</p>";
}
?>

<form id="update-form">
    <label for="first_name">First Name:</label>
    <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>

    <label for="last_name">Last Name:</label>
    <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

    <label for="street_address">Street Address:</label>
    <input type="text" id="street_address" name="street_address" value="<?php echo htmlspecialchars($address['street_address'] ?? ''); ?>" required>

    <label for="city">City:</label>
    <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($address['city'] ?? ''); ?>" required>

    <label for="state">State:</label>
    <input type="text" id="state" name="state" value="<?php echo htmlspecialchars($address['state'] ?? ''); ?>" required>

    <label for="postal_code">Postal Code:</label>
    <input type="text" id="postal_code" name="postal_code" value="<?php echo htmlspecialchars($address['postal_code'] ?? ''); ?>" required>

    <label for="country">Country:</label>
    <input type="text" id="country" name="country" value="<?php echo htmlspecialchars($address['country'] ?? ''); ?>" required>

    <button type="submit">Update user details</button>
</form>

<script>
    document.getElementById('update-form').addEventListener('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(event.target);

        fetch('backend/update_user_detail.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    alert(data.message);
                } else if (data.error) {
                    alert(data.error);
                }
            });
    });
</script>



</body>
</html>
