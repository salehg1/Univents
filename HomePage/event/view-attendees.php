<?php
/**
 * view-attendees.php
 * Updated: Matches button styles with the rest of the project (Gradients/Rounded).
 */
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . '/wordpress/wp-load.php'); 

// 1. Security Check
if (!isset($_SESSION['role']) || 
   ($_SESSION['role'] !== 'administrator' && $_SESSION['role'] !== 'admin')) {
    die("Access Denied.");
}

$event_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$event = get_post($event_id);

if (!$event) die("Event not found.");

// Fetch Attendees
$participant_ids = get_post_meta($event_id, 'participant_id');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendees: <?php echo esc_html($event->post_title); ?></title>
    
    <script src="../../Settings/lang.js" defer></script>

    <style>
        body { font-family: "Poppins", "Segoe UI", sans-serif; background: #f5f6fa; padding: 40px; }
        .container { max-width: 1100px; margin: 0 auto; background: white; padding: 40px; border-radius: 20px; box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08); }
        
        h1 { color: #2c3e50; border-bottom: 2px solid #4CAF50; padding-bottom: 10px; display: inline-block; margin: 0; }
        .header-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        
        /* Table Styles */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; border-radius: 10px; overflow: hidden; }
        th, td { padding: 15px 20px; text-align: left; border-bottom: 1px solid #eee; }
        th { background-color: #f9f9f9; color: #2c3e50; font-weight: 600; text-transform: uppercase; font-size: 0.9rem; }
        tr:hover { background-color: #f1f1f1; transition: 0.2s; }
        
        /* STATUS BADGES */
        .status-badge { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; letter-spacing: 0.5px; }
        .status-pending { background: #f39c12; color: white; }
        .status-approved { background: #27ae60; color: white; }

        /* === NEW BUTTON STYLES (MATCHING YOUR PROJECT) === */
        
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
        }

        /* Print Button (Blue Gradient) */
        .btn-print {
            background: linear-gradient(135deg, #3498db, #2980b9);
        }
        .btn-print:hover {
            background: linear-gradient(135deg, #2980b9, #3498db);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
        }

        /* Go Back Button (Red Gradient) */
        .btn-back-custom {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            margin-top: 20px;
        }
        .btn-back-custom:hover {
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(231, 76, 60, 0.4);
        }

        /* Approve Button (Green Gradient - Small) */
        .btn-approve {
            background: linear-gradient(135deg, #4CAF50, #2ecc71);
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            border: none;
            color: white;
            cursor: pointer;
            box-shadow: 0 3px 8px rgba(46, 204, 113, 0.2);
            transition: all 0.3s ease;
        }
        .btn-approve:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(46, 204, 113, 0.4);
        }
        .btn-approve:disabled {
            background: #95a5a6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

    </style>
</head>
<body>

<div class="container">
    <div class="header-row">
        <div>
            <h1 data-translate="attendeesList">Attendees List</h1>
            <p><span data-translate="event">Event</span>: <strong><?php echo esc_html($event->post_title); ?></strong></p>
        </div>
        <button class="std-btn btn-print" onclick="window.print()" data-translate="printList">Print List</button>
    </div>

    <?php if (empty($participant_ids)): ?>
        <p style="text-align:center; color:#777; font-size: 1.1em; margin: 40px 0;" data-translate="noRegistrations">
            No registrations yet.
        </p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th data-translate="studentName">Student Name</th>
                    <th data-translate="studentId">Student ID</th>
                    <th data-translate="status">Status</th> 
                    <th data-translate="action">Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php 
                $count = 1;
                foreach ($participant_ids as $user_id): 
                    $user_info = get_userdata($user_id);
                    $student_id_meta = get_user_meta($user_id, 'student_id', true);
                    $display_name = $user_info ? $user_info->display_name : 'Unknown';
                    $sid_display = !empty($student_id_meta) ? $student_id_meta : ($user_info ? $user_info->user_login : '-');

                    // CHECK IF ALREADY APPROVED
                    $attended_events = get_user_meta($user_id, 'attended_event_id');
                    $is_approved = in_array($event_id, $attended_events);
                ?>
                <tr id="row-<?php echo $user_id; ?>">
                    <td><?php echo $count++; ?></td>
                    <td><?php echo esc_html($display_name); ?></td>
                    <td><?php echo esc_html($sid_display); ?></td>
                    
                    <td id="status-<?php echo $user_id; ?>">
                        <?php if($is_approved): ?>
                            <span class="status-badge status-approved" data-translate="attended">Attended</span>
                        <?php else: ?>
                            <span class="status-badge status-pending" data-translate="pending">Pending</span>
                        <?php endif; ?>
                    </td>

                    <td id="action-<?php echo $user_id; ?>">
                        <?php if($is_approved): ?>
                            <span style="color: #27ae60; font-weight: bold;" data-translate="verified">✔ Verified</span>
                        <?php else: ?>
                            <button class="btn-approve" onclick="approveStudent(<?php echo $user_id; ?>, <?php echo $event_id; ?>)" data-translate="approveAttendance">
                                Approve Attendance
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <br>
    <a href="event-card.php?id=<?php echo $event_id; ?>" class="std-btn btn-back-custom" data-translate="back">Go Back</a>
</div>

<script>
function approveStudent(userId, eventId) {
    const btn = document.querySelector(`#row-${userId} .btn-approve`);
    if(btn) {
        // Simple translation check for 'Saving...'
        const savingText = (document.documentElement.lang === 'ar') ? 'جاري الحفظ...' : 'Saving...';
        btn.innerText = savingText;
        btn.disabled = true;
    }

    fetch('approve-handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: userId, event_id: eventId })
    })
    .then(res => res.json())
    .then(data => {
        if(data.success) {
            // Update UI without refreshing
            const attendedText = (document.documentElement.lang === 'ar') ? 'حضر' : 'Attended';
            const verifiedText = (document.documentElement.lang === 'ar') ? '✔ تم التحقق' : '✔ Verified';

            document.getElementById(`status-${userId}`).innerHTML = `<span class="status-badge status-approved">${attendedText}</span>`;
            document.getElementById(`action-${userId}`).innerHTML = `<span style="color: #27ae60; font-weight: bold;">${verifiedText}</span>`;
        } else {
            alert("Error: " + data.message);
            if(btn) { 
                const approveText = (document.documentElement.lang === 'ar') ? 'تأكيد الحضور' : 'Approve Attendance';
                btn.innerText = approveText; 
                btn.disabled = false; 
            }
        }
    })
    .catch(err => {
        console.error(err);
        alert("Connection Failed");
        if(btn) { 
            const approveText = (document.documentElement.lang === 'ar') ? 'تأكيد الحضور' : 'Approve Attendance';
            btn.innerText = approveText; 
            btn.disabled = false; 
        }
    });
}
</script>

</body>
</html>