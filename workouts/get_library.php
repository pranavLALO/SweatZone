<?php
/**
 * workouts/get_library.php
 * Fetches all global exercises so the frontend can populate the Workout Library.
 */
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/api_helper.php';

// Auth is optional for library browsing, but let's assume they are logged in anyway.
// ApiHelper::authenticate();

$stmt = $conn->prepare("SELECT id, target_muscle, difficulty, title, video_filename, instructions_json, benefits_json FROM workout_exercises ORDER BY target_muscle ASC, difficulty ASC, id ASC");
$stmt->execute();
$result = $stmt->get_result();

$exercises = [];
while ($row = $result->fetch_assoc()) {
    $row['instructions'] = json_decode($row['instructions_json'], true);
    $row['benefits'] = json_decode($row['benefits_json'], true);
    unset($row['instructions_json']);
    unset($row['benefits_json']);
    $exercises[] = $row;
}

ApiHelper::sendResponse(true, "Library fetched", $exercises);
?>
