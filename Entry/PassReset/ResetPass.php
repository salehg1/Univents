<?php
/**
 * reset-final.php
 * Verifies the key and sets the new password.
 */
require_once('../../../wordpress/wp-load.php');

$key = $_GET['key'] ?? '';
$login = $_GET['login'] ?? '';
$error = "";
$success = "";

// 1. Verify Key validity
$user = check_password_reset_key($key, $login);

if (is_wp_error($user)) {
    if ($user->get_error_code() === 'expired_key') {
        $error = "Sorry, that link has expired. Please try again.";
    } else {
        $error = "Invalid password reset link.";
    }
}

// 2. Handle Password Reset Submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !is_wp_error($user)) {
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if (empty($pass1) || empty($pass2)) {
        $error = "Please enter a password.";
    } elseif ($pass1 !== $pass2) {
        $error = "Passwords do not match.";
    } else {
        // SAVE NEW PASSWORD
        reset_password($user, $pass1);
        $success = "Password updated successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password</title>
    <link rel="stylesheet" href="../LogIn/login.css"/> 
    <script src="../../Settings/lang.js" defer></script>
    <style>
        .message-box { padding: 10px; margin-bottom: 15px; border-radius: 5px; text-align: center; }
        .error-box { background-color: #ffdddd; color: red; }
        .success-box { background-color: #dff0d8; color: green; }
    </style>
</head>
<body>
  <div class="login-wrapper">
    
    <?php if ($success): ?>
        <div class="login-form" style="text-align:center;">
             <div class="logo-section">
                <img src="../Assets/taibah_logo.png" alt="University Logo">
             </div>
             <h2 class="login-title">Success!</h2>
             <div class="message-box success-box"><?php echo $success; ?></div>
             <p>You can now log in with your new password.</p>
             <br>
             <a href="../LogIn/login.php" class="btn-login" style="text-decoration:none; display:inline-block;">Go to Login</a>
        </div>

    <?php elseif (is_wp_error($user)): ?>
        <div class="login-form" style="text-align:center;">
            <div class="message-box error-box"><?php echo $error; ?></div>
            <a href="forgotPass.php" class="btn-login" style="text-decoration:none;">Request New Link</a>
        </div>

    <?php else: ?>
        <form class="login-form" method="post">
            <div class="logo-section">
                <img src="../Assets/DF.png" alt="Reset Icon">
                <img src="../Assets/taibah_logo.png" alt="University Logo">
            </div>

            <h2 class="login-title" data-translate="enterNewPassword">Enter New Password</h2>
            
            <?php if($error): ?>
                <div class="message-box error-box"><?php echo $error; ?></div>
            <?php endif; ?>

            <input type="password" name="pass1" placeholder="New Password" required>
            <input type="password" name="pass2" placeholder="Confirm New Password" required>

            <button type="submit" class="btn-login" data-translate="savePassword">Save Password</button>
        </form>
    <?php endif; ?>

  </div>
</body>
</html>