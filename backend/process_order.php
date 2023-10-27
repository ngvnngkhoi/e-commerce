<?php
include 'db_config.php';
include 'mailer.php';
include 'csv_writer.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['first_name'] . ' ' . $_POST['last_name'];
    $email = $_POST['email'];
    $address = $_POST['street_address'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['postal_code'] . ', ' . $_POST['country'];
    $status = 'Paid';

    $sql = "INSERT INTO orders (customer_name, email, address, status) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $customer_name, $email, $address, $status);

    if ($stmt->execute()) {
        $order_id = $conn->insert_id;
        $order_items = json_decode($_POST['order_items']);
        $quantities = json_decode($_POST['quantity']);


        $sql = "INSERT INTO order_items (order_id, item_name, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        for ($i = 0; $i < count($order_items); $i++) {
            $stmt->bind_param("isi", $order_id, $order_items[$i], $quantities[$i]);
            if (!$stmt->execute()) {
                echo 'Error: ' . $conn->error;
                $conn->close();
                exit();
            }
        }

        $order_info = array ($customer_name, $email, $address, $order_id);
        $order_info = array_merge($order_info, $order_info);
        $order_info = array_merge($order_info, $quantities);
        addSale($order_info);


        sendOrderConfirmationEmail($email, $_POST['first_name'], $order_id,);
        header('Location:../index.php');
    } else {
        echo 'Error: ' . $conn->error;
    }

    $conn->close();
}
?>
