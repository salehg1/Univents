<?php
/**
 * event-card.php
 * Updated: "Go Back" button now links directly to the user's dashboard
 * to prevent history loops with the "View Attendees" page.
 */

session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php');

// 1. Auth & Role Check
if (isset($_SESSION['role'])) {
  $role = strtolower($_SESSION['role']);
  $current_user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
} else {
  $role = 'visitor';
  $current_user_id = 0;
}

// 2. Determine the "Go Back" Destination (Fixes the Loop)
$back_url = '../Visitors/Homepage.php'; // Default for Visitors

if ($role === 'administrator' || $role === 'admin') {
    $back_url = '../Admin/admin.php';
} elseif ($role === 'subscriber') { // Default WP role for students
    $back_url = '../Student/StudentHomepage.php';
}

// 3. Get Event Data
$event_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$post = get_post($event_id);

if (!$post || $post->post_type !== 'post') {
  echo "Event not found.";
  exit;
}

// 4. Fetch Meta Data
$major = get_post_meta($event_id, 'event_major', true);
$location = get_post_meta($event_id, 'event_location', true);
$time = get_post_meta($event_id, 'event_time', true);
$requires_reg = get_post_meta($event_id, 'requires_registration', true);
$image_url = get_post_meta($event_id, 'event_image_url', true);
if (empty($image_url))
  $image_url = "https://via.placeholder.com/450x250?text=No+Image";

// 5. CHECK REGISTRATION STATUS
$is_registered = false;
if ($current_user_id > 0) {
  $participants = get_post_meta($event_id, 'participant_id');
  $is_registered = in_array($current_user_id, $participants);
}

// 6. Handle Delete (Admin Only)
if (isset($_POST['action']) && $_POST['action'] === 'delete') {
  if ($role === 'administrator' || $role === 'admin') {
    wp_delete_post($event_id, true);
    header("Location: ../Admin/admin.php");
    exit;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo esc_html($post->post_title); ?></title>
  
  <link rel="stylesheet" href="event-card.css">
  <script src="../../Settings/lang.js" defer></script>

  <style>
      /* Base Button Style */
      .std-btn {
          border: none;
          border-radius: 30px;
          padding: 12px 25px;
          font-size: 14px;
          font-weight: 600;
          text-transform: uppercase;
          cursor: pointer;
          color: white;
          text-decoration: none;
          box-shadow: 0 4px 10px rgba(0,0,0,0.15);
          transition: all 0.3s ease;
          display: inline-block;
          margin-right: 10px;
          margin-top: 10px;
      }
      /* Red Gradient */
      .btn-red { background: linear-gradient(135deg, #e74c3c, #c0392b); }
      .btn-red:hover { background: linear-gradient(135deg, #c0392b, #e74c3c); transform: translateY(-2px); box-shadow: 0 6px 15px rgba(231, 76, 60, 0.4); }

      /* Blue Gradient */
      .btn-blue { background: linear-gradient(135deg, #3498db, #2980b9); }
      .btn-blue:hover { background: linear-gradient(135deg, #2980b9, #3498db); transform: translateY(-2px); box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4); }

      /* Green Gradient */
      .btn-green { background: linear-gradient(135deg, #4CAF50, #2ecc71); }
      .btn-green:hover { background: linear-gradient(135deg, #43a047, #27ae60); transform: translateY(-2px); box-shadow: 0 8px 18px rgba(39, 174, 96, 0.4); }
      
      /* Grey */
      .btn-grey { background: #bdc3c7; color: #fff; cursor: default; box-shadow: none; }
      .btn-grey:hover { transform: none; }
  </style>
</head>

<body>
  <div class="container">
    <h1 data-translate="eventInfo">Event Information</h1>

    <div class="event-image">
      <img id="eventImage" src="<?php echo esc_url($image_url); ?>" alt="Event Picture" />
    </div>

    <div class="Event-section">
      <h2 data-translate="eventInfo">Event Information</h2>
      
      <div class="info-row">
        <div class="info-label" data-translate="eventName">Event Name:</div>
        <div class="info-value"><?php echo esc_html($post->post_title); ?></div>
      </div>
      
      <div class="info-row">
        <div class="info-label" data-translate="major">Major:</div>
        <div class="info-value"><?php echo esc_html($major); ?></div>
      </div>
    </div>

    <div class="Event-section">
      <h2 data-translate="eventDetails">Event Details</h2>
      
      <div class="info-row">
        <div class="info-label" data-translate="location">Location:</div>
        <div class="info-value"><?php echo esc_html($location); ?></div>
      </div>
      
      <div class="info-row">
        <div class="info-label" data-translate="time">Time:</div>
        <div class="info-value"><?php echo esc_html($time); ?></div>
      </div>

      <div class="buttons-row">
        
        <a href="<?php echo $back_url; ?>" id="back-btn" class="std-btn btn-red" data-translate="back">Go Back</a>

        <?php if ($role === 'administrator' || $role === 'admin'): ?>
          
          <button class="std-btn btn-blue"
            onclick="window.location.href='view-attendees.php?id=<?php echo $event_id; ?>'"
            data-translate="viewAttendees">
            View Attendees
          </button>

          <form method="POST" style="display:inline;" onsubmit="return confirm('Delete this event?');">
            <input type="hidden" name="action" value="delete">
            <button type="submit" id="delete-btn" class="std-btn btn-red" data-translate="deleteEvent">Delete Event</button>
          </form>

        <?php elseif ($role === 'visitor'): ?>
          <?php else: ?>
          <?php if ($requires_reg == '1'): ?>
            <?php if ($is_registered): ?>
              <button class="std-btn btn-grey" disabled data-translate="registered">✅ Registered</button>
            <?php else: ?>
              <button id="register-btn" class="std-btn btn-green" data-translate="register">Register</button>
            <?php endif; ?>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script>
    const registerBtn = document.getElementById("register-btn");

    if (registerBtn) {
      registerBtn.onclick = function () {
        const processingText = (document.documentElement.lang === 'ar') ? 'جاري المعالجة...' : 'Processing...';
        registerBtn.innerText = processingText;
        registerBtn.disabled = true;

        fetch('register-handler.php', { 
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ event_id: <?php echo $event_id; ?> })
        })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              alert("Successfully Registered!");
              location.reload();
            } else {
              alert("Error: " + data.message);
              const registerText = (document.documentElement.lang === 'ar') ? 'تسجيل' : 'Register';
              registerBtn.innerText = registerText;
              registerBtn.disabled = false;
            }
          })
          .catch(error => {
            console.error('Error:', error);
            alert("Connection failed.");
            const registerText = (document.documentElement.lang === 'ar') ? 'تسجيل' : 'Register';
            registerBtn.innerText = registerText;
            registerBtn.disabled = false;
          });
      };
    }
  </script>
</body>

</html>