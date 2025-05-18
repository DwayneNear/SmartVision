<?php
include('db3.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO admin_users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    header("Location: login_dashboard.php?registered=1");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Admin</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f4f7fc;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
            text-align: center;
        }
        h2 {
            margin-bottom: 1.5rem;
            color: #333;
        }
        input {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            font-size: 1rem;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 0.5rem;
        }
        button:hover {
            background: #0056b3;
        }
        .secondary-btn {
            background: #6c757d;
        }
        .secondary-btn:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Register Admin</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <button type="submit">Sign Up</button>
        </form>
        <form action="login_dashboard.php">
            <button type="submit" class="secondary-btn">Go to Login</button>
        </form>
    </div>
</body>
</html>
