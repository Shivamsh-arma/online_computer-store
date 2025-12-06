<?php
session_start();
require_once './db/conn.php';

// Make sure user is logged in
if (!isset($_SESSION['userid'])) {
    echo "You must be logged in to place an order.<br>";
    echo "<a href='login.php'>Login</a>";
    exit;
}

$user_id = $_SESSION['userid'];

// Get cart items to calculate total AND prepare for stock update
$sql = "SELECT cart.product_id, products.price, cart.quantity
        FROM cart
        INNER JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = $user_id";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Your cart is empty. <a href='products.php'>Browse products</a>";
    exit;
}

// Calculate total
$total = 0;
$items = [];

while ($row = mysqli_fetch_assoc($result)) {
    $total += $row['price'] * $row['quantity'];

    // Store items in an array so we can update stock later
    $items[] = [
        'product_id' => (int)$row['product_id'],
        'quantity'   => (int)$row['quantity']
    ];
}

// Insert into orders table
$sql_insert = "INSERT INTO orders (user_id, total_price) 
               VALUES ($user_id, $total)";

if (mysqli_query($conn, $sql_insert)) {

    // 🔻 Inventory auto-update: decrease stock for each product ordered
    foreach ($items as $item) {
        $pid  = $item['product_id'];
        $qty  = $item['quantity'];

        // Reduce stock but make sure it does not go negative
        $sql_update_stock = "
            UPDATE products 
            SET stock = GREATEST(stock - $qty, 0)
            WHERE id = $pid
        ";

        mysqli_query($conn, $sql_update_stock);
    }

    // Clear user's cart
    $sql_delete = "DELETE FROM cart WHERE user_id = $user_id";
    mysqli_query($conn, $sql_delete);

    echo "Order placed successfully!<br>";
    echo "<a href='order_history.php'>View your orders</a><br>";
    echo "<a href='products.php'>Continue shopping</a>";

} else {
    echo "Error placing order: " . mysqli_error($conn);
}
?>
