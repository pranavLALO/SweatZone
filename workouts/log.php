<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/api_helper.php';

// Authenticate user
$userPayload = ApiHelper::authenticate();
$authUserId = $userPayload['user_id'];

$data = json_decode(file_get_contents("php://input"), true);

// DEBUG LOGGING
file_put_contents("../debug_log.txt", date("Y-m-d H:i:s") . " - AuthID: " . ($authUserId ?? 'null') . " - Input: " . json_encode($data) . "\n", FILE_APPEND);

$user_id = $data['user_id'] ?? 0;
// Security Check: Ensure user is modifying their own data
if ($user_id != $authUserId) {
    ApiHelper::sendResponse(false, "Unauthorized: User ID mismatch", null, 403);
}

$muscle_group = $data['muscle_group'] ?? '';
$intensity = $data['intensity'] ?? 'medium';
$date = date("Y-m-d");

$duration = $data['duration'] ?? 0;
$progress = $data['progress'] ?? 0;

if ($muscle_group === '') {
    ApiHelper::sendResponse(false, "Muscle group required"); 
}

$stmt = $conn->prepare(
    "INSERT INTO user_workouts (user_id, workout_date, muscle_group, intensity, duration_seconds, progress_percentage)
     VALUES (?, ?, ?, ?, ?, ?)
     ON DUPLICATE KEY UPDATE 
     muscle_group = VALUES(muscle_group), 
     intensity = VALUES(intensity), 
     duration_seconds = IF(VALUES(duration_seconds) > duration_seconds, VALUES(duration_seconds), duration_seconds),
     progress_percentage = IF(VALUES(progress_percentage) > progress_percentage, VALUES(progress_percentage), progress_percentage)"
);

$stmt->bind_param("isssii", $user_id, $date, $muscle_group, $intensity, $duration, $progress);

if ($stmt->execute()) {
    ApiHelper::sendResponse(true, "Workout logged for " . $date);
} else {
    $error = $stmt->error ?: $conn->error;
    file_put_contents("../debug_log.txt", date("Y-m-d H:i:s") . " - LOG ERROR: " . $error . "\n", FILE_APPEND);
    ApiHelper::sendResponse(false, "Failed: " . $error, $error, 500);
}
