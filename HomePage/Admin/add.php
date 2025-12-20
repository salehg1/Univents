<?php
/**
 * add.php
 * Updated: Now correctly saves the Event Type/Category.
 */

require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php'); 

$message = "";

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_event'])) {
    
    $name = sanitize_text_field($_POST['event_name']);
    $major = sanitize_text_field($_POST['event_major']);
    $location = sanitize_text_field($_POST['event_location']);
    $time = sanitize_text_field($_POST['event_time']);
    $reg_status = intval($_POST['reg_status']); 
    
    $type = isset($_POST['event_type']) ? sanitize_text_field($_POST['event_type']) : 'events';

    $image_url = "https://via.placeholder.com/450x250?text=No+Image"; 
    
    if (!empty($_FILES['event_image']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');

        $attachment_id = media_handle_upload('event_image', 0);
        if (!is_wp_error($attachment_id)) {
            $image_url = wp_get_attachment_url($attachment_id);
        }
    }

    $post_id = wp_insert_post(array(
        'post_title'    => $name,
        'post_content'  => $location, 
        'post_status'   => 'publish',
        'post_type'     => 'post', 
        'meta_input'    => array(
            'event_major' => $major,
            'event_location' => $location,
            'event_time' => $time,
            'requires_registration' => $reg_status,
            'event_type' => $type,
            'event_image_url' => $image_url
        )
    ));

    if ($post_id) {
        echo "<script>alert('Event Added Successfully!'); window.location.href='admin.php';</script>";
        exit;
    } else {
        $message = "Error saving event.";
    }
}

$current_type = isset($_GET['type']) ? htmlspecialchars($_GET['type']) : 'events';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="add.css">
  <script src="../../Settings/lang.js" defer></script>
  <title data-translate="addEventTitle">Add New Event</title>
</head>

<body>
  <div class="container">
    <h1 data-translate="addEventTitle">Add New Event</h1>

    <?php if ($message): ?>
      <p style="color:red"><?= $message ?></p>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        
        <input type="hidden" name="event_type" value="<?php echo $current_type; ?>">

        <div class="event-image">
          <img id="preview" src="https://via.placeholder.com/450x250?text=Event+Image" alt="Event Image">
        </div>

        <input type="file" id="image-input" name="event_image" accept="image/*" hidden />
        <button type="button" class="upload-btn" id="upload-btn" data-translate="uploadImage">
          Upload Image
        </button>

        <div class="Event-section">
          <h2 data-translate="eventInfo">Event Information</h2>

          <input
            class="input-field"
            type="text"
            name="event_name"
            placeholder="Event Name"
            data-translate-placeholder="eventName"
            required
          >

          <input
            class="input-field"
            type="text"
            name="event_major"
            placeholder="Major"
            data-translate-placeholder="major"
          >

          <input
            class="input-field"
            type="text"
            name="event_location"
            placeholder="Event Location"
            data-translate-placeholder="location"
            required
          >

          <input
            class="input-field"
            type="text"
            name="event_time"
            placeholder="Event Time"
            data-translate-placeholder="time"
            required
          >
          
          <select class="input-field" name="reg_status">
              <option value="1" data-translate="requiresRegistration">
                Requires Registration (Students Only)
              </option>
              <option value="0" data-translate="openEvent">
                Open Event (No Registration)
              </option>
          </select>
        </div>

        <button type="submit" name="submit_event" id="add-btn" data-translate="add">
          Add Event
        </button>
    </form>

    <br>
    <a href="./admin.php">
      <button type="button" id="back-btn" data-translate="back">
        Go Back
      </button>
    </a>
  </div>

<script>
const uploadBtn = document.getElementById("upload-btn");
const imageInput = document.getElementById("image-input");
const preview = document.getElementById("preview");

uploadBtn.addEventListener("click", () => {
  imageInput.click();
});

imageInput.addEventListener("change", () => {
  const file = imageInput.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      preview.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }
});
</script>

</body>
</html>
