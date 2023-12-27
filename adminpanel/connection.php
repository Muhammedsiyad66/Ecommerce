        
<?php
$db_host = "localhost";
$db_user = "siyad";
$db_password = "123456";
$db_name = "ecommerce";

// Create connection
$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
