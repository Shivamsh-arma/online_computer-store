<?php
$title = "Checkout";
require_once './includes/header.php';
require_once './db/conn.php';

// Make sure user is logged in
if (!isset($_SESSION['userid'])) {
    echo "<h2>You must be logged in to checkout.</h2>";
    echo "<p><a href='login.php'>Login here</a></p>";
    require_once './includes/footer.php';
    exit;
}

$user_id = $_SESSION['userid'];

// Get cart items
$sql = "SELECT cart.id AS cart_id,
               products.name,
               products.price,
               cart.quantity
        FROM cart
        INNER JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = $user_id";

$result = mysqli_query($conn, $sql);
?>

<h2>Checkout</h2>

<?php
if (mysqli_num_rows($result) == 0) {
    echo "<p>Your cart is empty. <a href='products.php'>Browse products</a></p>";
} else {
    $total = 0;
    ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Product</th>
            <th>Price (each)</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        <?php
        mysqli_data_seek($result, 0);
        while ($row = mysqli_fetch_assoc($result)) {
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;
            ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td>$<?php echo $row['price']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td>$<?php echo number_format($subtotal, 2); ?></td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="3" align="right"><strong>Total:</strong></td>
            <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
        </tr>
    </table>

    <br>
    <!-- Simple form that posts to the action page -->
    <form action="checkout_action.php" method="post">
        <input type="hidden" name="confirm" value="1">
        <button type="submit">Place Order</button>
    </form>
    <?php
}
?>

<?php
require_once './includes/footer.php';
?>
