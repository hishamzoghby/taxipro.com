<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pickup_location = mysqli_real_escape_string($conn, $_POST['pickup_location']);
    $destination = mysqli_real_escape_string($conn, $_POST['destination']);
    $vehicle_type = mysqli_real_escape_string($conn, $_POST['vehicle_type']);
    $user_id = $_SESSION['user_id'];

    try {
        $stmt = $conn->prepare("INSERT INTO bookings (user_id, pickup_location, destination, vehicle_type, status) VALUES (?, ?, ?, ?, 'pending')");
        $stmt->bind_param("isss", $user_id, $pickup_location, $destination, $vehicle_type);
        $stmt->execute();
        $stmt->close();
        header('Location: booking_success.php');
        exit;
    } catch (mysqli_sql_exception $exception) {
        echo "Error: " . $exception->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Ride - Taxi Service</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #ffcc00, #333);
            color: white;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            color: #333;
        }
        h2 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px;
            background-color: #ffcc00;
            border: none;
            border-radius: 5px;
            color: #333;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #e6b800;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Book a Ride</h2>
        <form action="booking.php" method="POST">
            <label for="pickup_location">Pickup Location</label>
            <input type="text" id="pickup_location" name="pickup_location" placeholder="Enter pickup location" required>

            <label for="destination">Destination</label>
            <input type="text" id="destination" name="destination" placeholder="Enter destination" required>

            <label for="vehicle_type">Vehicle Type</label>
            <select id="vehicle_type" name="vehicle_type" required>
                <option value="sedan">Sedan</option>
                <option value="suv">SUV</option>
                <option value="minivan">Minivan</option>
            </select>

            <button type="submit">Submit Booking</button>
        </form>
    </div>
</body>
</html>
