<?php
$title = "All Orders";
require_once './includes/header.php';
require_once './db/conn.php';

// Only admins allowed
if (!isset($_SESSION['userid']) || $_SESSION['is_admin'] != 1) {
    echo "<h2>Access denied.</h2>";
    require_once './includes/footer.php';
    exit;
}

// Join orders with users so we can see customer name & email
$sql = "SELECT orders.id,
               orders.total_price,
               orders.order_date,
               users.name,
               users.email
        FROM orders
        INNER JOIN users ON orders.user_id = users.id
        ORDER BY orders.order_date DESC";

$result = mysqli_query($conn, $sql);
?>

<h2>All Orders</h2>

<?php
if (mysqli_num_rows($result) == 0) {
    echo "<p>No orders yet.</p>";
} else {
    ?>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Total Price</th>
            <th>Order Date</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td>$<?php echo number_format($row['total_price'], 2); ?></td>
                <td><?php echo $row['order_date']; ?></td>
            </tr>
        <?php } ?>
    </table>
    <?php
}
?>

<?php
require_once './includes/footer.php';
?>
