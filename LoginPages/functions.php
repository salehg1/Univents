<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php');
if (!is_user_logged_in()) {
    wp_redirect('http://localhost/wordpress/wp-login.php');
    exit;
}

?>