<?php
session_start();
$userRole = $_SESSION['role'] ?? null;
?>

<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title data-translate="settings">Taibah Univents - Settings</title>
  <link rel="icon" href="./Images/taibah_logo.png" type="image/*">
  <link rel="stylesheet" href="Settings.css">
  <link rel="stylesheet" href="../Profile/profile.css">
  <script src="../../Settings/lang.js" defer></script>
</head>

<body>

  <div class="settings-container">
    <button
      type="button"
      class="back-button"
      data-translate="back"
      onclick="goBackSafe()">
      Go Back
    </button>

    <div class="settings-list">

      <?php if ($userRole === 'administrator' || $userRole === 'subscriber'): ?>
        <div
          class="settings-item"
          onclick="window.location.href ='../Profile/profile.php'"
          data-translate="personalInfo">
          Personal Information
        </div>
      <?php endif; ?>

      <?php if ($userRole === 'subscriber'): ?>
        <div
          class="settings-item"
          onclick="window.location.href ='../../Homepage/Student/PastEvents/pastEvents.php'"
          data-translate="pastEvents">
          Past Events
        </div>
      <?php endif; ?>

      <div
        class="settings-item"
        onclick="toggleLanguage()"
        data-translate="language">
        Change Language
      </div>

      <?php if ($userRole === 'administrator' || $userRole === 'subscriber'): ?>
        <div
          class="settings-item logout"
          onclick="logoutUser()"
          data-translate="logout">
          Logout
        </div>
      <?php endif; ?>

    </div>
  </div>

  <script>
    function logoutUser() {
      if (confirm(langStrings?.confirmLogout || "Are you sure you want to log out?")) {
        window.location.href = "../../Entry/LogOut/logout.php";
      }
    }

    function goBackSafe() {
      if (document.referrer && document.referrer.indexOf(window.location.host) !== -1) {
        window.history.back();
      } else {
        <?php if ($userRole === 'administrator'): ?>
          window.location.href = '../../Homepage/Admin/admin.php';
        <?php elseif ($userRole === 'subscriber'): ?>
          window.location.href = '../../Homepage/Student/StudentHomepage.php';
        <?php else: ?>
          window.location.href = '../../Homepage/Visitors/Homepage.php';
        <?php endif; ?>
      }
    }
  </script>

</body>
</html>
