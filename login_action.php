<?php
require_once './db/conn.php';
session_start();

// Get and sanitize input
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = $_POST['password'];

// Look for user by email
$sql = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);

    // Check hashed password
    if (password_verify($password, $user['password'])) {
        
        // Set session variables
        $_SESSION['userid'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['is_admin'] = $user['is_admin'];

        echo "Login successful!<br>";
        echo "<a href='index.php'>Go to homepage</a>";

    } else {
        echo "Incorrect password.";
    }

} else {
    echo "No user found with that email.";
}
?>
