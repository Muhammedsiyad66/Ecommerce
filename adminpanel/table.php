<?php
include('adminpan.php');
include('connection.php');


// Check if the form for deleting product is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteProduct"])) {
    $productId = $conn->real_escape_string($_POST["productId"]);

    // Delete product from the database
    $sqlDelete = "DELETE FROM add_product WHERE id = '$productId'";
    $conn->query($sqlDelete);
}

// Retrieve products from the database
$sqlSelect = "SELECT * FROM add_product";
$result = $conn->query($sqlSelect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Product Management</title>
</head>

<body>

    <div class="container mt-5">
        <h2>Product List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Offer Price</th>
                    <th>Actual Price</th>
                    <th>Offer Percentage</th>
                    <th>Category</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                // Display products from the database
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['productName']}</td>";
                    echo "<td>{$row['productDescription']}</td>";
                    echo "<td>{$row['offerPrice']}</td>";
                    echo "<td>{$row['actualPrice']}</td>";
                    echo "<td>{$row['offerPercentage']}</td>";
                    echo "<td>{$row['category']}</td>";


                    // Check if the 'type' key exists before accessing it
                    echo "<td>" . (isset($row['type']) ? $row['type'] : "") . "</td>";

                    echo "<td>";
                    echo "<form method='post'>";
                    echo "<input type='hidden' name='productId' value='{$row['id']}'>";
                    echo "<button type='submit' class='btn btn-danger' name='deleteProduct'>Delete</button>";
                    echo "</form>";
                    echo "</td>";
                
                    echo "<td>";
                    echo "<a href='edit.php?id={$row['id']}' class='btn btn-primary'>Edit</a>";
                    echo "</td>";
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