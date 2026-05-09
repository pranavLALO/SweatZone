<?php
/**
 * 020_create_exercise_logs.php
 * Creates a table for granular tracking of individual exercises per workout session.
 */
require_once __DIR__ . '/../config/db.php';

$sql = "CREATE TABLE IF NOT EXISTS user_exercise_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    workout_id INT NOT NULL,
    exercise_title VARCHAR(150) NOT NULL,
    sets_completed INT DEFAULT 0,
    reps_completed INT DEFAULT 0,
    weight_kg INT DEFAULT 0,
    time_used_seconds INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (workout_id) REFERENCES user_workouts(no) ON DELETE CASCADE
)";

if ($conn->query($sql) === TRUE) {
    echo "✓ Table `user_exercise_logs` created successfully.<br>";
} else {
    echo "x Error creating table `user_exercise_logs`: " . $conn->error . "<br>";
}
?>
