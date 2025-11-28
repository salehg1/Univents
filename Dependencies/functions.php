<?php
// Connect to WP
require_once($_SERVER['DOCUMENT_ROOT'] . '../../wordpress/wp-load.php');

// Security Check
if (!is_user_logged_in()) {
    // Redirect to YOUR custom login page
    // Adjust the path "../LoginPages/login.php" to match your folder structure
    header("Location: ../Entry/LogIn/login.php"); 
    exit;
}
?>