<?php
$host = 'localhost';
$user = 'root';        // default XAMPP username
$pass = '';            // default XAMPP password is empty
$dbname = 'online_store_db';

// Create connection
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
