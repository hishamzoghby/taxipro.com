<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $vehicle_number = mysqli_real_escape_string($conn, $_POST['vehicle_number']);
    $license_number = mysqli_real_escape_string($conn, $_POST['license_number']);

    // Begin transaction
    $conn->begin_transaction();

    try {
        // Insert into the `users` table
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'driver')");
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        $stmt->execute();

        // Get the newly inserted user_id
        $user_id = $conn->insert_id;

        // Insert into the `drivers` table
        $stmt = $conn->prepare("INSERT INTO drivers (user_id, vehicle_number, license_number) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $vehicle_number, $license_number);
        $stmt->execute();

        // Commit transaction
        $conn->commit();
        header('Location: driver_thankyou.php');
        exit;
    } catch (mysqli_sql_exception $exception) {
        $conn->rollback(); // Rollback transaction if any error occurs
        echo "Error: " . $exception->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Signup</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom right, #ffcc00, #333);
            color: white;
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        .card {
            margin: 0 auto;
            max-width: 500px;
            padding: 20px;
            background: #fff;
            color: #333;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-custom {
            background-color: #ffcc00;
            border: none;
            color: #333;
        }
        .btn-custom:hover {
            background-color: #e6b800;
        }
        .form-group label {
            color: #333;
        }
        .form-control {
            margin-bottom: 10px;
        }
        h2 {
            color: #ffcc00;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Driver Signup</h2>
    <form action="driver_signup.php" method="post">
        <div class="form-group">
            <label for="username">Full Name</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="vehicle_number">Vehicle Number</label>
            <input type="text" name="vehicle_number" id="vehicle_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="license_number">License Number</label>
            <input type="text" name="license_number" id="license_number" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-custom btn-block">Sign Up</button>
    </form>
</div>

</body>
</html>
