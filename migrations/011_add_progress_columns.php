<?php
require_once __DIR__ . '/../config/db.php';

// 1. Check and Add duration_seconds
$checkCol1 = $conn->query("SHOW COLUMNS FROM user_workouts LIKE 'duration_seconds'");
if ($checkCol1->num_rows == 0) {
    if ($conn->query("ALTER TABLE user_workouts ADD COLUMN duration_seconds INT DEFAULT 0") === TRUE) {
        echo "Column 'duration_seconds' added.<br>";
    } else {
        echo "Error adding 'duration_seconds': " . $conn->error . "<br>";
    }
} else {
    echo "Column 'duration_seconds' already exists.<br>";
}

// 2. Check and Add progress_percentage
$checkCol2 = $conn->query("SHOW COLUMNS FROM user_workouts LIKE 'progress_percentage'");
if ($checkCol2->num_rows == 0) {
    if ($conn->query("ALTER TABLE user_workouts ADD COLUMN progress_percentage INT DEFAULT 0") === TRUE) {
        echo "Column 'progress_percentage' added.<br>";
    } else {
        echo "Error adding 'progress_percentage': " . $conn->error . "<br>";
    }
} else {
    echo "Column 'progress_percentage' already exists.<br>";
}
?>
