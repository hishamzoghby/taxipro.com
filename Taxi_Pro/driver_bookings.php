<?php
session_start();
include 'db.php';

// Ensure driver is logged in
if (!isset($_SESSION['driver_id'])) {
    header('Location: driver_login.php');
    exit;
}

$driver_id = $_SESSION['driver_id'];

// Fetch bookings not yet assigned to a driver
$query = "SELECT * FROM bookings WHERE driver_id IS NULL";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Bookings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Available Bookings</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Passenger Name</th>
                <th>Pickup Location</th>
                <th>Dropoff Location</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['passenger_name'] ?></td>
                    <td><?= $row['pickup_location'] ?></td>
                    <td><?= $row['dropoff_location'] ?></td>
                    <td>
                        <form action="accept_booking.php" method="post">
                            <input type="hidden" name="booking_id" value="<?= $row['id'] ?>">
                            <button type="submit">Accept</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
