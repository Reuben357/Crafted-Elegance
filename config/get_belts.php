<?php
global $conn;
include 'connection.php';

$stmt = $conn->prepare("SELECT * FROM products WHERE product_category='Belt'");

$stmt->execute();
$belt_products = $stmt->get_result();

