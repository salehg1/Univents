<?php
session_start();
include("../../Dependencies/connection.php");
require_once('../../../wordpress/wp-load.php');

$error = "";
$values = [
    'username' => ''
];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // The "username" field now holds the "Student ID"
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['Password'] ?? '';

    $values['username'] = $username;

    if (empty($username) || empty($password)) {
        $error = "يرجى إدخال الرقم الجامعي وكلمة المرور";
    } else {
        global $wpdb;
        // Check credentials against WP Database
        $user = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $wpdb->users WHERE user_login = %s",
            $username
        ));

        if ($user && wp_check_password($password, $user->user_pass, $user->ID)) {
            $_SESSION['Id'] = $user->ID; // Your custom session
            $_SESSION['user_id'] = $user->ID; // Standardize for profile.php

            // Get WordPress Role
            $wp_user = get_user_by('id', $user->ID);
            $roles = $wp_user->roles;
            $role = $roles[0];
            $_SESSION['role'] = $role;

            // 1. DEFINE BASE URL (Dynamic)
            // This ensures we always point to http://localhost/Univents correctly
            $host = $_SERVER['HTTP_HOST'];
            $base_url = "http://" . $host . "/Univents";

            // 2. DETERMINE REDIRECT URL DIRECTLY (No more redirections.php)
            $redirect_url = "";

            if (in_array('administrator', $roles) || in_array('admin', $roles)) {
                $redirect_url = $base_url . '/Homepage/Admin/admin.php';
            } elseif (in_array('subscriber', $roles)) {
                $redirect_url = $base_url . '/Homepage/Student/StudentHomepage.php';
            } else {
                $redirect_url = $base_url . '/Homepage/Visitors/Homepage.php';
            }

            // 3. JAVASCRIPT REDIRECT
            // We use JS because this login form might be inside a modal/iframe
            echo "<script>
                if (window.parent.closeLoginModal) {
                    window.parent.closeLoginModal();
                }
                window.parent.location.href = '" . esc_url($redirect_url) . "';
            </script>";
            exit;

        } else {
            $error = "الرقم الجامعي أو كلمة المرور غير صحيحة";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title data-translate="loginTitle">تسجيل الدخول</title>
    <link rel="stylesheet" href="login.css" />
    <script src="../../Settings/lang.js" defer></script>
    <style>
        .error-box {
            color: red;
            margin-bottom: 15px;
            font-size: 0.95em;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <form class="login-form" method="post" novalidate>
            <div class="logo-section">
                <img src="../Assets/HG.gif" alt="شعار النظام">
                <img src="../Assets/taibah_logo.png" alt="شعار الجامعة">
            </div>

            <h2 class="login-title" data-translate="loginTitle">تسجيل الدخول</h2>
            <p class="welcome-text" data-translate="welcomeBack">مرحبًا بعودتك!</p>

            <?php if (!empty($error)): ?>
                <div class="error-box"><?= $error ?></div>
            <?php endif; ?>

            <input type="text" name="username" placeholder="الرقم الجامعي"
                value="<?= htmlspecialchars($values['username']) ?>" autofocus>

            <input type="password" name="Password" placeholder="كلمة المرور"
                data-translate-placeholder="passwordPlaceholder">

            <button type="submit" class="btn-login" data-translate="loginButton">تسجيل الدخول</button>

            <div class="links">
                <a href="../PassReset/forgotPass.php" data-translate="forgotPassword">نسيت كلمة المرور؟</a> |
                <a href="../SignUp/signup.php" data-translate="createAccount">إنشاء حساب</a>
            </div>
        </form>
    </div>

    <script>
        const form = document.querySelector(".login-form");
        const username = document.querySelector("input[name='username']");
        const password = document.querySelector("input[name='Password']");
        const errorBox = document.querySelector(".error-box");

        form.addEventListener("submit", (e) => {
            if (!username.value.trim() || !password.value.trim()) {
                e.preventDefault();
                if (errorBox) errorBox.textContent = "يرجى إدخال الرقم الجامعي وكلمة المرور";
            }
        });
    </script>


</body>

</html>