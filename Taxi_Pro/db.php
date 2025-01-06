<?php
$host = 'localhost'; // Change to your host
$dbUsername = 'root'; // Your database username
$dbPassword = '';     // Your database password
$dbName = 'taxi_s_new';

// Create database connection
try {
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    if ($conn->connect_error) {
        throw new Exception('Database Connection Failed: ' . $conn->connect_error);
    }
    $conn->set_charset('utf8');
} catch (Exception $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
