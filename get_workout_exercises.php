<?php
/**
 * get_workout_exercises.php
 * Fetches exercises for a given muscle group and difficulty.
 * Expected query parameters:
 *   - target_muscle (e.g., chest, arms, legs, back, shoulder, abs)
 *   - difficulty (e.g., beginner, intermediate, advanced)
 */
require_once __DIR__ . '/config/db.php';
header('Content-Type: application/json');

$target_muscle = isset($_GET['target_muscle']) ? $_GET['target_muscle'] : '';
$difficulty = isset($_GET['difficulty']) ? $_GET['difficulty'] : '';

if (empty($target_muscle) || empty($difficulty)) {
    echo json_encode(['status' => false, 'message' => 'Missing target_muscle or difficulty parameters.']);
    exit;
}

$stmt = $conn->prepare("SELECT id, target_muscle, difficulty, title, video_filename, instructions_json, benefits_json FROM workout_exercises WHERE target_muscle = ? AND difficulty = ? ORDER BY id ASC");
$stmt->bind_param("ss", $target_muscle, $difficulty);
$stmt->execute();
$result = $stmt->get_result();

$exercises = [];
while ($row = $result->fetch_assoc()) {
    // Decode JSON strings back into arrays for the API response
    $row['instructions'] = json_decode($row['instructions_json'], true);
    $row['benefits'] = json_decode($row['benefits_json'], true);
    unset($row['instructions_json']);
    unset($row['benefits_json']);
    
    // We can also prepend the full video URL if needed, but since RetrofitClient.BASE_URL is used in Android, 
    // we can just send the filename to let the app build the URL or we build it here. Let's let the app build it.
    
    $exercises[] = $row;
}

echo json_encode([
    'status' => true,
    'data' => $exercises
]);
?>
