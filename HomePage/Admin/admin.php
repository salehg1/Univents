<?php
/**
 * admin.php
 * Displays the dashboard with events fetched from the WordPress Database.
 */

// 1. Connect to WordPress
// Using the path based on your previous success (Setup 2)
require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php');

// 2. Helper function to fetch events by type
function get_events_by_type($type_slug)
{
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => -1, // Get all events
    'meta_query' => array(
      array(
        'key' => 'event_type',
        'value' => $type_slug,
        'compare' => '='
      )
    )
  );

  // If getting general events, also include posts with NO type defined (backward compatibility)
  if ($type_slug === 'events') {
    $args['meta_query']['relation'] = 'OR';
    $args['meta_query'][] = array(
      'key' => 'event_type',
      'compare' => 'NOT EXISTS'
    );
  }

  $query = new WP_Query($args);
  $events = [];

  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post();
      $id = get_the_ID();

      // Get Meta Data
      $image = get_post_meta($id, 'event_image_url', true);
      $time = get_post_meta($id, 'event_time', true);

      // Fallback for image
      if (!$image)
        $image = "https://via.placeholder.com/450x250?text=No+Image";

      $events[] = array(
        'id' => $id,
        'name' => get_the_title(),
        'time' => $time,
        'image' => $image
      );
    }
    wp_reset_postdata();
  }
  return $events;
}

// 3. Fetch data for all 4 sections
$events_list = get_events_by_type('events');
$activities_list = get_events_by_type('activities');
$clubs_list = get_events_by_type('studentClubs');
$colleges_list = get_events_by_type('colleges');
?>

<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Univents Admin</title>
  <link rel="stylesheet" href="../Visitors/Homepage.css" />
  <script src="../../Settings/lang.js" defer></script>
</head>

<body>

  <div class="navbar">
    <a href="https://www.taibahu.edu.sa/" target="_blank">
      <img src="../Assets/taibah_logo.png" class="logo" alt="شعار طيبة" />
    </a>

    <a href="../About/About.html" target="_blank">
      <button id="about-btn" data-translate="about">About</button>
    </a>

    <a href="../../Settings/main_settings/Settings.php">
      <button id="profile-btn" data-translate="settings">settings</button>
    </a>
  </div>

  <div class="Notificaion-container">
    <button class="arrow left" onclick="prevSlide()">🡰</button>
    <div class="Notificaion-slide">
      <div class="slide active">
        <a href="../Notificaion/Notificaion.html"><img src="../Notificaion/Notification1.png"
            alt="Notification 1" /></a>
      </div>
      <div class="slide">
        <a href="../Notificaion/Notificaion.html"><img src="../Notificaion/Notification1.png"
            alt="Notification 1" /></a>
      </div>
      <div class="slide">
        <a href="../Notificaion/Notificaion.html"><img src="../Notificaion/Notification1.png"
            alt="Notification 1" /></a>
      </div>
    </div>
    <button class="arrow right" onclick="nextSlide()">🡲</button>
  </div>

  <div class="container">
    <div class="section">
      <span>Events Section</span>
      <button class="add" onclick="window.location.href='add.php?type=events'">Add</button>
    </div>
    <div class="events-wrapper">
      <button class="slider-arrow event-right" id="evRight">🡲</button>
      <div class="events-container" id="eventsContainer"></div>
      <button class="slider-arrow event-left" id="evLeft">🡰</button>
    </div>
  </div>

  <div class="section">
    <span>Sports Activities Section</span>
    <button class="add" onclick="window.location.href='add.php?type=activities'">Add</button>
  </div>
  <div class="activities-wrapper">
    <button class="slider-arrow event-right" id="actRight">🡲</button>
    <div class="Activities-container" id="activitiesSlider"></div>
    <button class="slider-arrow event-left" id="actLeft">🡰</button>
  </div>

  <div class="section">
    <span>Student Clubs Section</span>
    <button class="add" onclick="window.location.href='add.php?type=studentClubs'">Add</button>
  </div>
  <div class="student-wrapper">
    <button class="slider-arrow event-right" id="stuRight">🡲</button>
    <div class="Student-container" id="studentSlider"></div>
    <button class="slider-arrow event-left" id="stuLeft">🡰</button>
  </div>

  <div class="section">
    <span>Colleges Categories Event Section</span>
    <button class="add" onclick="window.location.href='add.php?type=colleges'">Add</button>
  </div>
  <div class="colleges-wrapper">
    <button class="slider-arrow event-right" id="colRight">🡲</button>
    <div class="Colleg-container" id="collegesSlider"></div>
    <button class="slider-arrow event-left" id="colLeft">🡰</button>
  </div>

  <footer>
    <p data-translate="footer">&copy; FS WebDev Univents</p>
  </footer>

  <script>
    // ----------------------------------------------------
    // STEP 1: Pass PHP Data to JavaScript
    // ----------------------------------------------------
    const dbData = {
      'events': <?php echo json_encode($events_list); ?>,
      'activities': <?php echo json_encode($activities_list); ?>,
      'studentClubs': <?php echo json_encode($clubs_list); ?>,
      'colleges': <?php echo json_encode($colleges_list); ?>
    };

    // ----------------------------------------------------
    // STEP 2: The Slider Logic (Updated to use dbData)
    // ----------------------------------------------------
    function createSlider(typeKey, containerId, leftBtnId, rightBtnId) {

      // Look up data from the PHP object instead of LocalStorage
      let list = dbData[typeKey] || [];
      let index = 0;

      const container = document.getElementById(containerId);
      const leftBtn = document.getElementById(leftBtnId);
      const rightBtn = document.getElementById(rightBtnId);

      if (!container) return;

      function render() {
        container.innerHTML = "";

        // Show 3 items at a time
        let slice = list.slice(index, index + 3);

        if (slice.length === 0) {
          container.innerHTML = "<p style='width:100%; text-align:center; color:gray;'>No events found.</p>";
          return;
        }

        slice.forEach(event => {
          const card = document.createElement("div");

          // Assign class based on type (keeping your original CSS structure)
          if (typeKey === "events") card.className = "event";
          else if (typeKey === "activities") card.className = "Activities";
          else if (typeKey === "studentClubs") card.className = "Student";
          else if (typeKey === "colleges") card.className = "Colleg";
          else card.className = "event"; // default

          // Card HTML
          card.innerHTML = `
            <img src="${event.image}" alt="${event.name}">
            <p class="desc title">${event.name}</p>
            <p class="desc date">${event.time}</p>
          `;

          // Click to navigate (Updated path to use ID)
          card.onclick = () => {
            // We pass typeKey just in case, though ID is unique in DB
            window.location.href = `../event/event-card.php?id=${event.id}&type=${typeKey}`;
          };

          container.appendChild(card);
        });
      }

      rightBtn.addEventListener("click", () => {
        if (index + 3 < list.length) {
          index++;
          render();
        }
      });

      leftBtn.addEventListener("click", () => {
        if (index > 0) {
          index--;
          render();
        }
      });

      render();
    }

    // Initialize Sliders
    createSlider("events", "eventsContainer", "evLeft", "evRight");
    createSlider("activities", "activitiesSlider", "actLeft", "actRight");
    createSlider("studentClubs", "studentSlider", "stuLeft", "stuRight");
    createSlider("colleges", "collegesSlider", "colLeft", "colRight");

    // Notification Slider Logic (Kept from your original)
    // (You didn't include the JS for this in the snippet, but here is basic logic if needed)
    let slideIndex = 0;
    const slides = document.querySelectorAll(".slide");
    function showSlides(n) {
      if (n >= slides.length) slideIndex = 0;
      if (n < 0) slideIndex = slides.length - 1;
      slides.forEach(s => s.classList.remove("active"));
      if (slides[slideIndex]) slides[slideIndex].classList.add("active");
    }
    window.nextSlide = function () { slideIndex++; showSlides(slideIndex); }
    window.prevSlide = function () { slideIndex--; showSlides(slideIndex); }

  </script>

</body>

</html>