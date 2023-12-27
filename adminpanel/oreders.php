<?php
// Include the database connection file
include('connection.php');
include('adminpan.php');
// Retrieve data from the orders table
$sqlSelect = "SELECT * FROM orders";
$result = $conn->query($sqlSelect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Order List</title>
</head>

<body>

    <div class="container mt-5">
        <h2>Order List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>size</th>
                    <th>Quantity</th>
                    <th>Total Amount</th>
                    <th>mobile number</th>
                    <th>address</th>
                    <th>payment methid</th>
                    <th>order date</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody>
                <?php
                // Display orders from the orders table
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['order_id']}</td>";
                    echo "<td>{$row['product_name']}</td>";
                    echo "<td>{$row['size']}</td>";
                    echo "<td>{$row['quantity']}</td>";
                    echo "<td>{$row['total_price']}</td>";
                    echo "<td>{$row['mobile_number']}</td>";
                    echo "<td>{$row['address1']}</td>";
                    echo "<td>{$row['payment_method']}</td>";
                    echo "<td>{$row['order_date']}</td>";




                    // Add more columns as needed
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
