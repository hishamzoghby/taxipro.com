<?php
session_start();
include 'db.php';

// Ensure the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Check if a driver ID is passed
if (isset($_GET['driver_id']) && isset($_GET['action'])) {
    $driver_id = intval($_GET['driver_id']);
    $action = $_GET['action']; // 'approve' or 'reject'

    if ($action === 'approve') {
        $status = 'approved';
    } elseif ($action === 'reject') {
        $status = 'rejected';
    } else {
        die("Invalid action.");
    }

    // Update driver status
    $stmt = $conn->prepare("UPDATE drivers SET status = ? WHERE id = ?");
    $stmt->bind_param('si', $status, $driver_id);

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?message=Driver $status successfully.");
    } else {
        die("Database error: " . $stmt->error);
    }
} else {
    die("Invalid request.");
}
?>
