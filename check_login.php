<?php
// check_login.php
session_start();

if (isset($_SESSION['user_email'])) {
    echo "logged_in";
} else {
    echo "not_logged_in";
}
?> 
