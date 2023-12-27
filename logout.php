<?php
session_start();

// Check if the user is logged in


// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();


// Redirect to the login page
header("Location: landingpage.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="0;url=adminlogin.php">
    <title>Logout</title>
</head>
<body>
    <!-- Empty body content -->
</body>
</html>
