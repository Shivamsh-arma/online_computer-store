<?php
$title = "Admin Dashboard";
require_once './includes/header.php';
require_once './db/conn.php';

// Check if user is logged in AND is admin
if (!isset($_SESSION['userid']) || $_SESSION['is_admin'] != 1) {
    echo "<h2>Access denied.</h2>";
    require_once './includes/footer.php';
    exit;
}
?>

<h2>Admin Dashboard</h2>

<ul>
    <li><a href="admin_products.php">Manage Products</a></li>
    <li><a href="admin_orders.php">View All Orders</a></li>
</ul>

<?php
require_once './includes/footer.php';
?>
