<?php
$title = "My Orders";
require_once './includes/header.php';
require_once './db/conn.php';

// Must be logged in
if (!isset($_SESSION['userid'])) {
    echo "<h2>You must be logged in to view your orders.</h2>";
    echo "<p><a href='login.php'>Login here</a></p>";
    require_once './includes/footer.php';
    exit;
}

$user_id = $_SESSION['userid'];

$sql = "SELECT * FROM orders 
        WHERE user_id = $user_id
        ORDER BY order_date DESC";

$result = mysqli_query($conn, $sql);
?>

<h2>My Orders</h2>

<?php
if (mysqli_num_rows($result) == 0) {
    echo "<p>You have no orders yet.</p>";
} else {
    ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Order ID</th>
            <th>Total Price</th>
            <th>Order Date</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td>$<?php echo number_format($row['total_price'], 2); ?></td>
                <td><?php echo $row['order_date']; ?></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}
?>

<?php
require_once './includes/footer.php';
?>
