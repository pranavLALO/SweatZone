<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/api_helper.php';

// Authenticate user
$userPayload = ApiHelper::authenticate();
$userId = $userPayload['user_id'];

// Fetch the 20 most recent workouts
$stmt = $conn->prepare("SELECT id, muscle_group, intensity, duration_seconds, weight_kg, completed_sets, completed_reps, completed_at FROM user_workouts WHERE user_id = ? ORDER BY completed_at DESC LIMIT 20");
$stmt->bind_param("i", $userId);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $history = [];
    while ($row = $result->fetch_assoc()) {
        $history[] = [
            "id" => $row['id'],
            "muscle_group" => $row['muscle_group'],
            "intensity" => $row['intensity'],
            "duration_seconds" => $row['duration_seconds'],
            "weight_kg" => $row['weight_kg'],
            "completed_sets" => $row['completed_sets'],
            "completed_reps" => $row['completed_reps'],
            "completed_at" => $row['completed_at']
        ];
    }
    ApiHelper::sendResponse(true, "History retrieved", $history);
} else {
    ApiHelper::sendResponse(false, "Failed to retrieve history", null, 500);
}
?>
