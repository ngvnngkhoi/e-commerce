<?php
require 'phpmailer/includes/PHPMailer.php';
require 'phpmailer/includes/SMTP.php';
require 'phpmailer/includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
// $mail -> SMTPDebug = true;

$mail -> isSMTP();
$mail -> Host = 'smtp.office365.com';
$mail ->SMTPAuth = true;
$mail ->SMTPSecure = 'STARTTLS';
$mail ->Port = 587;
$mail -> isHTML(true);

$mail -> Username = 'ecommercewebsite123@outlook.com';
$mail -> Password = 'Default123';

$mail -> setFrom('ecommercewebsite123@outlook.com');


function sendPasswordResetEmail($recipient, $name, $token) {
    global $mail;
    $mail -> addAddress($recipient);
    $mail -> Subject = 'Password Reset';
    $mail -> Body = '
    Dear '.$name.',
    You have requested to reset your password. Your verification code is '.$token.'.<br>

    Please click the link below to reset your password if you have not been automatically redirected.<br>

    http://localhost/ISYS2160_G6/verification_form.php 

    If you did not request to reset your password, please ignore this email.';
    $mail -> send();
}

function sendPasswordChangedEmail($recipient, $name) {
    global $mail;
    $mail -> addAddress($recipient);
    $mail -> Subject = 'Password Changed';
    $mail -> Body = '
    Dear '.$name.',
    Your password has been changed successfully.<br>

    If you did not request to change your password, please contact us immediately.';
    $mail -> send();
}

function sendAccountCreatedEmail($recipient, $name)  {
    global $mail;
    $mail -> addAddress($recipient);
    $mail -> Subject = 'Account Created Successfully';
    $mail -> Body = '
    Dear '.$name.',
    Your account has been created successfully.<br>

    Thank you for registering with us.
    '
    ;
    $mail -> send();
}

function sendOrderConfirmationEmail($recipient, $name, $order_id) {
    global $mail;
    $mail -> addAddress($recipient);
    $mail -> Subject = 'Order Confirmation';
    $mail -> Body = '
    Dear '.$name.',
    Your order has been placed successfully.

    Your order ID is '.$order_id.'.

    Thank you for shopping with us.
    '
    ;
    $mail -> send();
}

function sendOrderPaidEmail($recipient, $name, $order_id) {
    global $mail;
    $mail -> addAddress($recipient);
    $mail -> Subject = 'Order Paid';
    $mail -> Body = '
    Dear '.$name.',
    Your order has been paid.

    Your order ID is '.$order_id.'.

    Thank you for shopping with us.
    '
    ;
    $mail -> send();
}

function sendOrderShippedEmail($recipient, $name, $order_id) {
    global $mail;
    $mail -> addAddress($recipient);
    $mail -> Subject = 'Order Shipped';
    $mail -> Body = '
    Dear '.$name.',
    Your order has been shipped.

    Your order ID is '.$order_id.'.

    Thank you for shopping with us.
    '
    ;
    $mail -> send();
}

function sendOrderCancelledEmail($recipient, $name, $order_id) {
    global $mail;
    $mail -> addAddress($recipient);
    $mail -> Subject = 'Order Cancelled';
    $mail -> Body = '
    Dear '.$name.',
    Your order has been cancelled.

    Your order ID is '.$order_id.'.

    Thank you for shopping with us.
    '
    ;
    $mail -> send();
}

function sendOrderCompletedEmail($recipient, $name, $order_id) {
    global $mail;
    $mail -> addAddress($recipient);
    $mail -> Subject = 'Order Completed';
    $mail -> Body = '
    Dear '.$name.',
    Your order has been completed.

    Your order ID is '.$order_id.'.

    Thank you for shopping with us.
    '
    ;
    $mail -> send();
}

function sendOrderProcessingEmail($recipient, $name, $order_id) {
    global $mail;
    $mail -> addAddress($recipient);
    $mail -> Subject = 'Order Processing';
    $mail -> Body = '
    Dear '.$name.',
    Your order is being processed.

    Your order ID is '.$order_id.'.

    Thank you for shopping with us.
    '
    ;
    $mail -> send();
}


