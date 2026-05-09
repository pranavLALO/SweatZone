<?php
header("Content-Type: application/json");
require "../config/db.php";

$data = json_decode(file_get_contents("php://input"), true);
$user_id = isset($data['user_id']) ? (int)$data['user_id'] : 0;
$action = isset($data['action']) ? $data['action'] : 'add';

if ($user_id == 0) {
    echo json_encode(["status" => false, "message" => "User ID required"]);
    exit;
}

$today = date("Y-m-d");

// Ensure record exists
$checkStmt = $conn->prepare("SELECT glasses FROM water_logs WHERE user_id = ? AND log_date = ?");
$checkStmt->bind_param("is", $user_id, $today);
$checkStmt->execute();
$result = $checkStmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    $insertStmt = $conn->prepare("INSERT INTO water_logs (user_id, log_date, glasses) VALUES (?, ?, 0)");
    $insertStmt->bind_param("is", $user_id, $today);
    $insertStmt->execute();
    $current_glasses = 0;
} else {
    $current_glasses = (int)$row['glasses'];
}

if ($action === 'add') {
    $new_glasses = $current_glasses + 1;
} else {
    $new_glasses = max(0, $current_glasses - 1);
}

$updateStmt = $conn->prepare("UPDATE water_logs SET glasses = ? WHERE user_id = ? AND log_date = ?");
$updateStmt->bind_param("iis", $new_glasses, $user_id, $today);

if ($updateStmt->execute()) {
    echo json_encode(["status" => true, "glasses" => $new_glasses]);
} else {
    echo json_encode(["status" => false, "message" => "Failed to update water log"]);
}
?>
