<?php
// Create a new MySQLi connection to the database with server "localhost", username "root", no password, and database "contact_db"
$conn = new mysqli("localhost", "root", "", "contact_db");

// Retrieve the 'id' value from the URL query string (e.g., ?id=1)
$id = $_GET["id"];

// Execute the SQL query to delete the record from the 'contacts' table where the 'id' matches the one retrieved from the URL
$conn->query("DELETE FROM contacts WHERE id=$id");

// Close the database connection to free up resources
$conn->close();

// Redirect the user to 'index.php' after the delete operation
header("Location: index.php");
?>
