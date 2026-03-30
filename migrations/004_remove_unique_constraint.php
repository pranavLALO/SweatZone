<?php
require __DIR__ . '/../config/db.php';

// Drop the unique index to allow multiple workouts per day
$sql = "ALTER TABLE user_workouts DROP INDEX unique_daily_workout";

if ($conn->query($sql) === TRUE) {
    echo "Unique constraint 'unique_daily_workout' dropped successfully.<br>";
} else {
    // It might fail if the index was created with a different name or doesn't exist
    // Try to check if index exists or just ignore if it says "check that column/key exists"
    echo "Error dropping index (it might not exist): " . $conn->error . "<br>";
}
?>
