<?php
$title = "Register";
require_once './includes/header.php';
?>

<h2>Create an Account</h2>

<form action="register_action.php" method="post">
    <label>Name:</label>
    <input type="text" name="name" required><br><br>

    <label>Email:</label>
    <input type="email" name="email" required><br><br>

    <label>Password:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>
</form>

<?php
require_once './includes/footer.php';
?>
