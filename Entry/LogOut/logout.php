<?php
/**
 * logout.php
 * Destroys the session and redirects to the Visitor Homepage.
 */

session_start();

// 1. Clear all session variables
$_SESSION = array();

// 2. Destroy the session cookie (Best practice for security)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Destroy the actual session
session_destroy();

// 4. Define Base URL
$host = $_SERVER['HTTP_HOST'];
$base_url = "http://" . $host . "/Univents";

// 5. Redirect to Visitor Homepage
// Note: We changed Homepage.html to Homepage.php in the previous step!
header("Location: " . $base_url . "/Homepage/Visitors/Homepage.php");
exit;
?>