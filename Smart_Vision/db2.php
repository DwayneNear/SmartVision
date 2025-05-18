<?php
$host = 'localhost';
$dbname = 'smart_vision'; // Ensure this is the correct database name
$username = 'root'; // Default XAMPP username
$password = ''; // Default XAMPP password (empty)

try {
    // Create a new PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Catch any connection errors
    echo "Connection failed: " . $e->getMessage();
    die(); // Stop the script if the connection fails
}
?>
