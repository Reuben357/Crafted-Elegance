<?php
global $conn;
include 'connection.php';

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Jacket'");

$stmt->execute();
$jacket_products = $stmt->get_result();

