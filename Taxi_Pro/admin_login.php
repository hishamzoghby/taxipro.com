<?php
session_start();
include 'db.php'; // Ensure the database connection file is included

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check admin credentials
    $query = "SELECT * FROM admins WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        // Check password (plain text for simplicity)
        if ($password === $admin['password']) {
            $_SESSION['admin'] = $admin['email']; // Store admin in session
            header('Location: admin_dashboard.php'); // Redirect to dashboard
            exit;
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Admin not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Taxi Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom right, #333, #ffcc00);
            color: #fff;
            text-align: center;
            padding: 10%;
        }
        .login-container {
            background: #fff;
            color: #333;
            padding: 20px;
            border-radius: 8px;
            display: inline-block;
        }
        input[type="email"], input[type="password"] {
            display: block;
            margin: 10px auto;
            padding: 8px;
            width: 80%;
            border-radius: 4px;
        }
        button {
            padding: 10px 20px;
            background: #ffcc00;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form action="admin_login.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)) { echo "<p style='color: red;'>$error</p>"; } ?>
    </div>
</body>
</html>
