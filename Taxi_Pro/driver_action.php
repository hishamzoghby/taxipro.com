<?php
include 'db.php'; // Database connection

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'approve') {
        $status = 'approved';
    } elseif ($action === 'reject') {
        $status = 'rejected';
    } else {
        die("Invalid action.");
    }

    // Update driver status
    $query = "UPDATE drivers SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('si', $status, $id);

    if ($stmt->execute()) {
        header('Location: admin_dashboard.php?message=Driver status updated successfully');
        exit;
    } else {
        die("Error updating driver status: " . $conn->error);
    }
} else {
    die("Invalid request.");
}
