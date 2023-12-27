<?php
 session_start();

 if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
   header("Location: login.php");
   exit();
 }
// product_main.php
include("connection.php");

// Retrieve the category and sorting options from the URL parameters
$category = isset($_GET['category']) ? $_GET['category'] : '';
$sortBy = isset($_GET['sortBy']) ? (array)$_GET['sortBy'] : [];


// Construct a query based on the category and sorting options
$sql = "SELECT * FROM add_product";

// Apply category filter
if (!empty($category)) {
    $sql .= " WHERE category = '$category'";
}

// Apply sorting options
if (in_array('lowToHigh', $sortBy)) {
    $sql .= " ORDER BY offerPrice ASC";
} elseif (in_array('highToLow', $sortBy)) {
    $sql .= " ORDER BY offerPrice DESC";
}



$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>E-commerce Sidebar Filter</title>
    <style>
        #logo {
            width: 200px !important;
        }

        .cart-div {
            display: flex;
            gap: 20px;
        }

        .cart-div i {
            font-size: 20px;
            color: #053863;
        }

        .navbar-collapse {
            gap: 40px;
            flex-basis: 100%;
            flex-grow: 0;
            align-items: center;
        }

        #searchbox {
            border: 2px solid black;
            border-radius: 10px;
        }

        #search {
            border: none;
            border-radius: 10px;

        }

        .nav-link {
            color: black;
        }

        body {
            font-family: 'Arial', sans-serif;
        }

        .card-text {
            height: 40px;
        }

        .product-card {
            display: flex;
            flex-wrap: wrap;
        }

        .product-card .card {
            width: 300px;
            border: none;
            text-align: center;
        }

        .card img {
            width: 100%;
            height: 380px;
            object-fit: cover;
        }

        .price {
            justify-content: center;
            display: flex;
            gap: 10px;
        }

        .card-text {
            font-size: 14px;
        }

        .actual-price {
            text-decoration: line-through;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <img id="logo" src="asset/logo.png" alt="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="landingpage.php">Home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="product_main.php">All Products</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="product_main.php?category=ethnic">ETHNIC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="product_main.php?category=western">WESTERN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="product_main.php?category=bridal">BRIDAL</a>
                        </li>
                    </ul>

                    <form id="searchbox" class="d-flex mx-auto" role="search">

                        <input id="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn " type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>

                    <div class="cart-div">
                        <i class="fa-solid fa-user " onclick="redirectToLogin()"></i>
                        <i class="fa-solid fa-heart"></i>
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <div class="mt-5">
        <?php
        // Display the category name in the heading
        if (!empty($category)) {
            echo '<h4 style="text-align: center; margin-bottom: 30px">Products in Category: ' . ucwords($category) . '</h4>';
        } else {
            echo '<h4  style="text-align: center; margin-bottom: 30px;">ALL PRODUCTS</h4>';
        }
        ?>
        <div class="main-div container mt-5" style="display: flex;">
            <div class="row">
                <div style="margin-bottom: 30px;" class="col-md-3">
                    <div class="sidebar">
                        <div class="filter-heading">Filter By</div>
                        <!-- Category filter -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="bridal" id="categoryBridal">
                            <label class="form-check-label" for="categoryBridal">
                                Bridal
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="ethnic" id="categoryEthnic">
                            <label class="form-check-label" for="categoryEthnic">
                                Ethnic
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="western" id="categoryWestern">
                            <label class="form-check-label" for="categoryWestern">
                                Western
                            </label>
                        </div>

                        <!-- Sorting options -->
                        <div class="filter-heading mt-3">Sort By</div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="lowToHigh" id="sortByLowToHigh" name="sortBy[]">
                            <label class="form-check-label" for="sortByLowToHigh">
                                Price: Low to High
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="highToLow" id="sortByHighToLow" name="sortBy[]">
                            <label class="form-check-label" for="sortByHighToLow">
                                Price: High to Low
                            </label>
                        </div>
                    </div>
                    <button type="button" class="btn btn-info mt-3" onclick="applyFilters()">Apply Now</button>

                </div>

                <div class="product-card container col-md-9">
                    <?php
                    // Check if there are any products in the result set
                    if ($result->num_rows > 0) {
                        // Loop through each row in the result set
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="card col-md-4">
                                <img src="<?php echo $row["file"] ?>" class="card-img-top" alt="Product Image">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row["productName"] ?></h5>
                                    <p class="card-text"><?php echo $row["productDescription"] ?></p>
                                    <div class="price">
                                        <p class="offer-price">$<?php echo $row["offerPrice"] ?></p>
                                        <p class="actual-price">$<?php echo $row["actualPrice"] ?></p>
                                        <p class="offer-percentage">(<?php echo $row["offerPercentage"] ?>% Off)</p>
                                    </div>
                                    <button id="buynowA" type="button" class="btn btn-dark" onclick="window.location.href='buy.php?id=<?php echo $row["id"]; ?>'">
                                        Buy Now
                                    </button>

                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        // Display a message if no products are found
                        echo '<p>No products found in this category.</p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- ... Your HTML and PHP code ... -->

    <!-- ... Your HTML and PHP code ... -->

    <!-- Include jQuery before your script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // JavaScript function to apply filters
        function applyFilters() {
            console.log('applyFilters function called'); // Debugging statement

            var categoryFilters = [];
            var sortByFilters = [];

            // Get selected category filters
            if ($('#categoryBridal').prop('checked')) {
                categoryFilters.push('bridal');
            }
            if ($('#categoryEthnic').prop('checked')) {
                categoryFilters.push('ethnic');
            }
            if ($('#categoryWestern').prop('checked')) {
                categoryFilters.push('western');
            }

            // Get selected sorting options
            if ($('#sortByLowToHigh').prop('checked')) {
                sortByFilters.push('lowToHigh');
            }
            if ($('#sortByHighToLow').prop('checked')) {
                sortByFilters.push('highToLow');
            }

            // Construct the URL with filters and sorting options and redirect
            var redirectUrl = 'product_main.php';
            if (categoryFilters.length > 0) {
                redirectUrl += '?category=' + categoryFilters.join(',');
            }
            if (sortByFilters.length > 0) {
                redirectUrl += (categoryFilters.length > 0 ? '&' : '?') + 'sortBy=' + sortByFilters.join(',');
            }

            console.log('Redirecting to:', redirectUrl); // Debugging statement
            window.location.href = redirectUrl;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
<?php
include('footer.php');
?>
</body>

</html>