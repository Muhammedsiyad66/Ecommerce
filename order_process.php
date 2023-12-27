<?php
include('connection.php');

// Initialize error messages
$mobileNumberError = $address1Error = $address2Error = $paymentMethodError = '';

// Define a flag to check if there are validation errors
$hasErrors = false;


// Process form data and insert into the database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pName = $_POST["Name"];
    $sSize = $_POST["Size"];
    $Qquantity = $_POST["Quantity"];
    $mobileNumber = $_POST["mobileNumber"];
    $address1 = $_POST["address1"];
    $address2 = $_POST["address2"];
    $paymentMethod = $_POST["paymentMethod"];
    $totalPrice = $_POST["totalPrice"];

    // Validate user details
    $mobileNumber = $_POST["mobileNumber"];
    if (!preg_match("/^[0-9]+$/", $mobileNumber)) {
        $mobileNumberError = 'Please enter a valid mobile number.';
        $hasErrors = true;
    }

    $address1 = $_POST["address1"];
    if (empty($address1)) {
        $address1Error = 'Address Line 1 is required.';
        $hasErrors = true;
    }

    $address2 = $_POST["address2"];
    // You can add additional validation for Address Line 2 if needed

    // Validate payment method
    $paymentMethod = $_POST["paymentMethod"];
    if (empty($paymentMethod)) {
        $paymentMethodError = 'Please select a payment method.';
        $hasErrors = true;
    }


    if (!$hasErrors) {
        // Insert data into the database
        $sql = "INSERT INTO orders (product_name, size, quantity, total_price, mobile_number, address1, address2, payment_method)
            VALUES ('$pName', '$sSize', '$Qquantity', '$totalPrice', '$mobileNumber', '$address1', '$address2', '$paymentMethod')";

        if ($conn->query($sql) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <style>
        /* Write page CSS here*/
        .message-box {
            display: flex;
            justify-content: center;
            padding-top: 20vh;
            padding-bottom: 20vh;
        }

        .success-container {
            background: white;
            height: 480px;
            width: 90%;
            box-shadow: 5px 5px 10px grey;
            text-align: center;
        }

        .confirm-green-box {
            width: 100%;
            height: 140px;
            background: #d7f5da;
        }


        .monserrat-font {
            font-family: 'Montserrat', sans-serif;
            letter-spacing: 2px;
        }





        /* --------------- site wide START ----------------- */
        .main {
            width: 80vw;
            margin: 0 10vw;
            height: 50vh;
            overflow: hidden;

        }

        body {
            font-family: 'Montserrat', sans-serif;
        }

        /* 
 * Setting the site variables, example of how to use
 * color:var(--text-1);
 *
 */

        :root {
            --background-1: #ffffff;
            --background-2: #E3E3E3;
            --background-3: #A3CCC8;
            --text-1: #000000;
            --text-2: #ffffff;
            --text-size-reg: calc(20px + (20 - 18) * ((100vw - 300px) / (1600 - 300)));
            --text-size-sml: calc(10px + (10 - 8) * ((100vw - 300px) / (1600 - 300)));
        }

        .verticle-align {
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .no-style {
            padding: 0;
            margin: 0;
        }


        /* ------------------ site wide END ----------------- */

        /* ----- RESPONSIVE OPTIONS MUST STAY AT BOTTOM ----- */

        /* SM size and above unless over ridden in bigger sizes */
        @media (min-width: 576px) {
            /* sm size */

        }

        /* MD size and above unless over ridden in bigger sizes */
        @media (min-width: 768px) {}

        /* LG size and above unless over ridden in bigger sizes */
        @media (min-width: 992px) {}

        /* XL size and above */
        @media (min-width: 1200px) {}
    </style>
</head>

<body>
    <!-- start of main -->
    <div>
        <div class="container">

            <div class="row">
                <div class="col-12 ">
                    <div class="message-box">
                        <div class="success-container">

                            <br>
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWz6vyUphBD92WdrUDmD4EntxH3YY3MV1ihqc-q5jOqwmvXiv7YLt-Hh46lWP6oDNEe0Y&usqp=CAU" alt="" style="height: 100px;">
                            <br>
                            <div style="padding-left: 5%; padding-right: 5%">
                                <hr>
                            </div>
                            <br>
                            <h1 class="monserrat-font" style="color: Grey">Thank you for your order</h1>
                            <br>

                            <div class="confirm-green-box">
                                <br>
                                <h5>ORDER CONFIRMATION</h5>
                                <p>Your order has been sucessful!</p>
                                <p>Thank you for choosing Zstore. You will shortly receive a delivery.</p>
                            </div>

                            <br>
                            <a href="landingpage.php" id="create-btn" class="btn btn-ouioui-secondary margin-left-5px">Back to shop</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- end of main -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>