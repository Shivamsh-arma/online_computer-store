<?php
// Start session so we can use $_SESSION on any page that includes this file
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Default title if page does not set one
if (!isset($title)) {
    $title = "Online Computer Store";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <!-- Main stylesheet -->
    <link rel="stylesheet" href="./css/style.css" />
    
    <title><?php echo $title; ?></title>
</head>
<body>
<header>
    <nav class="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.php">Online Computer Store</a>
            </div>

            <div class="nav-links">
                <!-- Links visible to everyone -->
                <a href="products.php">Products</a>
                <a href="cart.php">Cart</a>

                <?php if (isset($_SESSION['userid'])): ?>

                    <!-- Link for the logged-in user's own orders -->
                    <a href="order_history.php">My Orders</a>

                    <!-- If user is admin, show Admin link -->
                    <?php if (!empty($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                        <a href="admin_dashboard.php">Admin</a>
                    <?php endif; ?>

                    <!-- Show username + logout -->
                    <span style="margin-left:15px; margin-right:15px;">
                        Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </span>
                    <a href="logout.php">Logout</a>

                <?php else: ?>

                    <!-- If user is NOT logged in -->
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>

                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>

<main>
    <div class="container main-content">
