<?php
$title = "Home - Online Computer Store";
require_once './includes/header.php';
require_once './db/conn.php';
?>

<!-- Hero section -->
<section class="hero">
    <div class="hero-text">
        <h1>Build Your Dream Setup</h1>
        <p>Shop gaming laptops, desktops, graphics cards, and accessories at the Online Computer Store.</p>
        <ul class="hero-list">
            <li>✅ Powerful gaming laptops</li>
            <li>✅ Reliable office desktops</li>
            <li>✅ High-performance GPUs and RAM</li>
        </ul>
        <a href="products.php" class="btn-primary">Shop All Products</a>
    </div>
    <div class="hero-image">
        <!-- Use any nice image you have in /img -->
        <img src="img/hero_laptop.jpg" alt="Gaming laptop">
    </div>
</section>

<!-- Featured products -->
<section class="home-section">
    <h2 class="section-title">Featured Products</h2>

    <?php
    // Get up to 4 products to show on the homepage
    $sql = "SELECT * FROM products LIMIT 4";
    $result = mysqli_query($conn, $sql);
    ?>

    <div class="product-grid">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="product-card">
                <img
                    src="<?php echo htmlspecialchars($row['image_url']); ?>"
                    alt="Product image"
                    class="product-image"
                >
                <h3 class="product-name"><?php echo htmlspecialchars($row['name']); ?></h3>
                <p class="product-price">$<?php echo number_format($row['price'], 2); ?></p>
                <a href="product.php?id=<?php echo $row['id']; ?>" class="btn-link">View Details</a>
            </div>
        <?php } ?>
    </div>
</section>

<?php
require_once './includes/footer.php';
?>
