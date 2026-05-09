<?php
require 'config/db.php';
$query = "INSERT INTO workout_exercises (target_muscle, difficulty, title, video_filename, instructions_json, benefits_json, sets, reps) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($query);
if (!$stmt) {
    echo "ERROR: " . $conn->error;
} else {
    echo "SUCCESS";
}
?>
