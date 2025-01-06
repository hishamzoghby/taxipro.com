<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Taxi Service</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: linear-gradient(to bottom right, #ffcc00, #333);
            font-family: Arial, sans-serif;
        }
        .signup-container {
            max-width: 400px;
            margin: 5% auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
            color: #333;
        }
        .btn-signup {
            background-color: #ffcc00;
            border: none;
            color: #333;
            font-weight: bold;
        }
        .btn-signup:hover {
            background-color: #e6b800;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h3 class="text-center">Sign Up - Taxi Service</h3>
        <form action="signup_process.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-signup btn-block">Sign Up</button>
        </form>
    </div>
</body>
</html>
