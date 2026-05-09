<?php
/**
 * 016_add_sets_reps_to_exercises.php
 * Adds sets and reps fields to the workout_exercises table.
 */
require_once __DIR__ . '/../config/db.php';

$sql = "ALTER TABLE workout_exercises 
        ADD COLUMN sets INT DEFAULT 3 AFTER benefits_json,
        ADD COLUMN reps VARCHAR(50) DEFAULT '10-12' AFTER sets";

if ($conn->query($sql) === TRUE) {
    echo "✓ Columns `sets` and `reps` added successfully.<br>";
} else {
    // Ignore duplicate column errors if it was already run
    if ($conn->errno == 1060) {
        echo "✓ Columns `sets` and `reps` already exist.<br>";
    } else {
        echo "x Error adding columns: " . $conn->error . "<br>";
    }
}
?>
