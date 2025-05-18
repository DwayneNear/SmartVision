<?php
// Create a new MySQLi connection to the database with server "localhost", username "root", no password, and database "contact_db"
$conn = new mysqli("localhost", "root", "", "contact_db");

// Check if the connection is successful, if not, display an error message and terminate
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve the form data submitted via POST request
$id = $_POST["id"];
$fullName = $_POST["fullName"];
$age = $_POST["age"];
$birthDate = $_POST["birthDate"];
$courseYear = $_POST["courseYear"];
$email = $_POST["email"];
$address = $_POST["address"];
$lookingFor = $_POST["lookingFor"];
$message = $_POST["message"];

// Check if the provided ID already exists in the 'contacts' table
$check = $conn->query("SELECT id FROM contacts WHERE id='$id'");

// If the ID exists, update the existing record with the new data
if ($check->num_rows > 0) {
    $sql = "UPDATE contacts SET full_name='$fullName', age='$age', birth_date='$birthDate', course_year='$courseYear', email='$email', address='$address', looking_for='$lookingFor', message='$message' WHERE id='$id'";
} else {
    // If the ID doesn't exist, insert a new record into the 'contacts' table
    $sql = "INSERT INTO contacts (id, full_name, age, birth_date, course_year, email, address, looking_for, message) 
            VALUES ('$id', '$fullName', '$age', '$birthDate', '$courseYear', '$email', '$address', '$lookingFor', '$message')";
}

// Execute the query to either update or insert the record
$conn->query($sql);

// Close the MySQLi connection to free up resources
$conn->close();

// Redirect the user to 'index.php' after the operation
header("Location: index.php");
?>
