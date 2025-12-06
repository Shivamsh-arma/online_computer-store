<?php
session_start();
require_once './db/conn.php';

// User must be logged in
if (!isset($_SESSION['userid'])) {
    echo "You must be logged in to leave a review.<br>";
    echo "<a href='login.php'>Login</a>";
    exit;
}

// Get form data
$user_id    = $_SESSION['userid'];
$product_id = (int) $_POST['product_id'];
$rating     = (int) $_POST['rating'];
$comment    = mysqli_real_escape_string($conn, $_POST['comment']);

// Basic validation for rating
if ($rating < 1 || $rating > 5) {
    echo "Invalid rating value.<br>";
    echo "<a href='product.php?id=$product_id'>Back to product</a>";
    exit;
}

// Insert into reviews table
$sql = "INSERT INTO reviews (user_id, product_id, rating, comment)
        VALUES ($user_id, $product_id, $rating, '$comment')";

if (mysqli_query($conn, $sql)) {
    echo "Review submitted successfully!<br>";
    echo "<a href='product.php?id=$product_id'>Back to product</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
