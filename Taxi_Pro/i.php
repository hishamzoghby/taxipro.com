<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Service - Welcome</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to bottom right, #ffcc00, #333);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: white;
            text-align: center;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }
        .btn-container {
            display: flex;
            gap: 20px;
        }
        .btn {
            padding: 15px 30px;
            font-size: 1.2rem;
            background-color: #ffcc00;
            border: none;
            border-radius: 5px;
            color: #333;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #e6b800;
        }
    </style>
</head>
<body>
    <h1>Welcome to Taxi Service</h1>
    <p>Are you a passenger, driver, or admin?</p>
    <div class="btn-container">
        <a href="login.php" class="btn">Passenger Login</a>
        <a href="driver_login.php" class="btn">Driver Login</a>
        <a href="admin_login.php" class="btn">Admin Login</a> <!-- Admin login button added -->
    </div>
</body>
</html>
