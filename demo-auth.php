<?php
session_start();

$role = $_GET['role'] ?? 'visitor';

if ($role === 'admin') {
    $_SESSION['Id']       = 1;
    $_SESSION['user_id']  = 1;
    $_SESSION['role']     = 'administrator';
} elseif ($role === 'student') {
    $_SESSION['Id']       = 1;
    $_SESSION['user_id']  = 1;
    $_SESSION['role']     = 'subscriber';
} else {
    unset($_SESSION['Id'], $_SESSION['user_id'], $_SESSION['role']);
}

$_SESSION['is_demo'] = true;

header('Content-Type: application/json');
echo json_encode(['success' => true, 'role' => $role]);
