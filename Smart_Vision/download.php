<?php
include('db2.php'); // Updated to use db2.php

// Disable error reporting for production (optional)
error_reporting(0); 
ini_set('display_errors', 0); 

// Check if the token is passed via the URL
if (isset($_GET['token']) && !empty($_GET['token'])) {
    $token = $_GET['token'];

    try {
        // Prepare and execute the query to find the buyer with the given token
        $stmt = $conn->prepare("SELECT * FROM buyers WHERE token = :token");
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $buyer = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($buyer) {
            // Increment the number of clicks
            $newClicks = $buyer['clicks'] + 1;
            $updateStmt = $conn->prepare("UPDATE buyers SET clicks = :clicks WHERE token = :token");
            $updateStmt->bindParam(':clicks', $newClicks);
            $updateStmt->bindParam(':token', $token);
            $updateStmt->execute();

            // Provide the download
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="smart_vision.zip"');
            readfile('smart_vision.zip');
            exit;
        } else {
            // Invalid or expired token
            echo displayMessage('Invalid or expired token. Please contact support.', 'error');
        }
    } catch (Exception $e) {
        // Database error
        echo displayMessage('An error occurred while processing your request. Please try again later.', 'error');
    }
} else {
    // No token provided
    echo displayMessage('No token provided. Please check your purchase link.', 'error');
}

// Function to display styled messages
function displayMessage($message, $type) {
    $color = $type == 'error' ? '#e74c3c' : '#2ecc71';
    return "<div style='background-color: $color; color: white; padding: 15px; border-radius: 5px; text-align: center; margin: 30px auto; max-width: 600px;'>
                <strong>$message</strong>
            </div>";
}
?>
