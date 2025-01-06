<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meals - Taxi Service</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom right, #ffcc00, #333);
            color: #333;
        }
        .container {
            margin-top: 30px;
            max-width: 1200px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .meal-card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s ease-in-out;
        }
        .meal-card:hover {
            transform: scale(1.1);
        }
        .meal-img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Meal Options</h1>
        <div class="row">
            <!-- Pizza -->
            <div class="col-md-4 mb-4">
                <div class="card meal-card">
                    <img src="images/pizza.jpg" class="card-img-top meal-img" alt="Pizza">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pizza</h5>
                        <p class="card-text">Hot, fresh, and delicious pizza.</p>
                        <p class="card-text font-weight-bold">Price: $10</p>
                        <button class="btn btn-warning" onclick="placeOrder('Pizza')">Order Now</button>
                    </div>
                </div>
            </div>
            <!-- Pasta -->
            <div class="col-md-4 mb-4">
                <div class="card meal-card">
                    <img src="images/pasta.jpg" class="card-img-top meal-img" alt="Pasta">
                    <div class="card-body text-center">
                        <h5 class="card-title">Pasta</h5>
                        <p class="card-text">Classic Italian pasta with delicious sauces.</p>
                        <p class="card-text font-weight-bold">Price: $12</p>
                        <button class="btn btn-warning" onclick="placeOrder('Pasta')">Order Now</button>
                    </div>
                </div>
            </div>
            <!-- Burger -->
            <div class="col-md-4 mb-4">
                <div class="card meal-card">
                    <img src="images/burger.jpg" class="card-img-top meal-img" alt="Burger">
                    <div class="card-body text-center">
                        <h5 class="card-title">Burger</h5>
                        <p class="card-text">Juicy, freshly grilled burgers to enjoy.</p>
                        <p class="card-text font-weight-bold">Price: $8</p>
                        <button class="btn btn-warning" onclick="placeOrder('Burger')">Order Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function placeOrder(meal) {
            alert('Thank you for ordering ' + meal + '! Your order has been placed successfully.');
        }
    </script>
</body>
</html>
