<?php include 'backend/checkout_fetch.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style.css?v=3">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<?php include 'top_bar.php'; ?>
<h1>Checkout</h1>
<div class="sidebar">
    <h2>Cart Summary</h2>
    <ul>
        <?php
        $order_items = [];
        $quantities = [];
        foreach ($cart_summary as $item) {
            echo "<li>" . $item['name'] . ": " . $item['quantity'] . " ($" . number_format($item['price'], 2) . " each)</li>";
            $order_items[] = $item['name'];
            $quantities[] = $item['quantity'];
        }
        $order_items_serialized = json_encode($order_items);
        $quantities_serialized = json_encode($quantities);
        ?>
    </ul>
    <p>Total Price: $<?php echo number_format($total_price, 2); ?></p>
</div>

<!-- https://www.w3schools.com/howto/howto_css_checkout_form.asp -->
<form id="checkout-form" action="backend/process_order.php" method="post">   <div class="row">
        <div class="col-75">
            <div class="container">
                <div class="row">
                    <div class="col-50">
                        <h3>Billing Address</h3>
                        <label for="first_name">First Name:</label>
                        <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required>

                        <label for="last_name">Last Name:</label>
                        <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

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
                    </div>

                    <div class="col-50">
                        <h3>Payment</h3>
                        <label for="fname">Accepted Cards</label>
                        <div class="icon-container">
                            <i class="fa fa-cc-visa" style="color:navy;"></i>
                            <i class="fa fa-cc-amex" style="color:blue;"></i>
                            <i class="fa fa-cc-mastercard" style="color:red;"></i>
                            <i class="fa fa-cc-discover" style="color:orange;"></i>
                        </div>
                        <label for="cname">Name on Card</label>
                        <input type="text" id="cname" name="cardname" placeholder="John More Doe">
                        <label for="ccnum">Credit card number</label>
                        <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444">
                        <label for="expmonth">Exp Month</label>
                        <input type="text" id="expmonth" name="expmonth" placeholder="September">
                        <div class="row">
                            <div class="col-50">
                                <label for="expyear">Exp Year</label>
                                <input type="text" id="expyear" name="expyear" placeholder="2018">
                            </div>
                            <div class="col-50">
                                <label for="cvv">CVV</label>
                                <input type="text" id="cvv" name="cvv" placeholder="352">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="order_items" value="<?php echo htmlspecialchars($order_items_serialized); ?>">
                <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($quantities_serialized); ?>">
                <button type="submit" class="btn">Process Order</button></div>
        </div>
    </div>
</form>

<script>
    document.getElementById('checkout-form').addEventListener('submit', function(event) {

    });
</script>

</body>
</html>