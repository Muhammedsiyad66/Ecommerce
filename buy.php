<?php
// buy.php
include("connection.php");



// Retrieve the product ID from the URL parameter
if (isset($_GET['id'])) {
    $productID = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    // Validate the product ID
    if ($productID === false || $productID <= 0) {
        echo "Invalid product ID.";
        exit;
    }
} else {
    echo "Product ID not provided.";
    exit;
}

// Construct a query to fetch the product details
$sql = "SELECT * FROM add_product WHERE id = $productID";
$result = $conn->query($sql);

// Check if the product with the specified ID exists
if ($result->num_rows > 0) {
    // Fetch product details
    $productDetails = $result->fetch_assoc();

    // HTML structure for displaying product details
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

            .size label.selected {
                background-color: black;
                color: white;
            }

            .product-container {
                display: flex;
            }

            .product-image img {
                height: 650px;
            }

            .product-details {
                margin: 0 auto;
                text-align: center;
                display: flex;
                align-items: center;
            }

            body {
                font-family: "Inter", sans-serif;
            }

            .actual-price {
                text-decoration: line-through;
            }

            .quantity-control {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: fit-content;
                margin: 0 auto;
                background: #eaeaea;
                border-radius: 10px;
                padding: 1rem 0.4rem;
                margin-top: 4rem;
            }

            .quantity-btn {
                background: transparent;
                border: none;
                outline: none;
                margin: 0;
                padding: 0px 8px;
                cursor: pointer;
            }

            .quantity-btn svg {
                width: 15px;
                height: 15px;
            }

            .quantity-input {
                outline: none;
                user-select: none;
                text-align: center;
                width: 47px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: transparent;
                border: none;
            }

            .quantity-input::-webkit-inner-spin-button,
            .quantity-input::-webkit-outer-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            .price-details {
                margin-top: 15px;
                gap: 20px;
                justify-content: center;
                display: flex;
            }

            .size label {
                width: 50px;
                padding: 10px;
                border: 2px solid black;
            }

            .size-chart {
                margin-top: 30px;
                width: 50%;
            }

            .size input {
                position: absolute;
                visibility: hidden;
            }

            .size label {
                width: 50px;
                padding: 10px;
                border: 2px solid black;
                cursor: pointer;
            }

            .size label.selected {
                background-color: black;
                color: white;
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
        <div class="container">
            <form action="checkout.php" method="post" id="productForm">
                <div class="product-container mt-5">
                    <div style="justify-content: center;" class="row">
                        <div class="product-image">
                            <img src="<?php echo $productDetails["file"]; ?>" alt="Product Image">
                            <input type="hidden" name="productImage" value="<?php echo $productDetails["file"]; ?>">
                            <input type="hidden" name="productName" value="<?php echo $productDetails["productName"]; ?>">
                            <input type="hidden" name="selectedSize" id="selectedSize" value="">
                            <input type="hidden" name="quantity" id="quantityInput" value="1">
                            <input type="hidden" name="offerPrice" value="<?php echo $productDetails["offerPrice"]; ?>">
                        </div>
                        <div class="product-details">
                            <div>
                                <h2 class="product-title"><?php echo $productDetails["productName"]; ?></h2>
                                <p class="product-description"><?php echo $productDetails["productDescription"]; ?></p>
                                <div class="size">
                                    <input type="radio" id="sizeXS" name="size" onclick="setSize('XS')">
                                    <label for="sizeXS">XS</label>

                                    <input type="radio" id="sizeS" name="size" onclick="setSize('S')">
                                    <label for="sizeS">S</label>

                                    <input type="radio" id="sizeM" name="size" onclick="setSize('M')">
                                    <label for="sizeM">M</label>

                                    <input type="radio" id="sizeL" name="size" onclick="setSize('L')">
                                    <label for="sizeL">L</label>

                                    <input type="radio" id="sizeXL" name="size" onclick="setSize('XL')">
                                    <label for="sizeXL">XL</label>

                                    <input type="radio" id="sizeXXL" name="size" onclick="setSize('XXL')">
                                    <label for="sizeXXL">XXL</label>
                                </div>
                                <div id="sizeAlert" style="color: red;"></div>



                                <div class="container">
                                    <div class="quantity-control" data-quantity="">
                                        <button class="quantity-btn" data-quantity-minus=""><svg viewBox="0 0 409.6 409.6">
                                                <g>
                                                    <g>
                                                        <path d="M392.533,187.733H17.067C7.641,187.733,0,195.374,0,204.8s7.641,17.067,17.067,17.067h375.467 c9.426,0,17.067-7.641,17.067-17.067S401.959,187.733,392.533,187.733z" />
                                                    </g>
                                                </g>
                                            </svg></button>
                                        <input type="number" class="quantity-input" data-quantity-target="" value="1" step="1" min="1" max="" name="quantity" id="quantityInput">
                                        <button class="quantity-btn" data-quantity-plus=""><svg viewBox="0 0 426.66667 426.66667">
                                                <path d="m405.332031 192h-170.664062v-170.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031-11.773437 0-21.332031 9.558594-21.332031 21.332031v170.667969h-170.667969c-11.773437 0-21.332031 9.558594-21.332031 21.332031 0 11.777344 9.558594 21.335938 21.332031 21.335938h170.667969v170.664062c0 11.777344 9.558594 21.335938 21.332031 21.335938 11.777344 0 21.335938-9.558594 21.335938-21.335938v-170.664062h170.664062c11.777344 0 21.335938-9.558594 21.335938-21.335938 0-11.773437-9.558594-21.332031-21.335938-21.332031zm0 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="price-details ">
                                    <p class="offer-price"><span style="font-weight:600;">Price</span> = $<?php echo $productDetails["offerPrice"]; ?></p>
                                    <p class="actual-price">$<?php echo $productDetails["actualPrice"]; ?></p>
                                    <p class="offer-percentage">(<?php echo $productDetails["offerPercentage"]; ?>% Off)</p>
                                </div>
                                <div class="action-buttons">
                                    <div class="action-buttons">
                                        <button type="button" class="btn btn-buy-now btn-dark" onclick="submitForm()">Buy Now</button>
                                    </div>
                                </div>


                                <div class="size-chart">
                                    <img src="asset/Screenshot 2023-12-14 130703.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function setSize(size) {
                var sizeLabels = document.querySelectorAll('.size label');
                sizeLabels.forEach(function(label) {
                    label.classList.remove('selected');
                });

                var selectedLabel = document.querySelector('.size label[for="size' + size + '"]');
                selectedLabel.classList.add('selected');

                document.getElementById('selectedSize').value = size;
            }

            function submitForm() {
                // Check if a size is selected
                var selectedSize = document.getElementById('selectedSize').value;
                var sizeAlert = document.getElementById('sizeAlert');

                if (selectedSize === "") {
                    // If no size is selected, show a message in the sizeAlert div
                    sizeAlert.innerHTML = "Please select a size before proceeding to checkout.";
                } else {
                    // If a size is selected, clear the sizeAlert div and submit the form
                    sizeAlert.innerHTML = "";
                    document.getElementById('productForm').submit();
                }
            }


            // Quantity control script
            (function() {
                "use strict";

                function Guantity($root) {
                    const element = $root;
                    const quantityTarget = $root.find("[data-quantity-target]");
                    const quantityMinus = $root.find("[data-quantity-minus]");
                    const quantityPlus = $root.find("[data-quantity-plus]");
                    let quantity = parseInt(quantityTarget.val());

                    $(quantityMinus).click(function(event) {
                        event.preventDefault(); // Prevent the default form submission action
                        if (quantity > 1) {
                            quantityTarget.val(--quantity);
                        }
                    });

                    $(quantityPlus).click(function(event) {
                        event.preventDefault(); // Prevent the default form submission action
                        quantityTarget.val(++quantity);
                    });
                }

                $.fn.Guantity = function() {
                    return this.each(function() {
                        if (!$(this).data("Guantity")) {
                            $(this).data("Guantity", new Guantity($(this)));
                        }
                    });
                };

                $("[data-quantity]").Guantity();
            })();
        </script>


        <!-- Other HTML and PHP code above this line -->

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Other HTML and PHP code below this line -->



    </body>

    </html>




    </body>

    </html>
<?php
} else {
    // Product not found
    echo "Product not found.";
}
?>