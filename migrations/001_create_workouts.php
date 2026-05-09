<?php
require __DIR__ . '/../config/db.php';

$sql = "CREATE TABLE IF NOT EXISTS user_workouts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    workout_date DATE NOT NULL,
    muscle_group VARCHAR(50) NOT NULL,
    intensity VARCHAR(20) DEFAULT 'medium',
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    UNIQUE KEY unique_daily_workout (user_id, workout_date)
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'user_workouts' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
//$conn->close();
?>
