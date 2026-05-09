<?php
/**
 * workouts/get_custom_routines.php
 * Fetches all custom playlists the user has saved, including the nested exercise data.
 */
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/api_helper.php';

$userPayload = ApiHelper::authenticate();
$userId = $userPayload['user_id'];

// Get all routines for user
$stmt = $conn->prepare("SELECT id, routine_name, created_at FROM user_custom_routines WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $userId);
$stmt->execute();
$routinesResult = $stmt->get_result();

$routines = [];

// Prepare the join statement to get exercises for a specific routine
$exStmt = $conn->prepare("
    SELECT e.id, e.target_muscle, e.difficulty, e.title, e.video_filename, e.instructions_json, e.benefits_json 
    FROM custom_routine_exercises cre
    JOIN workout_exercises e ON cre.exercise_id = e.id
    WHERE cre.routine_id = ?
    ORDER BY cre.order_index ASC
");

while ($routineMsg = $routinesResult->fetch_assoc()) {
    $routineId = $routineMsg['id'];
    
    $exStmt->bind_param("i", $routineId);
    $exStmt->execute();
    $exResult = $exStmt->get_result();
    
    $exercises = [];
    while ($exRow = $exResult->fetch_assoc()) {
        $exRow['instructions'] = json_decode($exRow['instructions_json'], true);
        $exRow['benefits'] = json_decode($exRow['benefits_json'], true);
        unset($exRow['instructions_json']);
        unset($exRow['benefits_json']);
        $exercises[] = $exRow;
    }
    
    $routineMsg['exercises'] = $exercises;
    $routines[] = $routineMsg;
}

ApiHelper::sendResponse(true, "Routines fetched", $routines);
?>
