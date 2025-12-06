<?php
session_start();
require_once './db/conn.php';

// Check if user is logged in
if (!isset($_SESSION['userid'])) {
    echo "You must be logged in to add items to your cart.<br>";
    echo "<a href='login.php'>Login</a>";
    exit;
}

$user_id = $_SESSION['userid'];
$product_id = (int) $_GET['id'];

// Check if product already in cart
$sql_check = "SELECT * FROM cart WHERE user_id = $user_id AND product_id = $product_id";
$result_check = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
    // Already in cart, increase quantity
    $sql_update = "UPDATE cart SET quantity = quantity + 1 
                   WHERE user_id = $user_id AND product_id = $product_id";
    mysqli_query($conn, $sql_update);
} else {
    // Insert new item
    $sql_insert = "INSERT INTO cart (user_id, product_id, quantity)
                   VALUES ($user_id, $product_id, 1)";
    mysqli_query($conn, $sql_insert);
}

echo "Item added to cart!<br>";
echo "<a href='cart.php'>Go to Cart</a>";
?>
