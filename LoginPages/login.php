<?php
session_start();
include("connection.php");
require_once('../../wordpress/wp-load.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['Password'] ?? '';

    if (!empty($username) && !empty($password)) {
        global $wpdb;
        $user = $wpdb->get_row($wpdb->prepare(
            "SELECT * FROM $wpdb->users WHERE user_login = %s", $username
        ));

        if ($user && wp_check_password($password, $user->user_pass, $user->ID)) {
            $_SESSION['Id'] = $user->ID;
            header("Location: index.php");
            exit;
        } else {
            $error = "اسم المستخدم أو كلمة المرور غير صحيحة";
        }
    } else {
        $error = "يرجى إدخال اسم المستخدم وكلمة المرور";
    }
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title data-translate="loginTitle">تسجيل الدخول</title>
  <link rel="stylesheet" href="login.css"/>
  <!-- ترجمة -->
  <script src="../Settings/lang.js" defer></script>
</head>

<body>
  <div class="login-wrapper">
    <form class="login-form" method="post">
      <div class="logo-section">
        <img src="HG.gif" alt="شعار النظام">
        <img src="taibah_logo.png" alt="شعار الجامعة">
      </div>

      <h2 class="login-title" data-translate="loginTitle">تسجيل الدخول</h2>
      <p class="welcome-text" data-translate="welcomeBack">مرحبًا بعودتك!</p>

      <input type="text" name="username"
             placeholder="اسم المستخدم"
             data-translate-placeholder="usernamePlaceholder" autofocus>

      <input type="password" name="Password"
             placeholder="كلمة المرور"
             data-translate-placeholder="passwordPlaceholder">

      <button type="submit" class="btn-login" data-translate="loginButton">تسجيل الدخول</button>

      <?php if (!empty($error)): ?>
        <div class="error-box"><?= $error ?></div>
      <?php endif; ?>

      <div class="links">
        <a href="forgotPass.php" data-translate="forgotPassword">نسيت كلمة المرور؟</a> |
        <a href="signup.php" data-translate="createAccount">إنشاء حساب</a>
      </div>
    </form>
  </div>
</body>
</html>
