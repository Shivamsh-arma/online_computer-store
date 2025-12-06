<?php
$title = "Your Cart";
require_once './includes/header.php';
require_once './db/conn.php';

// Make sure user is logged in
if (!isset($_SESSION['userid'])) {
    echo "<h2>You must be logged in to view your cart.</h2>";
    echo "<p><a href='login.php'>Login here</a></p>";
    require_once './includes/footer.php';
    exit;
}

$user_id = $_SESSION['userid'];

// Get cart items for this user, joined with products
$sql = "SELECT cart.id AS cart_id,
               products.name,
               products.price,
               cart.quantity
        FROM cart
        INNER JOIN products ON cart.product_id = products.id
        WHERE cart.user_id = $user_id";

$result = mysqli_query($conn, $sql);
?>

<h2>Your Shopping Cart</h2>

<?php
if (mysqli_num_rows($result) == 0) {
    echo "<p>Your cart is empty.</p>";
} else {
    $total = 0;
    ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Product</th>
            <th>Price (each)</th>
            <th>Quantity</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;
            ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td>$<?php echo $row['price']; ?></td>
                <td><?php echo $row['quantity']; ?></td>
                <td>$<?php echo number_format($subtotal, 2); ?></td>
                <td>
                    <a href="cart_remove.php?id=<?php echo $row['cart_id']; ?>">Remove</a>
                </td>
            </tr>
            <?php
        }
        ?>
        <tr>
            <td colspan="3" align="right"><strong>Total:</strong></td>
            <td colspan="2"><strong>$<?php echo number_format($total, 2); ?></strong></td>
        </tr>
    </table>

    <br>
    <a href="checkout.php">Proceed to Checkout</a>
    <?php
}
?>

<?php
require_once './includes/footer.php';
?>
