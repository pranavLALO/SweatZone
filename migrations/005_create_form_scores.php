<?php
require __DIR__ . '/../config/db.php';

$sql = "CREATE TABLE IF NOT EXISTS form_scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    exercise_name VARCHAR(50) NOT NULL,
    score INT NOT NULL,
    metrics_json TEXT, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'form_scores' created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}
?>
