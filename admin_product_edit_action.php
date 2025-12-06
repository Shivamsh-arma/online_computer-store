<?php
session_start();
require_once './db/conn.php';

// Only admin allowed
if (!isset($_SESSION['userid']) || $_SESSION['is_admin'] != 1) {
    echo "Access denied.";
    exit;
}

$id          = (int) $_POST['id'];
$name        = mysqli_real_escape_string($conn, $_POST['name']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$price       = (float) $_POST['price'];
$image_url   = mysqli_real_escape_string($conn, $_POST['image_url']);
$category    = mysqli_real_escape_string($conn, $_POST['category']);
$stock       = (int) $_POST['stock'];

$sql = "UPDATE products
        SET name = '$name',
            description = '$description',
            price = $price,
            image_url = '$image_url',
            category = '$category',
            stock = $stock
        WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    echo "Product updated successfully!<br>";
    echo "<a href='admin_products.php'>Back to Products</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
