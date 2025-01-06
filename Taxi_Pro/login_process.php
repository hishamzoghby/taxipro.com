<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $selected_role = $_POST['role'] ?? null; // Optional, if dropdown is present.

    // Fetch user by email
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['email'] = $user['email'];

            // Role validation (if selector exists)
            if ($selected_role && $selected_role !== $user['role']) {
                $error = "Role does not match.";
            } else {
                // Redirect based on role
                if ($user['role'] === 'admin') {
                    header('Location: admin_dashboard.php');
                } elseif ($user['role'] === 'driver') {
                    if ($user['status'] === 'approved') {
                        header('Location: driver_dashboard.php');
                    } else {
                        header('Location: driver_pending.php');
                    }
                } elseif ($user['role'] === 'passenger') {
                    header('Location: home.php');
                }
                exit;
            }
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "User not found.";
    }
}
?>
