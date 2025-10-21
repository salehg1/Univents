<?php
session_start();
include("connection.php");
require_once('../../wordpress/wp-load.php');

// هنا تحط منطق إعادة التعيين لاحقاً (إرسال رمز / تحقق)
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>إعادة تعيين كلمة المرور</title>
  <link rel="stylesheet" href="login.css"/> <!-- نستخدم نفس ملف التنسيق -->
</head>

<body>
  <div class="login-wrapper">
    <form class="login-form" method="post">
      <div class="logo-section">
        <img src="DF.png" alt="رمز الحماية">  <!-- استبدل بصورة القفل عندك -->
        <img src="taibah_logo.png" alt="شعار الجامعة">
      </div>

      <h2 class="login-title">إعادة تعيين كلمة المرور</h2>
      <p class="welcome-text">سيتم إرسال رمز تأكيد مكون من 4 أرقام إلى رقم الجوال المدخل</p>

      <input type="text" name="phone" placeholder="أدخل رقم الجوال">
      <input type="text" name="student_id" placeholder="أدخل رقمك الجامعي">
      <input type="password" name="new_pass" placeholder="أدخل كلمة المرور الجديدة">
      <input type="password" name="confirm_pass" placeholder="أعد إدخال كلمة المرور الجديدة">

      <button type="submit" class="btn-login">إرسال</button>

      <div class="links">
        <a href="login.php">عودة لتسجيل الدخول</a>
      </div>
    </form>
  </div>
</body>
</html>
