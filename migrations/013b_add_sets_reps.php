<?php
require_once __DIR__ . '/../config/db.php';
$conn->query("ALTER TABLE workout_exercises ADD COLUMN sets INT DEFAULT 3");
$conn->query("ALTER TABLE workout_exercises ADD COLUMN reps VARCHAR(50) DEFAULT '10'");
echo $conn->error;
echo "Done";
?>
