<?php
$title = "Edit Product";
require_once './includes/header.php';
require_once './db/conn.php';

// Only admin allowed
if (!isset($_SESSION['userid']) || $_SESSION['is_admin'] != 1) {
    echo "<h2>Access denied.</h2>";
    require_once './includes/footer.php';
    exit;
}

// Get product id from URL
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Get product from DB
$sql = "SELECT * FROM products WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "<h2>Product not found.</h2>";
    require_once './includes/footer.php';
    exit;
}
?>

<h2>Edit Product</h2>

<form action="admin_product_edit_action.php" method="post">
    <!-- Hidden field to send id -->
    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

    <label>Name:</label><br>
    <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br><br>

    <label>Description:</label><br>
    <textarea name="description" rows="4" cols="40"><?php echo htmlspecialchars($product['description']); ?></textarea><br><br>

    <label>Price:</label><br>
    <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required><br><br>

    <label>Image URL:</label><br>
    <input type="text" name="image_url" value="<?php echo htmlspecialchars($product['image_url']); ?>"><br><br>

    <label>Category:</label><br>
    <input type="text" name="category" value="<?php echo htmlspecialchars($product['category']); ?>"><br><br>

    <label>Stock:</label><br>
    <input type="number" name="stock" value="<?php echo $product['stock']; ?>"><br><br>

    <button type="submit">Update Product</button>
</form>

<p><a href="admin_products.php">Back to Products</a></p>

<?php
require_once './includes/footer.php';
?>
