<?php
header("Content-Type: application/json");
require "../config/db.php";

$user_id = $_GET['user_id'] ?? 0;

if ($user_id == 0) {
    echo json_encode(["status" => false, "message" => "User ID required"]);
    exit;
}

$today = date("Y-m-d");
$seven_days_ago = date("Y-m-d", strtotime("-6 days"));

// 1. Workouts
$workStmt = $conn->prepare("
    SELECT 
        COUNT(id) as total_workouts,
        SUM(weight_kg) as total_volume,
        SUM(duration_seconds) as total_time
    FROM user_workouts 
    WHERE user_id = ? AND workout_date BETWEEN ? AND ?
");
$workStmt->bind_param("iss", $user_id, $seven_days_ago, $today);
$workStmt->execute();
$workRes = $workStmt->get_result()->fetch_assoc();

// 2. Diet
$dietStmt = $conn->prepare("
    SELECT AVG(total_calories) as avg_calories 
    FROM diet_plans 
    WHERE user_id = ? AND plan_date BETWEEN ? AND ? AND total_calories > 0
");
$dietStmt->bind_param("iss", $user_id, $seven_days_ago, $today);
$dietStmt->execute();
$dietRes = $dietStmt->get_result()->fetch_assoc();

// 3. Water
$waterStmt = $conn->prepare("
    SELECT SUM(glasses) as total_water 
    FROM water_logs 
    WHERE user_id = ? AND log_date BETWEEN ? AND ?
");
$waterStmt->bind_param("iss", $user_id, $seven_days_ago, $today);
$waterStmt->execute();
$waterRes = $waterStmt->get_result()->fetch_assoc();

echo json_encode([
    "status" => true,
    "total_workouts" => (int)$workRes['total_workouts'],
    "total_volume" => (int)$workRes['total_volume'],
    "total_time" => (int)$workRes['total_time'],
    "avg_calories" => (int)$dietRes['avg_calories'],
    "total_water" => (int)$waterRes['total_water']
]);
?>
