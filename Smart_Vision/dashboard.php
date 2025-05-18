<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login_dashboard.php");
    exit;
}

include('db3.php'); // Use db3.php for the correct PDO connection

// Fetch all buyers from the database
$stmt = $conn->prepare("SELECT * FROM buyers");
$stmt->execute();
$buyers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle Delete Request
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $conn->prepare("DELETE FROM buyers WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    header('Location: dashboard.php'); // Redirect back to the dashboard after deleting
    exit;
}

// Handle Edit Request
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $amount = $_POST['amount'];

    // Update the buyer's information in the database
    $stmt = $conn->prepare("UPDATE buyers SET email = :email, amount = :amount WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':amount', $amount);
    $stmt->execute();

    header('Location: dashboard.php'); // Redirect to the dashboard after editing
    exit;
}

$totalEarnings = 0;
foreach ($buyers as $buyer) {
    $totalEarnings += $buyer['amount'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Vision Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f7fc;
            padding: 2rem;
            margin: 0;
        }
        .dashboard {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #333;
            font-weight: 600;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
        }
        th, td {
            padding: 0.8rem;
            text-align: left;
            border: 1px solid #ddd;
            font-size: 16px;
        }
        th {
            background-color: #007bff;
            color: white;
            font-weight: 600;
        }
        td {
            background-color: #f9f9f9;
        }
        .footer {
            text-align: center;
            margin-top: 1rem;
            color: #555;
        }
        .stats {
            font-weight: 600;
            color: #333;
            margin-bottom: 1rem;
        }
        .actions {
            display: flex;
            justify-content: space-between;
        }
        .btn {
            padding: 0.5rem 1rem;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-right: 5px;
        }
        .btn-edit {
            background-color: #28a745;
            color: white;
        }
        .btn-edit:hover {
            background-color: #218838;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        .edit-form {
            margin-top: 1rem;
            background: #f9f9f9;
            padding: 1rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <div class="dashboard">
        <h2>Smart Vision Buyer Records</h2>
        <p class="stats">Total Earnings: ₱<?= number_format($totalEarnings, 2) ?></p>
        <p class="stats">Total Buyers: <?= count($buyers) ?></p>
        <table>
            <thead>
                <tr>
                    <th>Gmail</th>
                    <th>Amount</th>
                    <th>Date & Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($buyers as $entry): ?>
                    <tr>
                        <td><?= htmlspecialchars($entry['email']) ?></td>
                        <td>₱<?= number_format($entry['amount'], 2) ?></td>
                        <td><?= $entry['datetime'] ?></td>
                        <td class="actions">
                            <a href="dashboard.php?edit=<?= $entry['id'] ?>" class="btn btn-edit">Edit</a>
                            <a href="dashboard.php?delete=<?= $entry['id'] ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (isset($_GET['edit'])): ?>
            <?php
                $editId = $_GET['edit'];
                $stmt = $conn->prepare("SELECT * FROM buyers WHERE id = :id");
                $stmt->bindParam(':id', $editId);
                $stmt->execute();
                $editBuyer = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="edit-form">
                <h3>Edit Buyer Record</h3>
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $editBuyer['id'] ?>">
                    <label>Email:</label>
                    <input type="email" name="email" value="<?= $editBuyer['email'] ?>" required>
                    <label>Amount:</label>
                    <input type="number" name="amount" value="<?= $editBuyer['amount'] ?>" required>
                    <button type="submit" name="edit" class="btn btn-edit">Save Changes</button>
                </form>
            </div>
        <?php endif; ?>

        <div class="footer">
            <p>Powered by Smart Vision</p>
        </div>
    </div>

</body>
</html>
