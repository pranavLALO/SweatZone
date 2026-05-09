<?php
header("Content-Type: application/json");
require __DIR__ . '/../config/db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['user_id']) || !isset($data['exercise_name']) || !isset($data['score'])) {
    echo json_encode(["status" => "error", "message" => "Missing required fields"]);
    exit();
}

$user_id = $data['user_id'];
$exercise_name = $data['exercise_name'];
$score = $data['score'];
$metrics_json = isset($data['metrics_json']) ? $data['metrics_json'] : null;

$stmt = $conn->prepare("INSERT INTO form_scores (user_id, exercise_name, score, metrics_json) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isis", $user_id, $exercise_name, $score, $metrics_json);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Score saved successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Database error: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
