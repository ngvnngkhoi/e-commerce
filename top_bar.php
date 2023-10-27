
<div class="top-bar">
    <?php if (isset($_SESSION['user_id'])) : ?>
        <a href="index.php">Home</a>
        <a href="cart.php">Go to Cart</a>
        <a href="account_management.php">Manage Account</a>
        <?php if ($_SESSION['role'] == 'admin') : ?>
            <a href="admin_dashboard.php">Admin Dashboard</a>
        <?php elseif ($_SESSION['role'] == 'customer') : ?>
            <a href="manage_order.php">Manage Order</a>
        <?php endif; ?>
        <a href="backend/logout.php">Logout</a>
    <?php else : ?>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
    <?php endif; ?>
</div>
