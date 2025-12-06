<?php
session_start();
require_once './db/conn.php';

// Check if user is logged in
if (!isset($_SESSION['userid'])) {
    echo "You must be logged in.<br>";
    echo "<a href='login.php'>Login</a>";
    exit;
}

$user_id = $_SESSION['userid'];
$cart_id = (int) $_GET['id'];

// Delete only if this cart row belongs to the logged-in user
$sql = "DELETE FROM cart WHERE id = $cart_id AND user_id = $user_id";
mysqli_query($conn, $sql);

echo "Item removed from cart.<br>";
echo "<a href='cart.php'>Back to Cart</a>";
?>
