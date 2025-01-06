<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $license_number = mysqli_real_escape_string($conn, $_POST['license_number']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to fetch the driver and user details
    $query = "
        SELECT d.*, u.password 
        FROM drivers d 
        JOIN users u ON d.user_id = u.id 
        WHERE d.license_number = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $license_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $driver = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $driver['password'])) {
            // Start session and set session variables
            session_start();
            $_SESSION['driver_id'] = $driver['id'];
            $_SESSION['user_id'] = $driver['user_id'];
            $_SESSION['license_number'] = $driver['license_number'];

            // Redirect to driver dashboard
            header('Location: driver_dashboard.php');
            exit;
        } else {
            echo "Incorrect password. Please try again.";
        }
    } else {
        echo "Driver not found with this license number.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Login - Taxi Service</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to bottom right, #ffcc00, #333);
            font-family: Arial, sans-serif;
        }
        .login-container {
            width: 400px;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #ffcc00;
            border: none;
            border-radius: 5px;
            color: #333;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #e6b800;
        }
        .error {
            color: red;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        .text-center {
            text-align: center;
            margin-top: 15px;
        }
        a {
            color: #ffcc00;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Driver Login</h2>
        <!-- Error message (optional, generated dynamically) -->
        <?php if (isset($error)) { ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php } ?>
        <!-- Login Form -->
        <form action="driver_login.php" method="POST">
            <div class="form-group">
                <label for="license_number">License Number</label>
                <input type="text" id="license_number" name="license_number" placeholder="Enter your license number" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit">Login</button>
        </form>
        <div class="text-center">
            <p>Don't have an account? <a href="driver_signup.php">Sign up here</a></p>
        </div>
    </div>
</body>
</html>

