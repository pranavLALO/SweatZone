<?php
/**
 * 013_create_workout_exercises.php
 * Creates the `workout_exercises` table which stores dynamic workout videos.
 */
require_once __DIR__ . '/../config/db.php';

$sql = "CREATE TABLE IF NOT EXISTS workout_exercises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    target_muscle VARCHAR(50) NOT NULL,
    difficulty ENUM('beginner', 'intermediate', 'advanced') NOT NULL,
    title VARCHAR(150) NOT NULL,
    video_filename VARCHAR(255) NOT NULL,
    instructions_json TEXT NOT NULL,
    benefits_json TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "✓ Table `workout_exercises` created successfully.<br>";
} else {
    echo "x Error creating table `workout_exercises`: " . $conn->error . "<br>";
}
