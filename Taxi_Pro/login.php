<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Taxi Service</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: linear-gradient(to bottom right, #ffcc00, #333);
            color: #333;
            font-family: Arial, sans-serif;
        }
        .login-container {
            max-width: 400px;
            margin: 5% auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
            text-align: center;
        }
        button {
            background-color: #ffcc00;
            border: none;
            color: #333;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3>Login to Taxi Service</h3>
        <form action="login_process.php" method="POST">
            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            
            <br>
            <button type="submit">Login</button>
        </form>
        <br>
        <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
</body>
</html>
