<?php
$title = "Manage Products";
require_once './includes/header.php';
require_once './db/conn.php';

// Only admins allowed
if (!isset($_SESSION['userid']) || $_SESSION['is_admin'] != 1) {
    echo "<h2>Access denied.</h2>";
    require_once './includes.footer.php';
    exit;
}

// Get all products
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<h2>Manage Products</h2>

<p><a href="admin_product_add.php">Add New Product</a></p>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Price</th>
        <th>Category</th>
        <th>Stock</th>
        <th>Actions</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td>$<?php echo $row['price']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['stock']; ?></td>
            <td>
                <a href="admin_product_edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="admin_product_delete.php?id=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>

</table>

<?php
require_once './includes/footer.php';
?>
