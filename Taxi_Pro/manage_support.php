<?php
session_start();
include 'db.php';

// Ensure the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

// Fetch all support requests
$result = $conn->query("SELECT * FROM support ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Support</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Manage Support Requests</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Message</th>
            <th>Response</th>
            <th>Action</th>
        </tr>
        <?php while ($ticket = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($ticket['id']); ?></td>
                <td><?= htmlspecialchars($ticket['user_id']); ?></td>
                <td><?= htmlspecialchars($ticket['message']); ?></td>
                <td><?= htmlspecialchars($ticket['response']); ?></td>
                <td>
                    <a href="respond_support.php?ticket_id=<?= $ticket['id']; ?>">Respond</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
