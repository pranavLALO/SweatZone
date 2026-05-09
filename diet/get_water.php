<?php
header("Content-Type: application/json");
require "../config/db.php";

$user_id = $_GET['user_id'] ?? 0;

if ($user_id == 0) {
    echo json_encode(["status" => false, "message" => "User ID required"]);
    exit;
}

$today = date("Y-m-d");

$stmt = $conn->prepare("SELECT glasses FROM water_logs WHERE user_id = ? AND log_date = ?");
$stmt->bind_param("is", $user_id, $today);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$glasses = $row ? (int)$row['glasses'] : 0;

echo json_encode([
    "status" => true,
    "date" => $today,
    "glasses" => $glasses
]);
?>
