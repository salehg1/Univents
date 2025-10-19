<?php
session_start();
include("connection.php");
require_once('../../wordpress/wp-load.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username  = $_POST['username'] ?? '';
    $email     = $_POST['email'] ?? '';
    $password  = $_POST['password'] ?? '';
    $confirm   = $_POST['confirm'] ?? '';

    if (!empty($username) && !empty($email) && !empty($password) && ($password === $confirm)) {
        $userdata = array(
            'user_login' => $username,
            'user_pass'  => $password,
            'user_email' => $email,
        );

        $user_id = wp_insert_user($userdata);

        if (!is_wp_error($user_id)) {
            header("Location: login.php");
            exit;
        } else {
            $error = "حدث خطأ أثناء إنشاء الحساب";
        }
    } else {
        $error = "يرجى إدخال جميع البيانات والتأكد من تطابق كلمات المرور";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>إنشاء حساب</title>
  <link rel="stylesheet" href="login.css"/> <!-- نستخدم نفس ملف التنسيق -->
</head>

<body>
  <div class="login-wrapper">
    <form class="login-form" method="post">
      <div class="logo-section">
        <img src="DF.png" alt="رمز التسجيل"> <!-- استبدل بصورة مناسبة -->
        <div class="divider"></div>
        <img src="logo-taibah.png" alt="شعار الجامعة">
      </div>
      <h2 class="login-title">إنشاء حساب جديد</h2>
      <p class="welcome-text">يرجى تعبئة البيانات التالية لإنشاء حسابك الجامعي</p>

      <input type="text" name="username" placeholder="اسم المستخدم">
      <input type="email" name="email" placeholder="البريد الإلكتروني الجامعي">
      <input type="password" name="password" placeholder="كلمة المرور">
      <input type="password" name="confirm" placeholder="تأكيد كلمة المرور">

      <button type="submit" class="btn-login">إنشاء الحساب</button>

      <?php if (!empty($error)): ?>
        <div class="error-box"><?= $error ?></div>
      <?php endif; ?>

      <div class="links">
        <a href="login.php">عودة لتسجيل الدخول</a>
      </div>
    </form>
  </div>
</body>
</html>
