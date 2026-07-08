CREATE DATABASE practice;
USE practice;

CREATE TABLE customers(
customer_id INT AUTO_INCREMENT PRIMARY KEY,
fist_name VARCHAR(50) NOT NULL,
last_name VARCHAR(50) NOT NULL,
mobile    VARCHAR(11) UNIQUE NOT NULL,
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE products(
product_id INT AUTO_INCREMENT PRIMARY KEY,
prduct_name VARCHAR(50) NOT NULL,
description TEXT,
price DECIMAL(10,2) NOT NULL,
stock_quantity INT DEFAULT (0),
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE orders(
order_id INT AUTO_INCREMENT PRIMARY KEY,
customer_id INT NOT NULL,
order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
status VARCHAR(20) DEFAULT 'pending',
FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);
CREATE TABLE order_items(
order_item_id INT AUTO_INCREMENT PRIMARY KEY,
order_id INT NOT NULL,
customer_id INT NOT NULL,
quantity INT NOT NULL DEFAULT 1,
price_at_purchase DECIMAL(10,2),
FOREIGN KEY (order_id) REFERENCES orders(order_id),
FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);


