<?php
/**
 * Homepage.php
 * The Visitor View: Shows real events from the DB, but with Login buttons.
 */

// 1. Connect to WordPress
// Adjust path if needed based on your folder structure
require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php');

// 2. Helper function to fetch events (Standardized across your site)
function get_events_by_type($type_slug)
{
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'meta_query' => array(
      array(
        'key' => 'event_type',
        'value' => $type_slug,
        'compare' => '='
      )
    )
  );

  // Handle generic events category
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

      $image = get_post_meta($id, 'event_image_url', true);
      $time = get_post_meta($id, 'event_time', true);

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

// 3. Fetch data for all sections
$events_list = get_events_by_type('events');
$activities_list = get_events_by_type('activities');
$clubs_list = get_events_by_type('studentClubs');
$colleges_list = get_events_by_type('colleges');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Univents</title>
  <link rel="stylesheet" href="Homepage.css" />
  <script src="Homepage.js" defer></script>
  <script src="../../Settings/lang.js" defer></script>

  <script>
    window.dbData = {
      'events': <?php echo json_encode($events_list); ?>,
      'activities': <?php echo json_encode($activities_list); ?>,
      'studentClubs': <?php echo json_encode($clubs_list); ?>,
      'colleges': <?php echo json_encode($colleges_list); ?>
    };
  </script>
</head>

<body>

  <div class="navbar">
    <a href="https://www.taibahu.edu.sa/" target="_blank">
      <img src="../Assets/taibah_logo.png" class="logo" alt="شعار طيبة" />
    </a>

    <a href="../About/About.html" target="_blank">
      <button id="about-btn" data-translate="about">About</button>
    </a>

    <button id="lang" onclick="toggleLanguage()" data-translate="language">Change Language</button>

    <div class="openModalBtn-Wrapper">
      <button onclick="openLoginModal()" class="Btn">
        <div class="sign">
          <svg viewBox="0 0 512 512">
            <path
              d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z">
            </path>
          </svg>
        </div>
        <div class="text" data-translate="signUp">Log in</div>
      </button>
    </div>
  </div>

  <div class="Notificaion-container">
    <button class="arrow left" onclick="prevSlide()">🡰</button>

    <div class="Notificaion-slide">
      <div class="slide active">
        <a href="../Notificaion/Notificaion.html">
          <img src="../Notificaion/Notification1.png" alt="Notification 1" />
        </a>
      </div>
      <div class="slide">
        <a href="../Notificaion/Notificaion.html">
          <img src="../Notificaion/Notification1.png" alt="Notification 1" />
        </a>
      </div>
      <div class="slide">
        <a href="../Notificaion/Notificaion.html">
          <img src="../Notificaion/Notification1.png" alt="Notification 1" />
        </a>
      </div>
    </div>

    <button class="arrow right" onclick="nextSlide()">🡲</button>
  </div>

  <div class="container">
    <div class="section">
      <span>Events Section</span>
    </div>
    <div class="events-wrapper">
      <button class="slider-arrow event-right" id="evRight">🡲</button>
      <div class="events-container" id="eventsContainer"></div>
      <button class="slider-arrow event-left" id="evLeft">🡰</button>
    </div>
  </div>

  <div class="section">
    <span>Sports Activities Section</span>
  </div>
  <div class="activities-wrapper">
    <button class="slider-arrow event-right" id="actRight">🡲</button>
    <div class="Activities-container" id="activitiesSlider"></div>
    <button class="slider-arrow event-left" id="actLeft">🡰</button>
  </div>

  <div class="section">
    <span>Student Clubs Section</span>
  </div>
  <div class="student-wrapper">
    <button class="slider-arrow event-right" id="stuRight">🡲</button>
    <div class="Student-container" id="studentSlider"></div>
    <button class="slider-arrow event-left" id="stuLeft">🡰</button>
  </div>

  <div class="section">
    <span>Colleges Categories Event Section</span>
  </div>
  <div class="colleges-wrapper">
    <button class="slider-arrow event-right" id="colRight">🡲</button>
    <div class="Colleg-container" id="collegesSlider"></div>
    <button class="slider-arrow event-left" id="colLeft">🡰</button>
  </div>

  <footer>
    <p data-translate="footer">&copy; FS WebDev Univents</p>
  </footer>

  <div id="loginModalOverlay" style="
      position: fixed;
      top: 0; 
      left: 0;
      width: 100%; 
      height: 100%;
      background-color: rgba(0, 0, 0, 0.699);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 9999;">
    <iframe src="../../Entry/LogIn/login.php" style="width: 450px; height: 700px; border-radius: 15px; border: none;">
    </iframe>
  </div>

  <script>
    function createSlider(typeKey, containerId, leftBtnId, rightBtnId) {
      // FIX: Use window.dbData passed from PHP
      let list = window.dbData[typeKey] || [];
      let index = 0;

      const container = document.getElementById(containerId);
      const leftBtn = document.getElementById(leftBtnId);
      const rightBtn = document.getElementById(rightBtnId);

      if (!container) return;

      function render() {
        container.innerHTML = "";

        // Handle empty state
        if (list.length === 0) {
          container.innerHTML = "<p style='width:100%; text-align:center; color:gray;'>No events available.</p>";
          return;
        }

        let slice = list.slice(index, index + 3);

        slice.forEach(event => {
          const card = document.createElement("div");
          // Keep original CSS classes
          card.className = "event";

          card.innerHTML = `
            <img src="${event.image}" alt="${event.name}">
            <p class="desc title">${event.name}</p>
            <p class="desc date">${event.time}</p>
          `;

          // Link to Event Card (Visitors can view, but card handles the "No Access" logic)
          card.onclick = () => {
            // We'll update event-card.php next to handle visitors
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

    // Initialize
    createSlider("events", "eventsContainer", "evLeft", "evRight");
    createSlider("activities", "activitiesSlider", "actLeft", "actRight");
    createSlider("studentClubs", "studentSlider", "stuLeft", "stuRight");
    createSlider("colleges", "collegesSlider", "colLeft", "colRight");

    // Modal Logic (kept from your original)
    function openLoginModal() {
      document.getElementById("loginModalOverlay").style.display = "flex";
    }
    // Make closeLoginModal globally accessible so the iframe can call it
    window.closeLoginModal = function () {
      document.getElementById("loginModalOverlay").style.display = "none";
    }

    // Close on background click
    document.getElementById("loginModalOverlay").addEventListener("click", function (e) {
      if (e.target === this) {
        closeLoginModal();
      }
    });
  </script>
</body>

</html>