<?php
session_start();

// Remove all session variables
session_unset();

// Destroy the session
session_destroy();

$title = "Logout";
require_once './includes/header.php';
?>

<h2>You have been logged out.</h2>
<p><a href="index.php">Return to homepage</a></p>

<?php
require_once './includes/footer.php';
?>
