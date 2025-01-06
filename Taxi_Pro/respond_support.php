<?php
session_start();
include 'db.php';

// Ensure the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ticket_id = intval($_POST['ticket_id']);
    $response = mysqli_real_escape_string($conn, $_POST['response']);

    $stmt = $conn->prepare("UPDATE support SET response = ? WHERE id = ?");
    $stmt->bind_param('si', $response, $ticket_id);

    if ($stmt->execute()) {
        header("Location: manage_support.php?message=Response sent successfully.");
    } else {
        die("Database error: " . $stmt->error);
    }
} elseif (isset($_GET['ticket_id'])) {
    $ticket_id = intval($_GET['ticket_id']);
    $ticket = $conn->query("SELECT * FROM support WHERE id = $ticket_id")->fetch_assoc();
} else {
    die("Invalid request.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respond to Support</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Respond to Support Request</h1>
    <form action="respond_support.php" method="post">
        <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticket['id']); ?>">
        <p>User Message: <?= htmlspecialchars($ticket['message']); ?></p>
        <textarea name="response" rows="5" placeholder="Enter your response here" required></textarea>
        <button type="submit">Send Response</button>
    </form>
</body>
</html>
