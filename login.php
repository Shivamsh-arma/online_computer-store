<?php
$title = "Login";
require_once './includes/header.php';
?>

<h2>Login</h2>

<form action="login_action.php" method="post">
    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <label>Password:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Login</button>
</form>

<?php
require_once './includes/footer.php';
?>
