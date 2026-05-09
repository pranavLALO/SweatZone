<?php
require __DIR__ . '/../config/db.php';

// Drop the restrictive unique index that prevents multiple workouts per day
// But first ensure we have an index for the foreign key (user_id)
$sql = "ALTER TABLE user_workouts ADD INDEX idx_user_id (user_id), DROP INDEX unique_daily_workout";

if ($conn->query($sql) === TRUE) {
    echo "Index 'unique_daily_workout' dropped successfully and 'idx_user_id' added.";
} else {
    echo "Error modifying table: " . $conn->error;
}
?>
