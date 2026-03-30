<?php
require_once __DIR__ . '/../config/db.php'; // Use require_once to avoid double connection

$sql = "CREATE TABLE IF NOT EXISTS body_profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    height_cm DECIMAL(5,2) NOT NULL,
    weight_kg DECIMAL(5,2) NOT NULL,
    gender ENUM('Male', 'Female', 'Other') NOT NULL,
    age INT,
    goal VARCHAR(50) DEFAULT 'maintain',
    activity_level VARCHAR(50) DEFAULT 'moderate',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'body_profiles' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
?>
