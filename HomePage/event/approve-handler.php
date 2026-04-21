<?php
/**
 * approve-handler.php
 * Updated: Saves a PERMANENT SNAPSHOT of the event data to the user.
 * This ensures the event stays in history even if the admin deletes the original event.
 */
require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php');
session_start();
header('Content-Type: application/json');

// 1. Security Check
if (
    !isset($_SESSION['role']) ||
    ($_SESSION['role'] !== 'administrator' && $_SESSION['role'] !== 'admin')
) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

// 2. Get Data
$data = json_decode(file_get_contents('php://input'), true);
$user_id = isset($data['user_id']) ? intval($data['user_id']) : 0;
$event_id = isset($data['event_id']) ? intval($data['event_id']) : 0;

if ($user_id === 0 || $event_id === 0) {
    echo json_encode(['success' => false, 'message' => 'Missing Data']);
    exit;
}

// 3. Check if already approved
// We check our new storage key 'attended_event_snapshot'
$snapshots = get_user_meta($user_id, 'attended_event_snapshot', false);
foreach ($snapshots as $snap) {
    if ($snap['id'] == $event_id) {
        echo json_encode(['success' => false, 'message' => 'Already Approved']);
        exit;
    }
}

// 4. CREATE SNAPSHOT (The Magic Step)
// We fetch the data NOW and freeze it in an array.
$event_post = get_post($event_id);
if (!$event_post) {
    echo json_encode(['success' => false, 'message' => 'Event does not exist']);
    exit;
}

$title = $event_post->post_title;
$time = get_post_meta($event_id, 'event_time', true);
$image = get_post_meta($event_id, 'event_image_url', true);
if (empty($image))
    $image = "https://via.placeholder.com/450x250?text=No+Image";

$history_data = array(
    'id' => $event_id,
    'title' => $title,
    'time' => $time,
    'image' => $image,
    'date_approved' => current_time('mysql')
);

// 5. Save the Snapshot
// We use a new key: 'attended_event_snapshot'
$result = add_user_meta($user_id, 'attended_event_snapshot', $history_data);

// Also save the simple ID to the old key just to keep 'view-attendees.php' working perfectly
add_user_meta($user_id, 'attended_event_id', $event_id);

if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database Error']);
}
?>