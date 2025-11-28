<?php
/**
 * signup.php
 * Updated: Uses Student ID as the login credential (user_login) instead of a generic username.
 */
session_start();
include("../../Dependencies/connection.php");
require_once('../../../wordpress/wp-load.php');

$error = "";
$values = [
    'fullname'   => '',
    'student_id' => '', // Changed from username
    'email'      => ''
];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fullname   = trim($_POST['fullname'] ?? '');
    $student_id = trim($_POST['student_id'] ?? ''); // This will be the User Login
    $email      = trim($_POST['email'] ?? '');
    $password   = $_POST['password'] ?? '';
    $confirm    = $_POST['confirm'] ?? '';

    // Preserve entered values
    $values['fullname']   = $fullname;
    $values['student_id'] = $student_id;
    $values['email']      = $email;

    // Server-side validation
    if (empty($fullname)) {
        $error = "يرجى إدخال الاسم";
    } elseif (strlen($fullname) > 60) {
        $error = "الاسم طويل جدًا، الحد الأقصى 60 حرفًا";
    } elseif (empty($student_id)) {
        $error = "يرجى إدخال الرقم الجامعي";
    } elseif (username_exists($student_id)) {
        // WordPress checks 'user_login' column, which now holds the ID
        $error = "الرقم الجامعي مسجل بالفعل";
    } elseif (empty($email)) {
        $error = "يرجى إدخال البريد الإلكتروني";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "البريد الإلكتروني غير صالح";
    } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@taibahu\.edu\.sa$/i', $email)) { 
        $error = "يرجى استخدام البريد الجامعي فقط";
    } elseif (email_exists($email)) {
        $error = "البريد الإلكتروني مستخدم بالفعل";
    } elseif (empty($password)) {
        $error = "يرجى إدخال كلمة المرور";
    } elseif (empty($confirm)) {
        $error = "يرجى تأكيد كلمة المرور";
    } elseif ($password !== $confirm) {
        $error = "كلمات المرور غير متطابقة";
    } else {
        // Determine role based on email digits (students vs admins)
        preg_match_all('/\d/', explode('@', $email)[0], $matches);
        $digitCount = count($matches[0]);

        // Assign WP roles correctly
        $role = ($digitCount >= 6) ? 'subscriber' : 'administrator';

        // Create user in WordPress
        // MAPPING: user_login = student_id
        $userdata = [
            'user_login'   => $student_id, 
            'user_pass'    => $password,
            'user_email'   => $email,
            'display_name' => $fullname,
            'role'         => $role
        ];

        $user_id = wp_insert_user($userdata);

        if (!is_wp_error($user_id)) {
            // Ensure role is set correctly
            wp_update_user([
                'ID'   => $user_id,
                'role' => $role
            ]);

            // IMPORTANT: Save Extra Data for Profile Page
            update_user_meta($user_id, 'student_id', $student_id);
            update_user_meta($user_id, 'major', 'General'); // Default major

            // Redirect to login page
            header("Location: ../LogIn/login.php");
            exit;
        } else {
            $error = "حدث خطأ أثناء إنشاء الحساب: " . $user_id->get_error_message();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title data-translate="createAccountTitle">إنشاء حساب</title>
<link rel="stylesheet" href="./signup.css">
<link rel="stylesheet" href="../LogIn/login.css"/>
<script src="./signup.js"></script>
<script src="../../Settings/lang.js" defer></script>
<style>

</style>
</head>

<body>
<div class="login-wrapper">
<form class="login-form" method="post" novalidate>
  <div class="logo-section">
    <img src="../Assets/DF.png" alt="رمز التسجيل">
    <img src="../Assets/taibah_logo.png" alt="شعار الجامعة">
  </div>

  <h2 class="login-title" data-translate="createAccountTitle">إنشاء حساب جديد</h2>
  <p class="welcome-text" data-translate="signupDesc">يرجى تعبئة البيانات التالية لإنشاء حسابك الجامعي</p>

  <?php if (!empty($error)): ?>
    <div class="error-box"><?= $error ?></div>
  <?php endif; ?>

  <input type="text" name="fullname" id="fullname" placeholder="الاسم الكامل" maxlength="60" 
         value="<?= htmlspecialchars($values['fullname']) ?>" required>

  <input type="text" name="student_id" id="student_id" placeholder="الرقم الجامعي" 
         value="<?= htmlspecialchars($values['student_id']) ?>" required>

  <input type="email" name="email" id="uni-email" placeholder="البريد الإلكتروني الجامعي" 
         value="<?= htmlspecialchars($values['email']) ?>" required>

  <input type="password" name="password" id="password" placeholder="كلمة المرور" required>

  <input type="password" name="confirm" id="confirm" placeholder="تأكيد كلمة المرور" required>

  <button type="submit" class="btn-login">إنشاء الحساب</button>

  <div class="links">
    <a href="../LogIn/login.php" data-translate="backToLogin">عودة لتسجيل الدخول</a>
  </div>
</form>
</div>

</body>
</html>