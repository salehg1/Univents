<?php
/**
 * StudentHomepage.php
 * Displays events fetched from the WordPress Database for Students.
 */

// 1. Connect to WordPress (Using Setup 2 path)
require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php'); 

// 2. Helper function to fetch events (Same as Admin)
function get_events_by_type($type_slug) {
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => -1, 
        'meta_query'     => array(
            array(
                'key'     => 'event_type',
                'value'   => $type_slug,
                'compare' => '='
            )
        )
    );
    
    // Handle generic events category
    if($type_slug === 'events') {
        $args['meta_query']['relation'] = 'OR';
        $args['meta_query'][] = array(
             'key'     => 'event_type',
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
            
            if(!$image) $image = "https://via.placeholder.com/450x250?text=No+Image";

            $events[] = array(
                'id'    => $id,
                'name'  => get_the_title(),
                'time'  => $time,
                'image' => $image
            );
        }
        wp_reset_postdata();
    }
    return $events;
}

// 3. Fetch data for all sections
$events_list      = get_events_by_type('events');
$activities_list  = get_events_by_type('activities');
$clubs_list       = get_events_by_type('studentClubs');
$colleges_list    = get_events_by_type('colleges');
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Univents</title>

    <link rel="stylesheet" href="StudentHomepage.css" />

    <script>
        window.dbData = {
            'events':       <?php echo json_encode($events_list); ?>,
            'activities':   <?php echo json_encode($activities_list); ?>,
            'studentClubs': <?php echo json_encode($clubs_list); ?>,
            'colleges':     <?php echo json_encode($colleges_list); ?>
        };
    </script>

    <script src="StudentHomepage.js" defer></script>
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
            <button id="profile-btn" data-translate="settings">Settings</button>
        </a>
    </div>

    <div class="Notificaion-container">
        <button class="arrow left" onclick="prevSlide()">🡰</button>
        <div class="Notificaion-slide">
            <div class="slide active">
                <a href="../Notificaion/Notificaion.html"><img src="../Notificaion/Notification1.png" alt="Notification 1" /></a>
            </div>
            <div class="slide">
                <a href="../Notificaion/Notificaion.html"><img src="../Notificaion/Notification1.png" alt="Notification 1" /></a>
            </div>
            <div class="slide">
                <a href="../Notificaion/Notificaion.html"><img src="../Notificaion/Notification1.png" alt="Notification 1" /></a>
            </div>
        </div>
        <button class="arrow right" onclick="nextSlide()">🡲</button>
    </div>

    <div class="container">
        <div class="section"><span>Events Section</span></div>
        <div class="events-wrapper">
            <button class="slider-arrow event-right" id="evRight">🡲</button>
            <div class="events-container" id="eventsContainer"></div>
            <button class="slider-arrow event-left" id="evLeft">🡰</button>
        </div>
    </div>

    <div class="section"><span>Sports Activities Section</span></div>
    <div class="activities-wrapper">
        <button class="slider-arrow event-right" id="actRight">🡲</button>
        <div class="Activities-container" id="activitiesSlider"></div>
        <button class="slider-arrow event-left" id="actLeft">🡰</button>
    </div>

    <div class="section"><span>Student Clubs Section</span></div>
    <div class="student-wrapper">
        <button class="slider-arrow event-right" id="stuRight">🡲</button>
        <div class="Student-container" id="studentSlider"></div>
        <button class="slider-arrow event-left" id="stuLeft">🡰</button>
    </div>

    <div class="section"><span>Colleges Categories Event Section</span></div>
    <div class="colleges-wrapper">
        <button class="slider-arrow event-right" id="colRight">🡲</button>
        <div class="Colleg-container" id="collegesSlider"></div>
        <button class="slider-arrow event-left" id="colLeft">🡰</button>
    </div>

    <footer>
        <p data-translate="footer">&copy; FS WebDev Univents</p>
    </footer>

</body>
</html>