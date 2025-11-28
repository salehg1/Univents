<?php
session_start();
require_once('../../../wordpress/wp-load.php');

$error = "";
$success_msg = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $student_id = trim($_POST['student_id'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if (empty($student_id) || empty($email)) {
        $error = "Please enter both Student ID and Email.";
    } else {
        // 1. Verify User exists with this ID and Email
        // user_login is the Student ID in your system
        $user = get_user_by('login', $student_id);

        if (!$user || strtolower($user->user_email) !== strtolower($email)) {
            $error = "No account found with that Student ID and Email combination.";
        } else {
            // 2. Generate a Unique Key for Password Reset
            $key = get_password_reset_key($user);

            if (is_wp_error($key)) {
                $error = "Error generating reset key. Please contact support.";
            } else {
                // 3. Create the Reset Link
                // We point to a NEW file called 'ResetPass.php'
                $host = $_SERVER['HTTP_HOST'];
                $reset_link = "http://" . $host . "/Univents/Entry/PassReset/ResetPass.php?key=$key&login=" . rawurlencode($user->user_login);

                /* * REAL WORLD: You would use wp_mail() here.
                 * LOCALHOST DEV: We print the link to the screen so you can test it.
                 */
                
                // wp_mail($email, "Password Reset", "Click here: " . $reset_link); // Uncomment on live server

                $success_msg = "<strong>(Development Mode)</strong><br>Email 'sent' to $email.<br><br>
                                <a href='$reset_link' style='color: yellow; text-decoration: underline;'>CLICK HERE TO RESET PASSWORD</a>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title data-translate="resetTitle">Reset Password</title>
  <link rel="stylesheet" href="../LogIn/login.css"/> 
  <script src="../../Settings/lang.js" defer></script>
  <style>
      .message-box { padding: 10px; margin-bottom: 15px; border-radius: 5px; text-align: center; font-size: 0.9em; }
      .error-box { background-color: #ffdddd; color: #a94442; border: 1px solid #ebccd1; }
      .success-box { background-color: #2c3e50; color: #fff; border: 1px solid #2ecc71; line-height: 1.5; }
  </style>
</head>

<body>
  <div class="login-wrapper">
    <form class="login-form" method="post">
      <div class="logo-section">
        <img src="../Assets/DF.png" alt="Reset Icon">
        <img src="../Assets/taibah_logo.png" alt="University Logo">
      </div>

      <h2 class="login-title" data-translate="resetTitle">Reset Password</h2>
      
      <?php if($success_msg): ?>
        <div class="message-box success-box"><?php echo $success_msg; ?></div>
      <?php else: ?>
        <p class="welcome-text" data-translate="resetDesc">
            Enter your Student ID and Email to receive a reset link.
        </p>
      <?php endif; ?>

      <?php if ($error): ?>
        <div class="message-box error-box"><?php echo $error; ?></div>
      <?php endif; ?>

      <input type="text" name="student_id" placeholder="Enter your Student ID" 
             data-translate-placeholder="enterStudentId" required>

      <input type="email" name="email" placeholder="Enter your University Email" 
             data-translate-placeholder="emailPlaceholder" required>

      <button type="submit" class="btn-login" data-translate="sendButton">Send Reset Link</button>

      <div class="links">
        <a href="../LogIn/login.php" data-translate="backToLogin">Back to Login</a>
      </div>
    </form>
  </div>
</body>
</html>