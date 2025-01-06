<?php
session_start();
include 'db.php';

if (!isset($_SESSION['driver_id'])) {
    header('Location: driver_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $driver_id = $_SESSION['driver_id'];
    $booking_id = intval($_POST['booking_id']);

    // Update the booking to assign it to the driver
    $query = "UPDATE bookings SET driver_id = ? WHERE id = ? AND driver_id IS NULL";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $driver_id, $booking_id);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo "Booking accepted successfully.";
        header('Location: driver_dashboard.php');
    } else {
        echo "Error: Unable to accept booking.";
    }
}
?>
