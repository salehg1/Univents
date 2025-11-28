<?php
/**
 * profile.php
 * Displays the logged-in user's information from the WordPress Database.
 */

session_start();

// 1. Connect to WordPress
// Adjust this path if necessary, just like we did for add.php
require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php'); 

// 2. Check if user is logged in
// We check both WordPress session and your custom $_SESSION
$user_id = 0;

if (is_user_logged_in()) {
    $user_id = get_current_user_id();
} elseif (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}

if ($user_id == 0) {
    // Not logged in? Redirect to login page
    header("Location: ../../LoginPages/login.php");
    exit;
}

// 3. Fetch User Object
$user_info = get_userdata($user_id);

// 4. Fetch Extra Fields (Meta Data)
// Note: These will only show if you saved them during Registration.
// If not, we show "Not Specified" or the Username.
$major = get_user_meta($user_id, 'major', true);
$student_id_meta = get_user_meta($user_id, 'student_id', true); 

// Fallback logic
$display_name = $user_info->display_name;
$display_email = $user_info->user_email;
$display_major = !empty($major) ? $major : "Not Specified";
$display_id = !empty($student_id_meta) ? $student_id_meta : $user_info->user_login; // Fallback to username

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title data-translate="profileTitle">Profile</title>
    <link rel="stylesheet" href="profile.css" />
    <script src="../main_settings/Settings.js"></script>

    <script>
      // This JS only handles the preview. 
      // To actually SAVE the new picture to the database requires a PHP form handler.
      const profileInput = document.getElementById("profileInput");
      const profilePicture = document.getElementById("profilePicture");

      window.addEventListener('DOMContentLoaded', () => {
          const profileInput = document.getElementById("profileInput");
          const profilePicture = document.getElementById("profilePicture");
          
          if(profileInput) {
              profileInput.addEventListener("change", function () {
                const file = this.files[0];
                if (file) {
                  profilePicture.src = URL.createObjectURL(file);
                }
              });
          }
      });
    </script>

    <script src="../lang.js" defer></script>
  </head>

  <body>
    <div class="profile-container">
      <div class="profile-picture-container">
        <img
          id="profilePicture"
          src="./Default-pfp.png"
          alt="Profile Picture"
        />
        <input
          type="file"
          id="profileInput"
          accept="image/png, image/jpeg, image/webp"
        />
      </div>

      <div class="user-info">
        <h2 data-translate="profileTitle">Profile Information</h2>

        <div class="info-item">
          <label data-translate="studentName">Full Name:</label>
          <p><?php echo esc_html($display_name); ?></p>
        </div>

        <div class="info-item">
          <label data-translate="email">Email:</label>
          <p><?php echo esc_html($display_email); ?></p>
        </div>

        <div class="info-item">
          <label data-translate="major">Major:</label>
          <p><?php echo esc_html($display_major); ?></p>
        </div>

        <div class="info-item">
          <label data-translate="studentId">Student ID:</label>
          <p><?php echo esc_html($display_id); ?></p>
        </div>
      </div>
    </div>

    <div class="back-button-container">
      <button type="button" class="back-button" data-translate="back" onclick="history.back();">
        Go Back
      </button>
    </div>
  </body>
</html>