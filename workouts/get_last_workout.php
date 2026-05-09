<?php
/**
 * workouts/get_last_workout.php
 * Fetches the most recent workout for a given muscle group to provide performance comparisons.
 */
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/api_helper.php';

// Authenticate user
$userPayload = ApiHelper::authenticate();
$authUserId = $userPayload['user_id'];

$muscleGroup = $_GET['muscle_group'] ?? '';

if ($muscleGroup === '') {
    ApiHelper::sendResponse(false, "Muscle group required");
}

// Fetch the last session from user_workouts
$stmt = $conn->prepare("SELECT * FROM user_workouts WHERE user_id = ? AND muscle_group = ? ORDER BY workout_date DESC, no DESC LIMIT 1");
$stmt->bind_param("is", $authUserId, $muscleGroup);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $workout = $result->fetch_assoc();
    
    // Fetch associated granular exercise logs
    $workoutId = $workout['no'];
    $logStmt = $conn->prepare("SELECT exercise_title, sets_completed, reps_completed, weight_kg, time_used_seconds FROM user_exercise_logs WHERE workout_id = ?");
    $logStmt->bind_param("i", $workoutId);
    $logStmt->execute();
    $logResult = $logStmt->get_result();
    
    $exerciseLogs = [];
    while ($row = $logResult->fetch_assoc()) {
        $exerciseLogs[] = $row;
    }
    
    $workout['exercise_logs'] = $exerciseLogs;
    
    ApiHelper::sendResponse(true, "Last workout found", $workout);
} else {
    ApiHelper::sendResponse(false, "No previous workout found for this muscle group", null, 404);
}
?>
