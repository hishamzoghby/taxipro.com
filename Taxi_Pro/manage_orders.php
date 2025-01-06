<?php
session_start();
include 'db.php';

// Ensure the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Fetch all orders
$result = $conn->query("SELECT * FROM orders ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Manage Orders</h1>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Pickup</th>
            <th>Destination</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($order = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($order['id']); ?></td>
                <td><?= htmlspecialchars($order['user_id']); ?></td>
                <td><?= htmlspecialchars($order['pickup_location']); ?></td>
                <td><?= htmlspecialchars($order['destination']); ?></td>
                <td><?= htmlspecialchars($order['status']); ?></td>
                <td>
                    <a href="update_order.php?order_id=<?= $order['id']; ?>&action=complete">Complete</a> | 
                    <a href="update_order.php?order_id=<?= $order['id']; ?>&action=cancel">Cancel</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
