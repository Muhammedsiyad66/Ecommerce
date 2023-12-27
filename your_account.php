<?php

session_start();

if(isset($_SESSION['user_email'])){
    include('connection.php');  // Include your database connection file

    $email = $_SESSION["user_email"];

    // Fetch user details from the database using the logged-in user's email
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $fname = $user["first_name"];
    } else {
        // Handle case where user details are not found
        echo "User details not found.";
        exit();
    }
} else {
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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


        body {
            background-color: #f8f9fa;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }

        .card-header {
            background-color: navy;
            color: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            text-align: center;
        }

        .card-body,
        .card-footer {
            padding: 20px;
            text-align: center;
        }

        .card-footer a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            background-color: #dc3545;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
        }

        .card-footer a:hover {
            background-color: #c82333;
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

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>Welcome, <?php echo $fname ?></h2>
            </div>
            <div class="card-body">
                <p><strong>First Name:</strong> <?php echo $fname ?></p>
                <p><strong>Email:</strong> <?php echo $email ?></p>
            </div>
            <div class="card-footer">
                <a href="logout.php" class="logout-btn">Logout</a>
            </div>
        </div>
    </div>
</body>

</html>
