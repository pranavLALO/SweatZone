<?php
/**
 * 023_add_routine_tracking.php
 * Adds routine_id to user_workouts and creates user_achievements table.
 */
require_once __DIR__ . '/../config/db.php';

$queries = [
    // 1. Link workouts to specific custom routines
    "ALTER TABLE user_workouts ADD COLUMN IF NOT EXISTS routine_id INT NULL DEFAULT NULL",
    "ALTER TABLE user_workouts ADD CONSTRAINT fk_routine FOREIGN KEY (routine_id) REFERENCES user_custom_routines(id) ON DELETE SET NULL",

    // 2. Achievements table for badges
    "CREATE TABLE IF NOT EXISTS user_achievements (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        routine_id INT NOT NULL,
        badge_type ENUM('consistency', 'progression') NOT NULL,
        tier ENUM('bronze', 'silver', 'gold') NOT NULL,
        unlocked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UNIQUE KEY user_routine_badge (user_id, routine_id, badge_type, tier),
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (routine_id) REFERENCES user_custom_routines(id) ON DELETE CASCADE
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

echo "Successfully ran $successCount migration queries. Tracking and Achievement tables ready!\n";
?>
