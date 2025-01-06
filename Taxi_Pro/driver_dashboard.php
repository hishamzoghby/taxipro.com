<?php
session_start();
include 'db.php';

// Ensure driver is logged in
if (!isset($_SESSION['driver_id'])) {
    header("Location: driver_login.php");
    exit;
}

// Fetch driver username
$driver_username = isset($_SESSION['driver_username']) ? $_SESSION['driver_username'] : "Driver";

// Fetch available bookings
$query = "SELECT * FROM bookings WHERE driver_id IS NULL";
$available_result = $conn->query($query);
if (!$available_result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #ffcc00, #333);
            color: white;
        }
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            color: #333;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        h2 {
            color: #ffcc00;
            text-align: center;
            margin-bottom: 20px;
        }
        .booking {
            padding: 15px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            transition: background-color 0.3s ease;
        }
        .booking:hover {
            background-color: #f1f1f1;
        }
        .booking h3 {
            margin: 0 0 10px 0;
            color: #333;
        }
        p {
            font-size: 1.1rem;
        }
        button {
            padding: 12px 25px;
            background-color: #ffcc00;
            color: #333;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #e6b800;
        }
        .no-booking {
            text-align: center;
            font-size: 1.2rem;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ffcc00;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #e6b800;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?= htmlspecialchars($driver_username); ?></h1>

        <h2>Available Bookings</h2>

        <?php if ($available_result->num_rows > 0): ?>
            <?php while ($row = $available_result->fetch_assoc()): ?>
                <div class="booking">
                    <h3>Booking ID: <?= htmlspecialchars($row['id']); ?></h3>
                    <p><strong>Pickup:</strong> <?= htmlspecialchars($row['pickup_location']); ?></p>
                    <p><strong>Destination:</strong> <?= htmlspecialchars($row['destination']); ?></p>
                    <form action="accept_booking.php" method="POST">
                        <input type="hidden" name="booking_id" value="<?= htmlspecialchars($row['id']); ?>">
                        <button type="submit">Accept Booking</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="no-booking">No bookings available at the moment.</p>
        <?php endif; ?>

    </div>
    <a href="index.php">Go Back to Home</a>
   
</body>
</html>
