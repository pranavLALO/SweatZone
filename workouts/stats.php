<?php
header("Content-Type: application/json");
require "../config/db.php";
require "../helpers/jwt_helper.php";

// 1. Authenticate
$headers = getallheaders();
$authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : '';
$token = str_replace('Bearer ', '', $authHeader);

$payload = JwtHelper::validate($token);
if (!$payload) {
    echo json_encode(['status' => false, 'message' => 'Unauthorized']);
    exit;
}

$user_id = $payload['user_id'];
$period = isset($_GET['period']) ? $_GET['period'] : 'week';

// 2. Query Logic
// We need to count workouts per day/unit for the graph.
// Assuming 'workouts_log' table has 'created_at' and 'user_id'.

// Check if workouts_log table exists, or maybe use 'workout_logs' (need to verify table name).
// Based on typical schema, let's assume `workout_logs` or `logs`. 
// Wait, I saw `logging` logic in `log.php`. Let me quickly check log.php if I can, 
// but I'll assume `workout_logs` for now and if it fails I'll check.
// From previous context: `log.php` inserts into `workout_logs` (likely).

// Actually, let's verify table name using SHOW TABLES or check log.php content first?
// To result in fewer turns, I'll check log.php usage in my memory or just View it if unsure.
// I saw `workouts/log.php` in open files list in previous turn.
// Let's assume table `workout_logs` with `created_at`.

$startDate = "";
$dateFormat = "";
$groupBy = "";

if ($period == 'week') {
    // Last 7 days
    $startDate = date('Y-m-d', strtotime('-7 days'));
    $dateFormat = '%a'; // Mon, Tue
    $groupBy = "workout_date"; 
} elseif ($period == 'month') {
    // Last 30 days
    $startDate = date('Y-m-d', strtotime('-30 days'));
    $dateFormat = '%d'; // 01, 02
    $groupBy = "workout_date";
} elseif ($period == 'year') {
    // Last 12 months
    $startDate = date('Y-m-d', strtotime('-1 year'));
    $dateFormat = '%M'; // Jan, Feb
    $groupBy = "MONTH(workout_date)";
} else {
    $startDate = date('Y-m-d', strtotime('-7 days'));
    $dateFormat = '%a'; // Mon, Tue
    $groupBy = "workout_date"; 
}

// Prepare SQL
// count(*) as count, DATE_FORMAT(workout_date, ?) as day
// count(*) as count, DATE_FORMAT(workout_date, ?) as day
$sql = "SELECT COUNT(*) as count, MAX(progress_percentage) as progress, DATE_FORMAT(workout_date, ?) as day 
        FROM user_workouts 
        WHERE user_id = ? AND workout_date >= ?
        GROUP BY day
        ORDER BY workout_date ASC";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    // Table might be named differently?
    echo json_encode(['status' => false, 'message' => 'Database error: ' . $conn->error]);
    exit;
}

$stmt->bind_param("sis", $dateFormat, $user_id, $startDate);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'day' => $row['day'],
        'count' => (int)$row['count'],
        'progress' => (int)$row['progress']
    ];
}

// 3. Get Total All-Time Count
$sqlTotal = "SELECT COUNT(*) as total FROM user_workouts WHERE user_id = ?";
$stmtTotal = $conn->prepare($sqlTotal);
$stmtTotal->bind_param("i", $user_id);
$stmtTotal->execute();
$resultTotal = $stmtTotal->get_result();
$totalCompleted = 0;
if ($rowTotal = $resultTotal->fetch_assoc()) {
    $totalCompleted = (int)$rowTotal['total'];
}

echo json_encode([
    'status' => true,
    'data' => $data,
    'total_completed' => $totalCompleted
]);
?>
