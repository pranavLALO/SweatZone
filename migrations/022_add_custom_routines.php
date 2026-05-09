<?php
/**
 * 022_add_custom_routines.php
 * Creates the necessary tables for users to save custom hand-picked workouts.
 */
require_once __DIR__ . '/../config/db.php';

$queries = [
    "CREATE TABLE IF NOT EXISTS user_custom_routines (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        routine_name VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    "CREATE TABLE IF NOT EXISTS custom_routine_exercises (
        id INT AUTO_INCREMENT PRIMARY KEY,
        routine_id INT NOT NULL,
        exercise_id INT NOT NULL,
        order_index INT NOT NULL,
        FOREIGN KEY (routine_id) REFERENCES user_custom_routines(id) ON DELETE CASCADE,
        FOREIGN KEY (exercise_id) REFERENCES workout_exercises(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
];

$successCount = 0;
foreach ($queries as $query) {
    if ($conn->query($query) === TRUE) {
        $successCount++;
    } else {
        echo "Error: " . $conn->error . "\n";
    }
}

echo "Successfully ran $successCount migration queries. Custom Routines tables created!\n";
?>
