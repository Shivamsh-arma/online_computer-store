<?php
$title = "Products";
require_once './includes/header.php';
require_once './db/conn.php';

// Get all products from database
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);
?>

<h2>All Products</h2>

<div style="display:flex; flex-wrap:wrap; gap:20px;">
<?php
while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div style="border:1px solid #ccc; padding:10px; width:250px;">
        <img src="<?php echo $row['image_url']; ?>" width="230" height="150" alt="Product image"><br><br>
        <strong><?php echo $row['name']; ?></strong><br>
        $<?php echo $row['price']; ?><br><br>
        <a href="product.php?id=<?php echo $row['id']; ?>">View Details</a>
    </div>
    <?php
}
?>
</div>

<?php
require_once './includes/footer.php';
?>
