<?php
session_start();
include('connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $email = $_POST['inputEmail'];
    $password = $_POST['inputPassword'];

    // Validate email and password (add more validation if needed)
    if (!empty($email) && !empty($password)) {
        // Check the database for matching credentials
        $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $query);

        // Check if a matching record is found
        if ($result && mysqli_num_rows($result) > 0) {
            // Login successful, set session variables and redirect
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
            exit();
        } else {
            // Login failed, show an error message or perform other actions
            $error = "Invalid email or password. Please try again.";
        }
    } else {
        // Handle empty email or password
        $error = "Both email and password are required.";
    }
}
?>
<!-- rest of your HTML code -->

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

       
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <h4 style="text-align:center">admin login</h4><br>
    <div class="form-group">
        <label for="inputEmail">Email address</label>
        <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password">
    </div>
    <button type="submit" id="signin" class="btn btn-block">Sign In</button>
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
    <?php if (isset($error)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php } ?>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>