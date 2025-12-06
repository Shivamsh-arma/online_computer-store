<?php
session_start();
require_once './db/conn.php';

// Only admin allowed
if (!isset($_SESSION['userid']) || $_SESSION['is_admin'] != 1) {
    echo "Access denied.";
    exit;
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Simple delete
$sql = "DELETE FROM products WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    echo "Product deleted successfully.<br>";
    echo "<a href='admin_products.php'>Back to Products</a>";
} else {
    echo "Error deleting product: " . mysqli_error($conn);
}
?>
