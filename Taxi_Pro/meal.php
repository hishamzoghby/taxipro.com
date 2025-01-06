<?php
// Start session and include database connection
session_start();
include 'db.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is logged in and is a 'passenger'
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'passenger') {
    header('Location: login.php');
    exit;
}

// Handle Meal Order submission
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['meal_id']) && is_numeric($_POST['meal_id'])) {
        $meal_id = intval($_POST['meal_id']);
        
        $stmt = $conn->prepare("INSERT INTO meal_orders (user_id, meal_id, status) VALUES (?, ?, 'Pending')");
        $stmt->bind_param("ii", $_SESSION['user_id'], $meal_id);

        if ($stmt->execute()) {
            $success_message = "Meal order successfully placed!";
        } else {
            $error_message = "An error occurred while placing the order.";
        }
    } else {
        $error_message = "Invalid meal selection.";
    }
}

// Fetch available meals from database
try {
    $query = "SELECT * FROM meals";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        throw new Exception(mysqli_error($conn));
    }

    $meals = mysqli_fetch_all($result, MYSQLI_ASSOC);
} catch (Exception $e) {
    $error_message = "Database issue: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meals - Taxi Service</title>
    <!-- Load Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* General styles for better presentation */
        body {
            background: linear-gradient(to bottom right, #f8f9fa, #495057);
            font-family: Arial, sans-serif;
            color: #333;
        }

        /* Container centered */
        .container {
            margin-top: 4%;
            max-width: 1200px;
        }

        /* Meal Card */
        .meal-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border: none;
            border-radius: 8px;
            transition: transform 0.2s ease;
        }

        .meal-card:hover {
            transform: scale(1.05);
        }

        .meal-image {
            height: 200px;
            width: 100%;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            object-fit: cover;
        }

        /* Alert box */
        .alert {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4 text-dark">Choose Your Meal</h1>

        <!-- Success/Error Messages -->
        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success_message); ?></div>
        <?php endif; ?>

        <!-- Meals List -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if (isset($meals) && count($meals) > 0): ?>
                <?php foreach ($meals as $meal): ?>
                    <div class="col">
                        <div class="card meal-card">
                            <img src="<?= htmlspecialchars($meal['image_url']); ?>" class="meal-image" alt="<?= htmlspecialchars($meal['name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($meal['name']); ?></h5>
                                <p class="card-text"><?= htmlspecialchars($meal['description']); ?></p>
                                <p class="text-muted">Price: $<?= number_format($meal['price'], 2); ?></p>
                                <form action="meal.php" method="POST">
                                    <input type="hidden" name="meal_id" value="<?= $meal['id']; ?>">
                                    <button type="submit" class="btn btn-warning btn-block">Order Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-warning text-center">No meals available at the moment. Please try again later.</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Load necessary JS libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
