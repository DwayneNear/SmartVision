<?php
$conn = new mysqli("localhost", "root", "", "contact_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM contacts");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us with Video Background</title>
    <style>
        /* Video background */
        #bgVideo {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100vw;
            min-height: 100vh;
            object-fit: cover;
            z-index: -1;
            opacity: 0.7;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            background-color: rgba(235, 105, 105, 0.69);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 1;
        }

        .back-btn {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        h2 {
            color: #2c3e50;
            text-align: center;
            border-bottom: 2px solid rgb(34, 253, 1);
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        form {
            display: grid;
            gap: 15px;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #bdc3c7;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: rgb(213, 16, 16);
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
        }

        input[type="submit"]:hover {
            background-color: rgb(180, 0, 0);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #bdc3c7;
            padding: 10px;
            text-align: left;
        }

        .edit-btn, .delete-btn {
            padding: 5px 10px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
        }

        .edit-btn {
            background-color: rgb(0, 255, 94);
            color: white;
        }

        .edit-btn:hover {
            background-color: rgb(0, 200, 74);
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>

    <!-- 🔴 Video background -->
    <video autoplay muted loop id="bgVideo">
        <source src="video1.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
    </video>

    <div class="container">

        <!-- 🔙 Back Button -->
        <a href="http://localhost/Smart_Vision/near.php#home" class="back-btn">← Back to Home</a>

        <h2>Get In Touch With Us</h2>
        <form id="contactForm" method="POST" action="save_contact.php">
            <input type="number" name="id" id="id" placeholder="ID (Enter Manually)" required>
            <input type="text" name="fullName" id="fullName" placeholder="Full Name" required>
            <input type="number" name="age" id="age" placeholder="Age" required>
            <input type="date" name="birthDate" id="birthDate" required>
            <input type="text" name="courseYear" id="courseYear" placeholder="Course/Year" required>
            <input type="email" name="email" id="email" placeholder="Email Address" required>
            <input type="text" name="address" id="address" placeholder="Home Address" required>
            <input type="text" name="lookingFor" id="lookingFor" placeholder="I'm Looking for" required>
            <textarea name="message" id="message" rows="5" placeholder="Your Message" required></textarea>
            <input type="submit" value="Send Message">
        </form>

        <h2>Submitted Messages</h2>
        <table id="dataTable">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Age</th>
                <th>Birth Date</th>
                <th>Course/Year</th>
                <th>Email</th>
                <th>Address</th>
                <th>Looking For</th>
                <th>Message</th>
                <th>Operations</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['full_name'] ?></td>
                    <td><?= $row['age'] ?></td>
                    <td><?= $row['birth_date'] ?></td>
                    <td><?= $row['course_year'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['looking_for'] ?></td>
                    <td><?= $row['message'] ?></td>
                    <td>
                        <button class="edit-btn" onclick="editRow(<?= $row['id'] ?>, '<?= $row['full_name'] ?>', <?= $row['age'] ?>, '<?= $row['birth_date'] ?>', '<?= $row['course_year'] ?>', '<?= $row['email'] ?>', '<?= $row['address'] ?>', '<?= $row['looking_for'] ?>', '<?= $row['message'] ?>')">Edit</button>
                        <button class="delete-btn" onclick="deleteRow(<?= $row['id'] ?>)">Delete</button>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <script>
        function editRow(id, fullName, age, birthDate, courseYear, email, address, lookingFor, message) {
            document.getElementById("id").value = id;
            document.getElementById("fullName").value = fullName;
            document.getElementById("age").value = age;
            document.getElementById("birthDate").value = birthDate;
            document.getElementById("courseYear").value = courseYear;
            document.getElementById("email").value = email;
            document.getElementById("address").value = address;
            document.getElementById("lookingFor").value = lookingFor;
            document.getElementById("message").value = message;
        }

        function deleteRow(id) {
            if (confirm("Are you sure you want to delete this record?")) {
                window.location.href = "delete_contact.php?id=" + id;
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
