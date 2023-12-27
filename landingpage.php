<?php
include('connection.php');


// Check if the category parameter is set in the URL
if (isset($_GET['category'])) {
    $selectedCategory = $conn->real_escape_string($_GET['category']);

    // Construct SQL query to fetch products based on the category
    $sql = "SELECT * FROM add_product WHERE type = '$selectedCategory'";
} else {
    // If no category is specified, fetch all products
    $sql = "SELECT * FROM add_product";
}

// Execute the query
$result = $conn->query($sql);

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zstore</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Poppins:ital,wght@1,300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylehome.css">
    <style>



    </style>
</head>
<?php
include("connection.php");
$sql = "SELECT * FROM add_product";
$result = $conn->query($sql);


?>

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
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
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
                    <form id="searchbox" class="d-flex mx-auto" method="GET" action="product_main.php" role="search">
                        <input id="search" class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                        <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>


                    <div class="cart-div">
                        <div class="dropdown">
                            <i class="fa-solid fa-user" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                            <div class="dropdown-menu" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" onclick="redirectToLogin()">Login</a>
                                <a class="dropdown-item" href="your_account.php">profile</a>


                            </div>
                        </div> <i class="fa-solid fa-heart"></i>
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </div>
            </div>
        </nav>





    </div>
    <div class="slide">
    <div id="carouselExample" class="carousel slide" >
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://labelrishmaan.com/cdn/shop/files/Label_Rishmaan.png?v=1700313120&width=2200" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h2 data-aos="fade-up">Festive edition</h2>
                    <p data-aos="fade-up"> Lorem Ipsum has been the industry's standard dummy text ever since <p>
                    <button id="buyNowButton" data-aos="fade-up" class="buynow-main">Buy Now</button>
                </div>
            </div>
            <div class="carousel-item" >
                <img src="https://labelrishmaan.com/cdn/shop/files/3_778de171-c1f1-489c-bdf5-e0d4695b57a0.png?v=1700313158&width=2200" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h2 data-aos="fade-up">Bridal edition</h2>
                    <p data-aos="fade-up">Some description about the second slide.</p>
                    <button data-aos="fade-up" class="buynow-main">Buynow</button>
                </div>
            </div>
            <div class="carousel-item" >
                <img src="https://labelrishmaan.com/cdn/shop/files/4_f4890094-e32b-48bf-940a-215246526d35.png?v=1700313145&width=1600" class="d-block w-100" alt="...">
                <div class="carousel-caption">
                    <h2 data-aos="fade-up">Bridal edition</h2>
                    <p data-aos="fade-up">Some description about the third slide.</p>
                    <button data-aos="fade-up" class="buynow-main">Buynow</button>
                </div>
            </div>
        </div>
      
    </div>
</div>

    <div class="banner">
        <img src="asset/Screenshot 2023-12-06 150351.png" alt="">
    </div>

    <div class="shopbycat">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3">
                    <a class="cat-heading" style="text-decoration: none;" href="product_main.php?">
                        <div class="card-cat">
                            <img src="https://labelrishmaan.com/cdn/shop/files/Untitled_design_46e582bb-fe79-443f-aea7-5b7cc24858b8.png?v=1697352948&width=1200" class="card-img-top" alt="Product Image">

                            <div class="card-body">
                                <h5 class="card-title">ALL PRODUCTS</h5>

                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3">
                    <a class="cat-heading" style="text-decoration: none;" href="product_main.php?category=western">

                        <div class="card-cat">
                            <img src="https://labelrishmaan.com/cdn/shop/files/UntitledSession21456.jpg?v=1696592160&width=1200" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title">WESTERN</h5>

                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3">
                    <a class="cat-heading" style="text-decoration: none;" href="product_main.php?category=bridal">

                        <div class="card-cat">
                            <img src="https://labelrishmaan.com/cdn/shop/files/DSC_7237copy.jpg?v=1686468617&width=1200" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title">BRIDAL</h5>


                            </div>
                        </div>
                    </a>

                </div>
                <div class="col-md-3">
                    <a class="cat-heading" style="text-decoration: none;" href="product_main.php?category=ethnic">
                        <div class="card-cat">
                            <img src="https://labelrishmaan.com/cdn/shop/files/DSC_6484cjpg.jpg?v=1696591610&width=1200" class="card-img-top" alt="Product Image">
                            <div class="card-body">
                                <h5 class="card-title">ETHNIC</h5>


                            </div>
                        </div>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class="back">
        <div class="container">
            <div class="image-sec">
                <div class=" main-img">
                    <img src="asset/Screenshot 2023-12-12 112618.png" class="img-fluid" alt="Responsive image">

                </div>
                <div class="des col-md-3 ">
                    <div style="margin:0 auto;">
                        <p>Fresh & latest style</p>
                        <p>Fresh fits for you</p>
                        <a href="product_main.php">
                            <button class="buynow">buynow</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h4 style="text-align: center;margin-bottom:30px">Upto 50% Off</h4>
        <div class="product-card container">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="card col-md-3">
                    <div class="card-container">
                        <img src="<?php echo $row["file"] ?>" class="card-img-top" alt="Product Image">
                        <div class="overlay">
                            <a href="buy.php?id=<?php echo isset($row["id"]) ? $row["id"] : ''; ?>" class="buy-button">Buy Now</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row["productName"] ?></h5>
                        <div class="price">
                            <p class="offer-price">$<?php echo $row["offerPrice"] ?></p>
                            <p class="actual-price">$<?php echo $row["actualPrice"] ?></p>
                            <p class="offer-percentage">(<?php echo $row["offerPercentage"] ?>% Off)</p>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

    </div>




    <!-- Place this at the end of the body tag -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        // Add this script to make the carousel slide automatically
        document.addEventListener('DOMContentLoaded', function() {
            // Get the carousel element
            var carousel = document.getElementById('carouselExample');

            // Create a new bootstrap carousel instance
            var carouselInstance = new bootstrap.Carousel(carousel);

            // Set the interval for automatic sliding (adjust the duration as needed)
            setInterval(function() {
                carouselInstance.next();
            }, 3000); // 3000 milliseconds = 3 seconds, change as needed
        });
    </script>
    <!-- Add this before the closing body tag -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize AOS and other necessary configurations
        AOS.init({
            duration: 800,
            once: true,
        });

        // Add an event listener to the Buy Now button
        var buyNowButton = document.getElementById('buyNowButton');
        if (buyNowButton) {
            buyNowButton.addEventListener('click', function () {
                // Redirect to the product main page
                window.location.href = 'product_main.php';
            });
        }
    });
</script>

    <script>
        function redirectToLogin() {
            // Redirect to the login page (replace 'login.php' with the actual URL)
            window.location.href = 'login.php';
        }
    </script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- JavaScript for Card Animation with Smooth Scaling -->
    <script>
        $(document).ready(function() {
            // Add animation when the page loads
            $(".card-cat").addClass("animated");

            // Add animation on mouseenter
            $(".card-cat").on("mouseenter", function() {
                $(this).addClass("animated");
            });

            // Remove animation on mouseleave
            $(".card-cat").on("mouseleave", function() {
                $(this).removeClass("animated");
            });
        });
    </script>
    <?php
    include('footer.php');
    ?>


</body>

</html>