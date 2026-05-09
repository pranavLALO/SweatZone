<?php
/**
 * 019_add_advanced_stats_to_workouts.php
 * Adds columns for tracking weight, sets, reps, and timer for intensive logging.
 */
require_once __DIR__ . '/../config/db.php';

$columns = [
    'weight_kg' => "INT DEFAULT 0",
    'completed_sets' => "INT DEFAULT 0",
    'completed_reps' => "INT DEFAULT 0",
    'timer_seconds_used' => "INT DEFAULT 0"
];

foreach ($columns as $col => $definition) {
    $check = $conn->query("SHOW COLUMNS FROM user_workouts LIKE '$col'");
    if ($check->num_rows == 0) {
        if ($conn->query("ALTER TABLE user_workouts ADD COLUMN $col $definition") === TRUE) {
            echo "✓ Added column: $col<br>";
        } else {
            echo "x Error adding column $col: " . $conn->error . "<br>";
        }
    } else {
        echo "- Column $col already exists.<br>";
    }
}
?>
