<?php
include('db2.php'); // Updated to use db2.php

$showThankYou = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['purchase'])) {
    $email = $_POST['email'];
    $token = bin2hex(random_bytes(16));
    $amount = 2800; // Updated to 2800 pesos

    // Insert buyer's data into the database
    $stmt = $conn->prepare("INSERT INTO buyers (email, amount, token) VALUES (:email, :amount, :token)");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':amount', $amount);
    $stmt->bindParam(':token', $token);
    $stmt->execute();

    // Set flag to show thank you message
    $showThankYou = true;

    // Set redirect header after a short delay (3 seconds)
    header("refresh:3;url=download.php?token=$token");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Smart Vision</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            max-width: 500px;
            width: 100%;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h2 {
            color: #333;
            font-weight: 600;
        }
        form {
            display: flex;
            flex-direction: column;
            margin-top: 2rem;
        }
        input, button {
            padding: 0.8rem;
            margin: 0.6rem 0;
            border-radius: 6px;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        input {
            outline: none;
            color: #555;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            font-weight: 600;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        button:active {
            background-color: #003f80;
        }
        .footer {
            text-align: center;
            margin-top: 1rem;
            color: #555;
        }
        .thank-you {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 1rem;
            margin-top: 1rem;
            border-radius: 5px;
            font-weight: 500;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Buy Smart Vision - ₱2800</h2>

        <?php if ($showThankYou): ?>
            <div class="thank-you">
                ✅ Thank you for purchasing! Redirecting to download...
            </div>
        <?php else: ?>
            <form method="POST">
                <input type="email" name="email" placeholder="Enter your Gmail" required>
                <button type="submit" name="purchase">Purchase & Download</button>
            </form>
            <div class="footer">
                <p>Secure payment via PayPal</p>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>
