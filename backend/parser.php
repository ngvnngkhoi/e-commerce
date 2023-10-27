<?php

$csvFile = file(__DIR__.'/products/products.csv');
$data = [];

for ($i = 1; $i < count($csvFile); $i++) {
    $data[] = str_getcsv($csvFile[$i]);
}


foreach ($data as $product) {
    $url = $product[3];
    $image_dir = __DIR__.'/products/images/'.$product[4].'.jpg';
    file_put_contents($image_dir, file_get_contents($url));

    $check = "SELECT * FROM products WHERE id='$product[4]'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        continue;
    }

    $sql = "INSERT INTO products (id, name, description, price, image, category, quantity, sale)
    values ('$product[4]', '$product[0]', '$product[1]', '$product[2]', '$image_dir', '$product[5]', '$product[6]', '$product[7]')";
    $conn -> query($sql);

    // print_r($conn -> error);
}


?>