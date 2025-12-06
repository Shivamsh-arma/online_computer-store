<?php
session_start();
require_once './db/conn.php';

// Only admin allowed
if (!isset($_SESSION['userid']) || $_SESSION['is_admin'] != 1) {
    echo "Access denied.";
    exit;
}

// Get and sanitize form data
$name        = mysqli_real_escape_string($conn, $_POST['name']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$price       = (float) $_POST['price'];
$image_url   = mysqli_real_escape_string($conn, $_POST['image_url']);
$category    = mysqli_real_escape_string($conn, $_POST['category']);
$stock       = (int) $_POST['stock'];

$sql = "INSERT INTO products (name, description, price, image_url, category, stock)
        VALUES ('$name', '$description', $price, '$image_url', '$category', $stock)";

if (mysqli_query($conn, $sql)) {
    echo "Product added successfully!<br>";
    echo "<a href='admin_products.php'>Back to Products</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
