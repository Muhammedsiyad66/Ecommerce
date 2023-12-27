<?php
include('connection.php');
// Define variables to store user input
$firstName = $lastName = $email = $password = $confirmPassword = "";

// Define variables to store error messages
$firstNameErr = $lastNameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate First Name
    if (empty($_POST["inputFirstName"])) {
        $firstNameErr = "First Name is required";
    } else {
        $firstName = test_input($_POST["inputFirstName"]);
    }

    // Validate Last Name
    if (empty($_POST["inputLastName"])) {
        $lastNameErr = "Last Name is required";
    } else {
        $lastName = test_input($_POST["inputLastName"]);
    }

    // Validate Email
    if (empty($_POST["inputEmail"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["inputEmail"]);
        // Check if email address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate Password
    if (empty($_POST["inputPassword"])) {
        $passwordErr = "Password is required";
    } else {
        $password = test_input($_POST["inputPassword"]);
    }

    // Validate Confirm Password
    if (empty($_POST["inputConfirmPassword"])) {
        $confirmPasswordErr = "Confirm Password is required";
    } else {
        $confirmPassword = test_input($_POST["inputConfirmPassword"]);
        // Check if passwords match
        if ($password != $confirmPassword) {
            $confirmPasswordErr = "Passwords do not match";
        }
    }

    // If there are no errors, you can proceed with further processing (e.g., database insertion)
    if (empty($firstNameErr) && empty($lastNameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
        // Sanitize and escape user inputs before inserting into the database
        $firstName = $conn->real_escape_string($firstName);
        $lastName = $conn->real_escape_string($lastName);
        $email = $conn->real_escape_string($email);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Hash the password for security

        // SQL query to insert data into the users table
        $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('$firstName', '$lastName', '$email', '$passwordHash')";

        // Perform the query
        if ($conn->query($sql) === TRUE) {
            // Redirect the user after successful signup
            header("Location: login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the database connection
        $conn->close();
    }
}


// Function to sanitize and validate input data
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
