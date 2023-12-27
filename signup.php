<?php
include('user_signuovalidation.php');
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
    <title>Sign Up Page</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #f8f9fa;
        }

        .signup-container {
            max-width: 400px;
            margin: auto;
            margin-top: 100px;
        }

        .hr-divider {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        #signup {
            color: #f8f9fa;
            background-color: #053863;
        }

        .signup {
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

    <div class="container signup-container">
        <img id="logo" class="center" src="asset/logo.png" alt="">

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="inputFirstName">First Name</label>
                <input type="text" class="form-control" name="inputFirstName" id="inputFirstName" placeholder="Enter your first name">
                <span class="text-danger"><?php echo $firstNameErr; ?></span>
            </div>
            <div class="form-group">
                <label for="inputLastName">Last Name</label>
                <input type="text" class="form-control" name="inputLastName" id="inputLastName" placeholder="Enter your last name">
                <span class="text-danger"><?php echo $lastNameErr; ?></span>
            </div>
            <div class="form-group">
                <label for="inputEmail">Email address</label>
                <input type="email" class="form-control" name="inputEmail" id="inputEmail" placeholder="Enter your email">
                <span class="text-danger"><?php echo $emailErr; ?></span>
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Enter your password">
                <span class="text-danger"><?php echo $passwordErr; ?></span>
            </div>
            <div class="form-group">
                <label for="inputConfirmPassword">Confirm Password</label>
                <input type="password" class="form-control" name="inputConfirmPassword" id="inputConfirmPassword" placeholder="Confirm your password">
                <span class="text-danger"><?php echo $confirmPasswordErr; ?></span>
            </div>
            <button type="submit" id="signup" class="btn  btn-block">Sign Up</button>
            <hr class="hr-divider">
            <button type="button" class="btn btn-secondary btn-block" onclick="redirectToSignin()">Already have an account? Sign In</button>
        </form>
    </div>
    <script>
         function redirectToSignin() {
                // Redirect to the signup page (replace 'signup.php' with the actual URL)
                window.location.href = 'login.php';
            }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
