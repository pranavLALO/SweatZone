<?php
/**
 * workouts/get_user_badges.php
 * Calculates and returns tiered badges for custom workout routines.
 */
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/api_helper.php';

$userPayload = ApiHelper::authenticate();
$userId = $userPayload['user_id'];

// 1. Fetch completions and max reps per routine
$query = "
    SELECT 
        r.id as routine_id,
        r.routine_name,
        COUNT(w.id) as completion_count,
        MAX(w.total_reps) as max_reps
    FROM user_custom_routines r
    LEFT JOIN user_workouts w ON r.id = w.routine_id
    WHERE r.user_id = ?
    GROUP BY r.id
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$results = $stmt->get_result();

$badges = [];

while ($row = $results->fetch_assoc()) {
    $routineId = $row['routine_id'];
    $name = $row['routine_name'];
    $completions = (int)$row['completion_count'];
    $maxReps = (int)$row['max_reps'];

    // --- Consistency Badges (Plan Loyal) ---
    if ($completions >= 10) {
        $badges[] = ["routine_name" => $name, "type" => "Consistency", "tier" => "Gold", "message" => "Plan Master (10+ Sessions)"];
    } elseif ($completions >= 5) {
        $badges[] = ["routine_name" => $name, "type" => "Consistency", "tier" => "Silver", "message" => "Plan Veteran (5+ Sessions)"];
    } elseif ($completions >= 3) {
        $badges[] = ["routine_name" => $name, "type" => "Consistency", "tier" => "Bronze", "message" => "Plan Loyal (3+ Sessions)"];
    }

    // --- Progression Badges (Power Surge) ---
    // If user has hit at least 50 reps in one session, award according to volume
    if ($maxReps >= 150) {
        $badges[] = ["routine_name" => $name, "type" => "Progression", "tier" => "Gold", "message" => "Power Surge (150+ Reps)"];
    } elseif ($maxReps >= 100) {
        $badges[] = ["routine_name" => $name, "type" => "Progression", "tier" => "Silver", "message" => "Strength Surge (100+ Reps)"];
    } elseif ($maxReps >= 50) {
        $badges[] = ["routine_name" => $name, "type" => "Progression", "tier" => "Bronze", "message" => "Volume Builder (50+ Reps)"];
    }
}

ApiHelper::sendResponse(true, "Badges fetched successfully", $badges);
?>
