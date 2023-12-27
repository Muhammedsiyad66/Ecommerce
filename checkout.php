    <?php
    include('connection.php');

    // checkout.php
    $mobileNumberError = $address1Error = $address2Error = $paymentMethodError = '';


    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Retrieve posted data
        $productImage = $_POST["productImage"];
        $productName = $_POST["productName"];
        $offerPrice = $_POST["offerPrice"];
        $selectedSize = $_POST["selectedSize"];
        $quantity = $_POST["quantity"];

        // Calculate total price (you may need to adjust this based on your logic)
        $totalPrice = $offerPrice * $quantity;
    }

    ?>



    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Checkout</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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



            .user-details,
            .payment-method {
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                margin-bottom: 20px;
            }

            .user-details h3,
            .payment-method h3 {
                color: #053863;
                font-size: 1.5rem;
                margin-bottom: 15px;
                text-align: center;
            }

            .user-details label,
            .payment-method label {
                display: block;
                margin-bottom: 8px;
                color: #333;
            }

            .user-details input,
            .payment-method input {
                width: 100%;
                padding: 10px;
                margin-bottom: 15px;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 5px;
                color: #333;
            }

            .payment-method label {
                display: block;
                margin-bottom: 10px;
                color: #333;
            }

            .payment-method .custom-control {
                display: flex;
                align-items: center;
                margin-bottom: 10px;
            }

            .payment-method .custom-control-label {
                flex-grow: 1;
                color: #333;
            }

            .place-order-btn {
                display: flex;
                justify-content: center;
            }

            .btn-buy-now {
                background-color: #053863;
                color: #fff;
                padding: 10px 20px;
                font-size: 1.2rem;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            .card img {
                width: 100%;
                height: 380px;
                object-fit: contain;
            }

            .card {
                border: none;
            }

            .check-heading {
                text-align: center;
                font-size: 16px;
                background-color: #053863;
                padding: 5px 5px;
                color: #fff;
            }

            .response {
                color: red;
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
        <h2 class="check-heading">Checkout Now</h2>
        <div class="container">
            <form id="checkoutForm" action="order_process.php" method="post" onsubmit="return validateForm(event)">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <img src="<?php echo $productImage; ?>" class="card-img-top" alt="Product Image">
                            <div class="card-body" style="text-align:center;">
                                <h5 class="card-title">Order Summary</h5>
                                <p name="productName" id="productName" class="card-text">Product: <?php echo $productName; ?></p>
                                <p name="selectedSize" id="selectedSize" class="card-text">Size: <?php echo $selectedSize; ?></p>
                                <p name="offerPrice" id="offerPrice" class="card-text">Price: $<?php echo $offerPrice; ?></p>
                                <p name="quantity" id="quantity" class="card-text">Quantity: <?php echo $quantity; ?></p>
                                <p name="totalPrice" id="totalPrice" class="card-text">Total Price: $<?php echo $totalPrice; ?></p>

                                <!-- Add hidden input fields for data to be submitted -->
                                <!-- Add hidden input fields for data to be submitted -->
                                <input type="hidden" name="Name" value="<?php echo $productName; ?>">
                                <input type="hidden" name="Size" value="<?php echo $selectedSize; ?>">
                                <input type="hidden" name="Quantity" value="<?php echo $quantity; ?>">
                                <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">


                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">

                            <div class="user-details">
                                <h3>User Details</h3>
                                <!-- Add hidden input fields for data to be submitted -->
                                <label for="mobileNumber">Mobile Number:</label>
                                <input type="text" id="mobileNumber" name="mobileNumber" value="<?php echo isset($mobileNumber) ? $mobileNumber : ''; ?>">
                                <span class="error"><?php echo $mobileNumberError; ?></span>

                                <label for="address1">Address Line 1:</label>
                                <input type="text" id="address1" name="address1" value="<?php echo isset($address1) ? $address1 : ''; ?>">
                                <span class="error"><?php echo $address1Error; ?></span>

                                <label for="address2">Address Line 2:</label>
                                <input type="text" id="address2" name="address2" value="<?php echo isset($address2) ? $address2 : ''; ?>">
                                <span class="error"><?php echo $address2Error; ?></span>
                            </div>

                            <div class="payment-method">
                                <h3>Payment Method</h3>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="upi" name="paymentMethod" class="custom-control-input" value="upi">
                                    <label class="custom-control-label" for="upi">UPI</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="cashOnDelivery" name="paymentMethod" class="custom-control-input" value="cashOnDelivery">
                                    <label class="custom-control-label" for="cashOnDelivery">Cash on Delivery</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="netbanking" name="paymentMethod" class="custom-control-input" value="netbanking">
                                    <label class="custom-control-label" for="netbanking">Netbanking</label>
                                </div>
                                <span class="error"><?php echo $paymentMethodError; ?></span>




                                <span id="mobileNumberError" class="error" style="color: red;"></span>
                                <span id="addressError" class="error" style="color: red;"></span>
                                <span id="paymentMethodError" class="error" style="color: red;"></span>

                            </div>


                            <div class="place-order-btn">
                                <button type="submit" class="btn btn-buy-now" onclick="validateForm()">Place Order</button>
                            </div>


                        </div>



                    </div>
                </div>
            </form>
        </div>
        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
function checkLoginStatus() {
    $.ajax({
        url: 'check_login.php',
        type: 'GET',
        success: function (response) {
            console.log('AJAX success:', response);

            if (response.trim() === 'logged_in') {
                // User is logged in, submit the form
                document.getElementById('checkoutForm').submit();
            } else {
                // User is not logged in, show the login modal
                $('#loginModal').modal('show');
            }
        },
        error: function (xhr, status, error) {
            console.error('AJAX error:', status, error);
        }
    });
}


    function validateForm(event) {
        // Reset previous error messages
        document.getElementById('mobileNumberError').innerHTML = '';
        document.getElementById('addressError').innerHTML = '';
        document.getElementById('paymentMethodError').innerHTML = '';

        // Get values from form fields
        var mobileNumber = document.getElementById('mobileNumber').value;
        var address1 = document.getElementById('address1').value;
        var paymentMethod = document.querySelector('input[name="paymentMethod"]:checked');

        // Validate mobile number
        if (!mobileNumber.match(/^\d+$/)) {
            document.getElementById('mobileNumberError').innerHTML = 'Please enter a valid mobile number.';
            return false;
        }

        // Validate address
        if (address1.trim() === '') {
            document.getElementById('addressError').innerHTML = 'Address Line 1 is required.';
            return false;
        }

        // Validate payment method
        if (!paymentMethod) {
            document.getElementById('paymentMethodError').innerHTML = 'Please select a payment method.';
            return false;
        }

        // Check if the user is logged in
        checkLoginStatus();

        event.preventDefault(); // Prevent the form from submitting immediately
    }

    // Add this function to close the modal after a successful login
    function closeLoginModal() {
        $('#loginModal').modal('hide');
    }
</script>




        <!-- Add this modal at the end of your HTML body -->

        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="loginModalLabel">Login Required</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- You can include the content of your login.php file here -->
                        <?php include('login.php'); ?>
                    </div>
                </div>
            </div>
        </div>




    </body>

    </html>