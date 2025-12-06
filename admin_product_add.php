<?php
$title = "Add Product";
require_once './includes/header.php';
require_once './db/conn.php';

// Only admin allowed
if (!isset($_SESSION['userid']) || $_SESSION['is_admin'] != 1) {
    echo "<h2>Access denied.</h2>";
    require_once './includes/footer.php';
    exit;
}
?>

<h2>Add New Product</h2>

<form action="admin_product_add_action.php" method="post">
    <label>Name:</label><br>
    <input type="text" name="name" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="40"></textarea><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price" required><br><br>

    <label>Image URL (e.g. img/laptop1.jpg):</label><br>
    <input type="text" name="image_url"><br><br>

    <label>Category:</label><br>
    <input type="text" name="category"><br><br>

    <label>Stock:</label><br>
    <input type="number" name="stock" value="0"><br><br>

    <button type="submit">Save Product</button>
</form>

<p><a href="admin_products.php">Back to Products</a></p>

<?php
require_once './includes/footer.php';
?>
