<?php
/**
 * register-handler.php
 * This script handles the database logic when "Register" is clicked.
 */

// 1. CONNECT TO WORDPRESS
// (We use the same path setup that worked for your login/add pages)
require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php'); 

session_start();
header('Content-Type: application/json');

// 2. SECURITY CHECKS
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit;
}

// 3. GET DATA FROM THE BUTTON
$data = json_decode(file_get_contents('php://input'), true);
$event_id = isset($data['event_id']) ? intval($data['event_id']) : 0;
$user_id = $_SESSION['user_id'];

if ($event_id === 0) {
    echo json_encode(['success' => false, 'message' => 'Invalid Event ID']);
    exit;
}

// 4. CHECK IF ALREADY REGISTERED
// Get the list of people already coming to this event
$participants = get_post_meta($event_id, 'participant_id'); 

if (in_array($user_id, $participants)) {
    echo json_encode(['success' => false, 'message' => 'You are already registered!']);
    exit;
}

// 5. SAVE TO DATABASE
// add_post_meta allows multiple people to be saved under the same key 'participant_id'
$result = add_post_meta($event_id, 'participant_id', $user_id);

if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Database error']);
}
?>