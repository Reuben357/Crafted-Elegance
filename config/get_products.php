<?php
global $conn;
include 'connection.php';

$stmt = $conn->prepare("SELECT * FROM products LIMIT 6");

$stmt->execute();
$shop_products = $stmt->get_result();

