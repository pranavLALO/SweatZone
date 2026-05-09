<?php
header("Content-Type: application/json");
require __DIR__ . '/../config/db.php';

if (!isset($_GET['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Missing user_id"]);
    exit();
}

$user_id = $_GET['user_id'];
$exercise_name = isset($_GET['exercise_name']) ? $_GET['exercise_name'] : null;

// Build query based on whether we want top scores for ALL exercises or just one
if ($exercise_name) {
    // Get top 3 for specific exercise
    $sql = "SELECT id, exercise_name, score, created_at 
            FROM form_scores 
            WHERE user_id = ? AND exercise_name = ? 
            ORDER BY score DESC 
            LIMIT 3";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $user_id, $exercise_name);
} else {
    // Get top 3 for EACH exercise is harder in MySQL 5.7 without window functions
    // For simplicity, let's just return top 10 overall for the user if no exercise specified
    $sql = "SELECT id, exercise_name, score, created_at 
            FROM form_scores 
            WHERE user_id = ? 
            ORDER BY score DESC 
            LIMIT 10";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
}

$stmt->execute();
$result = $stmt->get_result();

$scores = [];
while ($row = $result->fetch_assoc()) {
    $scores[] = $row;
}

echo json_encode(["status" => "success", "data" => $scores]);

$stmt->close();
$conn->close();
?>
