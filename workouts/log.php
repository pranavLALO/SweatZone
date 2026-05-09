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
$weight = $data['weight_kg'] ?? 0;
$sets = $data['completed_sets'] ?? 0;
$reps = $data['completed_reps'] ?? 0;
$timer = $data['timer_seconds_used'] ?? 0;
$exerciseLogs = $data['exercise_logs'] ?? [];

if ($muscle_group === '') {
    ApiHelper::sendResponse(false, "Muscle group required"); 
}

// Start Transaction for data integrity
$conn->begin_transaction();

try {
    $stmt = $conn->prepare(
        "INSERT INTO user_workouts (user_id, workout_date, muscle_group, intensity, duration_seconds, progress_percentage, weight_kg, completed_sets, completed_reps, timer_seconds_used)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
         ON DUPLICATE KEY UPDATE 
         muscle_group = VALUES(muscle_group), 
         intensity = VALUES(intensity), 
         duration_seconds = VALUES(duration_seconds),
         progress_percentage = VALUES(progress_percentage),
         weight_kg = VALUES(weight_kg),
         completed_sets = VALUES(completed_sets),
         completed_reps = VALUES(completed_reps),
         timer_seconds_used = VALUES(timer_seconds_used)"
    );

    $stmt->bind_param("isssiiiiii", $user_id, $date, $muscle_group, $intensity, $duration, $progress, $weight, $sets, $reps, $timer);
    $stmt->execute();
    
    $workoutId = $conn->insert_id ?: $conn->query("SELECT no FROM user_workouts WHERE user_id = $user_id AND workout_date = '$date' AND muscle_group = '$muscle_group'")->fetch_assoc()['no'];

    if (!empty($exerciseLogs)) {
        // Delete old logs for this session to prevent duplicates
        $conn->query("DELETE FROM user_exercise_logs WHERE workout_id = $workoutId");
        
        $logStmt = $conn->prepare("INSERT INTO user_exercise_logs (user_id, workout_id, exercise_title, sets_completed, reps_completed, weight_kg, time_used_seconds) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        foreach ($exerciseLogs as $log) {
            $title = $log['exercise_title'];
            $s = $log['sets_completed'] ?? 0;
            $r = $log['reps_completed'] ?? 0;
            $w = $log['weight_kg'] ?? 0;
            $t = $log['time_used_seconds'] ?? 0;
            $logStmt->bind_param("iissiii", $user_id, $workoutId, $title, $s, $r, $w, $t);
            $logStmt->execute();
        }
    }

    $conn->commit();
    ApiHelper::sendResponse(true, "Workout and exercise logs saved successfully for " . $date);

} catch (Exception $e) {
    $conn->rollback();
    file_put_contents("../debug_log.txt", date("Y-m-d H:i:s") . " - LOG ERROR: " . $e->getMessage() . "\n", FILE_APPEND);
    ApiHelper::sendResponse(false, "Failed to save: " . $e->getMessage(), $e->getMessage(), 500);
}
