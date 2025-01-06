<?php
include 'db.php'; 


$query = "SELECT * FROM drivers WHERE status = 'pending'";
$result = $conn->query($query);

if (!$result) {
    die("Error fetching drivers: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to bottom right, #ffcc00, #333);
            font-family: Arial, sans-serif;
            color: white;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            color: #333;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #ffcc00;
            text-align: center;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #ffcc00;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 0.9rem;
            text-decoration: none;
        }
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-success:hover {
            background-color: #218838;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #ffcc00;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #e6b800;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pending Driver Applications</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>License Number</th>
                    <th>Vehicle Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($driver = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= htmlspecialchars($driver['id']) ?></td>
                        <td><?= htmlspecialchars($driver['license_number']) ?></td>
                        <td><?= htmlspecialchars($driver['vehicle_number']) ?></td>
                        <td>
                            <a href="driver_action.php?id=<?= $driver['id'] ?>&action=approve" class="btn btn-success">Approve</a>
                            <a href="driver_action.php?id=<?= $driver['id'] ?>&action=reject" class="btn btn-danger">Reject</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <a href="index.html">Go Back to Home</a>
</body>
</html>
