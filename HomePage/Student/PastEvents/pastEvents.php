<?php
/**
 * PastEvents.php
 * Updated: Reads from the "Snapshot" data so deleted events still appear.
 */
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php');

// 1. Auth Check
$user_id = 0;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} elseif (is_user_logged_in()) {
    $user_id = get_current_user_id();
}

if ($user_id === 0) {
    header("Location: ../../Entry/LogIn/login.php");
    exit;
}

// 2. Fetch History Snapshots
// This returns an array of arrays (Title, Time, Image are already inside!)
$history_list = get_user_meta($user_id, 'attended_event_snapshot', false);

// Reverse to show newest first
$history_list = array_reverse($history_list);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <link rel="stylesheet" href="PastEvents.css">
    <script src="../main_settings/Settings.js"></script>
    <script src="../../Settings/lang.js" defer></script>

    <style>
        .pastEventContainer {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .event-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 300px;
            overflow: hidden;
            transition: transform 0.3s ease;
            cursor: default;
            /* Changed cursor since clicking might lead to a 404 if deleted */
            text-align: center;
            padding-bottom: 15px;
        }

        .event-card:hover {
            transform: translateY(-5px);
        }

        .event-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .desc {
            margin: 10px 0;
            padding: 0 15px;
        }

        .title {
            font-weight: bold;
            font-size: 1.1rem;
            color: #2c3e50;
        }

        .date {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .empty-message {
            text-align: center;
            font-size: 1.2rem;
            color: #777;
            margin-top: 50px;
            width: 100%;
        }

        /* Tag for deleted events */
        .archived-tag {
            font-size: 0.7rem;
            color: #999;
            display: block;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <h1 style="text-align:center; margin-top:30px; color:#2c3e50;" data-translate="historyTitle">My Event History</h1>

    <div class="pastEventContainer">

        <?php if (empty($history_list)): ?>

            <div class="empty-message">
                <p data-translate="noHistory">You haven't attended any events yet.</p>
                <p style="font-size:0.9rem;" data-translate="adminApprovalNote">(Attendance must be approved by an Admin)
                </p>
            </div>

        <?php else: ?>

            <?php foreach ($history_list as $event):
                // We use the data directly from the user meta array
                $image_url = $event['image'];
                $title = $event['title'];
                $time = $event['time'];
                ?>
                <div class="event-card">
                    <img src="<?php echo esc_url($image_url); ?>" alt="Event Image">
                    <p class="desc title"><?php echo esc_html($title); ?></p>
                    <p class="desc date"><?php echo esc_html($time); ?></p>

                    <span style="color:green; font-size:0.8rem; font-weight:bold;">✔ Attended</span>
                </div>

            <?php endforeach; ?>

        <?php endif; ?>

    </div>

    <div class="back-button-container">
        <button type="button" class="back-button" data-translate="back" onclick="history.back();">
            Go Back
        </button>
    </div>

</body>

</html>