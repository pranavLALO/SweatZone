<?php
/**
 * workouts/get_custom_routine_by_id.php
 * Fetches a single fully-hydrated custom routine for the execution template.
 */
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/api_helper.php';

$userPayload = ApiHelper::authenticate();
$userId = $userPayload['user_id'];
$routineId = isset($_GET['routine_id']) ? (int)$_GET['routine_id'] : 0;

if ($routineId === 0) {
    ApiHelper::sendResponse(false, "Routine ID required");
}

$stmt = $conn->prepare("SELECT id, routine_name, created_at FROM user_custom_routines WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $routineId, $userId);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    ApiHelper::sendResponse(false, "Routine not found");
}
$routine = $res->fetch_assoc();

$exStmt = $conn->prepare("
    SELECT e.id, e.target_muscle, e.difficulty, e.title, e.video_filename, e.instructions_json, e.benefits_json 
    FROM custom_routine_exercises cre
    JOIN workout_exercises e ON cre.exercise_id = e.id
    WHERE cre.routine_id = ?
    ORDER BY cre.order_index ASC
");
$exStmt->bind_param("i", $routine['id']);
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
$routine['exercises'] = $exercises;

ApiHelper::sendResponse(true, "Routine fetched successfully", $routine);
?>
