<?php
// Connect to the MySQL database
$conn = mysqli_connect("localhost", "root", "", "examp");

// Check for connection errors
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
