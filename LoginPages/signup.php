<?php
session_start();
include("connection.php");

// Load WordPress functions
require_once('../../wordpress/wp-load.php'); // adjust path

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['StdId'];
    $password = $_POST['Password'];
    $email = $_POST['Email']; // optional, if you have an email field

    if (!empty($username) && !empty($password)) {

        if (username_exists($username) || (!empty($email) && email_exists($email))) {
            echo "Username or email already exists.";
        } else {
            // Create WordPress user
            $user_id = wp_create_user($username, $password, $email);

            if (is_wp_error($user_id)) {
                echo "Error: " . $user_id->get_error_message();
            } else {
                $_SESSION['Id'] = $user_id;
                header("Location: login.php");
                exit;
            }
        }

    } else {
        echo "Please Enter Valid Info";
    }
}
?>


<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>إنشاء حساب</title>
  <link rel="stylesheet" href="login.css"/>
</head>
<body>

  <div class="modal-overlay" style="display: block;"></div>
  <div class="modal-content" style="display: block;">
    <button class="butto" onclick="window.location.href='login.html'"><span class="X">&times;</span></button>

    <div class="container active">
      <form class="login-form" id="signupForm" method="post">
        <div class="images-container">
          <img src="DF.png" alt="Logo">
          <div class="separator"></div>
          <img src="logo-taibah.png" alt="Logo">
        </div>

        <h2>إنشاء حساب</h2>
        <h4>سيتم إرسال رمز مكون من 4 أرقام إلى رقم الجوال للتأكيد</h4>
        
        <input type="text" id="username" name="username" placeholder="اسم المستتخدم" required>
        <input type="text" id="nnnnnuuuuulll" name="firstName" placeholder="الاسم الاول" required>
        <input type="text" id="nnuuuuuuuulll" name="lastName" placeholder="الاسم الاخير" required>
        <input type="text" name="StdId" placeholder="رقمك الجامعي" required>
        <input type="email" name="Email" placeholder="البريد الالكتروني" required>
        <input type="text" name="PhoneNumber"  placeholder="📞 أدخل رقم الجوال" required>
        <input type="password" name = "Password" id="signupPassword" placeholder="🔒 أدخل كلمة المرور الجديدة">

        <button class="btn-login" type="submit">إنشاء حساب</button>

        <div class="links">
          <a href="login.php">عودة لتسجيل الدخول</a>

        </div>
      </form>
    </div>
  </div>

  <!-- إشعارات -->
  <div id="errorNotification" class="notifications-container hidden">
    <!-- ... same as in login.html -->
  </div>

</body>



    
</html>