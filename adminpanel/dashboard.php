<?php

// Include the database connection file
include('connection.php');
include('adminpan.php');

// Retrieve data for the dashboard metrics
$sqlOrders = "SELECT COUNT(*) AS totalOrders FROM orders";
$resultOrders = $conn->query($sqlOrders);
$totalOrders = $resultOrders->fetch_assoc()['totalOrders'];

$sqlRevenue = "SELECT SUM(total_price) AS totalRevenue FROM orders";
$resultRevenue = $conn->query($sqlRevenue);
$totalRevenue = $resultRevenue->fetch_assoc()['totalRevenue'];

$sqlCustomers = "SELECT COUNT(*) AS totalCustomers FROM users";
$resultCustomers = $conn->query($sqlCustomers);
$totalCustomers = $resultCustomers->fetch_assoc()['totalCustomers'];

$sqlProducts = "SELECT COUNT(*) AS totalProducts FROM add_product";
$resultProducts = $conn->query($sqlProducts);
$totalProducts = $resultProducts->fetch_assoc()['totalProducts'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Dashboard</title>
</head>

<body>

    <div class="container mt-5">
        <h2>Dashboard</h2>

        <div class="row">
            <!-- Container for Number of Orders -->
            <div class="col-md-3 mb-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Orders</h5>
                        <p class="card-text"><?php echo $totalOrders; ?></p>
                    </div>
                </div>
            </div>

            <!-- Container for Total Revenue -->
            <div class="col-md-3 mb-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Revenue</h5>
                        <p class="card-text"><?php echo '$' . number_format($totalRevenue, 2); ?></p>
                    </div>
                </div>
            </div>

            <!-- Container for Number of Customers -->
            <div class="col-md-3 mb-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Customers</h5>
                        <p class="card-text"><?php echo $totalCustomers; ?></p>
                    </div>
                </div>
            </div>

            <!-- Container for Number of Products -->
            <div class="col-md-3 mb-4">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h5 class="card-title">Products</h5>
                        <p class="card-text"><?php echo $totalProducts; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
