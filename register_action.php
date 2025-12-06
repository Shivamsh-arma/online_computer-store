<?php
require_once './db/conn.php';

// Get form data and sanitize
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Hash password (as shown in slides)
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert into database
$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashedPassword')";

if (mysqli_query($conn, $sql)) {
    echo "Registration successful! <br>";
    echo "<a href='login.php'>Click here to login</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
