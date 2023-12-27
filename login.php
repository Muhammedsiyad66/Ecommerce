<?php
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the keys are set in the $_POST array
    if (isset($_POST['inputEmail']) && isset($_POST['inputPassword'])) {
        // Get user inputs
        $email = isset($_POST["inputEmail"]) ? $conn->real_escape_string($_POST["inputEmail"]) : null;
        $password = isset($_POST["inputPassword"]) ? $conn->real_escape_string($_POST["inputPassword"]) : null;

        // SQL query to check if the user exists
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row["password"])) {
                session_start(); // Moved session_start() here
                // Password is correct, redirect to landing page
                $_SESSION['user_logged_in'] = true;
                $_SESSION["user_email"] = $email; // Store user's email in the session
                header("Location: landingpage.php");
                exit();
            } else {
                // Incorrect password
                echo '<div class="alert alert-danger" role="alert">Incorrect password</div>';
            }
        } else {
            // User not found
            echo '<div class="alert alert-danger" role="alert">User not found</div>';
        }
    } else {
        // Handle the case when keys are not set
        echo "";
    }

    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Login Page</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
        }

        .login-container {
            max-width: 400px;
            margin: auto;
            margin-top: 100px;
        }

        .hr-divider {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        #signin {
            color: #f8f9fa;
            background-color: #053863;

        }

        .login {
            text-align: center;
            margin-bottom: 30px;
        }

        #logo {
            width: 200px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body>

    <div class="container login-container">
        <img id="logo" class="center" src="asset/logo.png" alt="">


        <form method="post" action="login.php">
            <div class="form-group">
                <label for="inputEmail">Email address</label>
                <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Password">
            </div>
            <button type="submit" id="signin" class="btn  btn-block">Sign In</button>
            <hr class="hr-divider">
            <button type="button" class="btn btn-secondary btn-block" onclick="redirectToSignup()">Create Account</button>
        </form>
    </div>

    <script>
        function redirectToSignup() {
            // Redirect to the signup page (replace 'signup.php' with the actual URL)
            window.location.href = 'signup.php';
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>