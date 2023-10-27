<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "products_db";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

#uncomment this section to quickly create the database

// $sql = 'CREATE DATABASE IF NOT EXISTS '.$dbname;

// if ($conn->query($sql) === TRUE) {
//     echo "Database created successfully<br>";
// } else {
//     echo "Error creating database: " . $conn->error . "<br>";
// }

$conn -> select_db($dbname);

// #Creating tables
// $queries = [
//     'adresses' => '
//     CREATE TABLE IF NOT EXISTS addresses (
//     id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     user_id INT(6) NOT NULL,
//     street_address VARCHAR(255) NOT NULL,
//     city VARCHAR(255) NOT NULL,
//     state VARCHAR(255) NOT NULL,
//     postal_code VARCHAR(255) NOT NULL,
//     country VARCHAR(255) NOT NULL)',

//     'users' => '
//     CREATE TABLE IF NOT EXISTS users (
//         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//         username VARCHAR(30) NOT NULL,
//         password VARBINARY(255) NOT NULL,
//         role ENUM("Admin", "Customer") NOT NULL DEFAULT "Customer",
//         first_name VARCHAR(30) NOT NULL,
//         last_name VARCHAR(30) NOT NULL,
//         email VARCHAR(50),
//         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
//         recent_category INT(6) UNSIGNED,
//         recent_product INT(6) UNSIGNED,
//         verification_code VARCHAR(255)
//     );',

//     'products' => '
//     CREATE TABLE IF NOT EXISTS products (
//         id INT(6) NOT NULL,
//         name VARCHAR(30) NOT NULL,
//         description VARCHAR(255) NOT NULL,
//         price DECIMAL(10,2) NOT NULL,
//         category VARCHAR(255) NOT NULL,
//         image VARCHAR(255),
//         quantity INT(6) UNSIGNED,
//         sale INT(6) UNSIGNED,
//         PRIMARY KEY (id))',

//     'cart' => '
//     CREATE TABLE IF NOT EXISTS cart (
//         id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//         user_id INT(6) UNSIGNED,
//         product_id INT(6) UNSIGNED,
//         quantity INT(6) UNSIGNED,
//         created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)',

//     'orders' => '
//     CREATE TABLE IF NOT EXISTS orders (
//         order_id INT AUTO_INCREMENT PRIMARY KEY,
//         customer_name VARCHAR(255),
//         email VARCHAR(255),
//         address TEXT,
//         order_items TEXT,
//         quantity INT,
//         status ENUM( "Paid", "Processing", "Shipped", "Completed", "Cancelled" ))',
    
//     'order_items' => '
//         CREATE TABLE IF NOT EXISTS order_items (
//             order_item_id int NOT NULL AUTO_INCREMENT,
//             order_id int NOT NULL,
//             item_name varchar(255) DEFAULT NULL,
//             quantity int DEFAULT NULL,
//             PRIMARY KEY (order_item_id),
//             KEY order_id (order_id))'
// ];



// foreach ($queries as $table => $sql) {
//     if ($conn->query($sql) === TRUE) {
//         echo "Table $table created successfully<br>";
//     } else {
//         echo "Error creating $table: " . $conn->error . "<br>";
//     }
// }

// include 'parser.php';


?>