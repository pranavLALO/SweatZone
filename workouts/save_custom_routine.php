<?php
/**
 * workouts/save_custom_routine.php
 * Saves a user-generated custom routine to their profile.
 */
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/api_helper.php';

$userPayload = ApiHelper::authenticate();
$userId = $userPayload['user_id'];

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['routine_name']) || empty(trim($data['routine_name']))) {
    ApiHelper::sendResponse(false, "Routine name is required");
}

if (!isset($data['exercise_ids']) || !is_array($data['exercise_ids']) || empty($data['exercise_ids'])) {
    ApiHelper::sendResponse(false, "At least one exercise must be selected");
}

$routineName = trim($data['routine_name']);
$exerciseIds = $data['exercise_ids'];

// Insert parent routine
$stmt = $conn->prepare("INSERT INTO user_custom_routines (user_id, routine_name) VALUES (?, ?)");
$stmt->bind_param("is", $userId, $routineName);

if (!$stmt->execute()) {
    ApiHelper::sendResponse(false, "Failed to create routine: " . $stmt->error);
}

$routineId = $stmt->insert_id;

// Insert child exercises
$orderIndex = 1;
$insertEx = $conn->prepare("INSERT INTO custom_routine_exercises (routine_id, exercise_id, order_index) VALUES (?, ?, ?)");

foreach ($exerciseIds as $exId) {
    $insertEx->bind_param("iii", $routineId, $exId, $orderIndex);
    $insertEx->execute();
    $orderIndex++;
}

ApiHelper::sendResponse(true, "Custom routine saved successfully!", ["routine_id" => $routineId]);
?>
