<?php
session_start();
if (!isset($_SESSION['driver_id'])) {
    header('Location: driver_login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Pending - Taxi Service</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .pending-container {
            text-align: center;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .pending-container h1 {
            color: #ffcc00;
        }
        .pending-container p {
            color: #333;
        }
        .btn-contact {
            background-color: #ffcc00;
            color: #333;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        .btn-contact:hover {
            background-color: #e6b800;
        }
    </style>
</head>
<body>
    <div class="pending-container">
        <h1>Account Pending Approval</h1>
        <p>Your account is currently under review. Please wait until the administrator approves your account.</p>
        <p>If you have questions, contact us using the button below.</p>
        <a href="contact_support.php" class="btn btn-contact">Contact Support</a>
    </div>
</body>
</html>
