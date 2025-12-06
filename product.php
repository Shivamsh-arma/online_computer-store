<?php
$title = "Product Details";
require_once './includes/header.php';
require_once './db/conn.php';

// Get product ID from URL and make sure it's a number
$id = 0;
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
}

// Get product details
$sql = "SELECT * FROM products WHERE id = $id LIMIT 1";
$result = mysqli_query($conn, $sql);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "<h2>Product not found.</h2>";
    require_once './includes/footer.php';
    exit;
}

// =======================
// Ratings & Reviews Part
// =======================

// Get average rating and total number of reviews for this product
$sqlRating = "SELECT AVG(rating) AS avg_rating, COUNT(*) AS total_reviews 
              FROM reviews 
              WHERE product_id = $id";
$ratingResult = mysqli_query($conn, $sqlRating);
$ratingData = mysqli_fetch_assoc($ratingResult);

$avgRating = $ratingData && $ratingData['avg_rating'] !== null
    ? round($ratingData['avg_rating'], 1)
    : null;
$totalReviews = $ratingData ? (int)$ratingData['total_reviews'] : 0;

// Get individual reviews with user names
$sqlReviews = "SELECT r.rating, r.comment, r.created_at, u.name 
               FROM reviews r
               INNER JOIN users u ON r.user_id = u.id
               WHERE r.product_id = $id
               ORDER BY r.created_at DESC";
$reviewsResult = mysqli_query($conn, $sqlReviews);
?>

<h2><?php echo htmlspecialchars($product['name']); ?></h2>

<img src="<?php echo htmlspecialchars($product['image_url']); ?>" width="400" alt="Product image"><br><br>

<p><strong>Price:</strong> $<?php echo $product['price']; ?></p>
<p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($product['description'])); ?></p>
<p><strong>Category:</strong> <?php echo htmlspecialchars($product['category']); ?></p>
<p><strong>Stock:</strong> <?php echo $product['stock']; ?></p>

<a href="cart_add.php?id=<?php echo $product['id']; ?>">Add to Cart</a>

<hr>

<!-- ===================== -->
<!-- Average Rating Section -->
<!-- ===================== -->

<h3>Rating & Reviews</h3>

<?php if ($avgRating !== null && $totalReviews > 0): ?>
    <p>
        <strong>Average Rating:</strong>
        <?php
        // Simple star display (★ and ☆)
        $fullStars = (int) floor($avgRating);
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $fullStars) {
                echo "★";
            } else {
                echo "☆";
            }
        }
        ?>
        (<?php echo $avgRating; ?>/5 from <?php echo $totalReviews; ?> review<?php echo $totalReviews > 1 ? 's' : ''; ?>)
    </p>
<?php else: ?>
    <p><em>No reviews yet. Be the first to review this product!</em></p>
<?php endif; ?>

<!-- ===================== -->
<!-- Reviews List Section  -->
<!-- ===================== -->

<?php if ($totalReviews > 0): ?>
    <h4>Customer Reviews</h4>
    <div>
        <?php while ($review = mysqli_fetch_assoc($reviewsResult)): ?>
            <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
                <strong><?php echo htmlspecialchars($review['name']); ?></strong>
                <span style="margin-left:10px;">
                    <?php
                    // Show stars for each review
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= (int)$review['rating']) {
                            echo "★";
                        } else {
                            echo "☆";
                        }
                    }
                    ?>
                </span>
                <br>
                <small><?php echo $review['created_at']; ?></small>
                <p><?php echo nl2br(htmlspecialchars($review['comment'])); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif; ?>

<!-- ===================== -->
<!-- Add Review Form       -->
<!-- ===================== -->

<?php if (isset($_SESSION['userid'])): ?>
    <h4>Write a Review</h4>
    <form action="add_review.php" method="post">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

        <label for="rating">Rating (1–5):</label><br>
        <select name="rating" id="rating" required>
            <option value="">-- Select --</option>
            <option value="5">5 - Excellent</option>
            <option value="4">4 - Very Good</option>
            <option value="3">3 - Good</option>
            <option value="2">2 - Fair</option>
            <option value="1">1 - Poor</option>
        </select>
        <br><br>

        <label for="comment">Your Review:</label><br>
        <textarea name="comment" id="comment" rows="4" cols="50" required></textarea>
        <br><br>

        <button type="submit">Submit Review</button>
    </form>
<?php else: ?>
    <p><em>You must be logged in to write a review.</em> <a href="login.php">Login here</a></p>
<?php endif; ?>

<?php
require_once './includes/footer.php';
?>
