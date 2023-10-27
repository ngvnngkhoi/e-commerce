CREATE TABLE `addresses` (
                             `id` int NOT NULL AUTO_INCREMENT,
                             `user_id` int NOT NULL,
                             `street_address` varchar(255) NOT NULL,
                             `city` varchar(100) NOT NULL,
                             `state` varchar(100) NOT NULL,
                             `postal_code` varchar(20) NOT NULL,
                             `country` varchar(100) NOT NULL,
                             PRIMARY KEY (`id`),
                             KEY `user_id` (`user_id`)
)

CREATE TABLE `cart` (
                        `id` int NOT NULL AUTO_INCREMENT,
                        `user_id` int NOT NULL,
                        `product_id` int NOT NULL,
                        `quantity` int NOT NULL,
                        PRIMARY KEY (`id`),
                        KEY `user_id` (`user_id`),
                        KEY `product_id` (`product_id`)
)

CREATE TABLE `orders` (
                          `order_id` int NOT NULL AUTO_INCREMENT,
                          `customer_name` varchar(255) DEFAULT NULL,
                          `email` varchar(255) DEFAULT NULL,
                          `address` text,
                          `status` enum('Paid','Processing','Shipped','Completed') DEFAULT NULL,
                          PRIMARY KEY (`order_id`)
)

CREATE TABLE `order_items` (
                               `order_item_id` int NOT NULL AUTO_INCREMENT,
                               `order_id` int NOT NULL,
                               `item_name` varchar(255) DEFAULT NULL,
                               `quantity` int DEFAULT NULL,
                               PRIMARY KEY (`order_item_id`),
                               KEY `order_id` (`order_id`)
)

CREATE TABLE `products` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `name` varchar(255) NOT NULL,
                            `description` text NOT NULL,
                            `price` decimal(10,2) NOT NULL,
                            PRIMARY KEY (`id`)
)

CREATE TABLE `users` (
                         `id` int NOT NULL AUTO_INCREMENT,
                         `username` varchar(100) NOT NULL,
                         `password` varchar(100) NOT NULL,
                         `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
                         `first_name` varchar(255) DEFAULT NULL,
                         `last_name` varchar(255) DEFAULT NULL,
                         `email` varchar(255) DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `username` (`username`)
)