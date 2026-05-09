<?php
/**
 * workouts/update_custom_routine.php
 * Updates an existing user routine's name and/or its exercise list.
 */
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/api_helper.php';

$userPayload = ApiHelper::authenticate();
$userId = $userPayload['user_id'];

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['routine_id'])) {
    ApiHelper::sendResponse(false, "Routine ID is required for update");
}

$routineId = $data['routine_id'];
$newName = trim($data['routine_name'] ?? '');
$exerciseIds = $data['exercise_ids'] ?? null; // Optional: only update if provided

// 1. Verify ownership
$check = $conn->prepare("SELECT id FROM user_custom_routines WHERE id = ? AND user_id = ?");
$check->bind_param("ii", $routineId, $userId);
$check->execute();
if ($check->get_result()->num_rows === 0) {
    ApiHelper::sendResponse(false, "Routine not found or not owned by you");
}

// 2. Update Name if provided
if (!empty($newName)) {
    $upd = $conn->prepare("UPDATE user_custom_routines SET routine_name = ? WHERE id = ?");
    $upd->bind_param("si", $newName, $routineId);
    $upd->execute();
}

// 3. Update Exercises if provided (Sync approach: delete old, insert new)
if ($exerciseIds !== null && is_array($exerciseIds)) {
    // Delete existing links
    $del = $conn->prepare("DELETE FROM custom_routine_exercises WHERE routine_id = ?");
    $del->bind_param("i", $routineId);
    $del->execute();

    // Insert new links
    $orderIndex = 1;
    $insertEx = $conn->prepare("INSERT INTO custom_routine_exercises (routine_id, exercise_id, order_index) VALUES (?, ?, ?)");
    foreach ($exerciseIds as $exId) {
        $insertEx->bind_param("iii", $routineId, $exId, $orderIndex);
        $insertEx->execute();
        $orderIndex++;
    }
}

ApiHelper::sendResponse(true, "Routine updated successfully!");
?>
