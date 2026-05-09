<?php
require __DIR__ . "/../config/db.php";

$alter_queries = [
    "ALTER TABLE body_profiles ADD COLUMN IF NOT EXISTS goal VARCHAR(50) DEFAULT 'maintain'",
    "ALTER TABLE body_profiles ADD COLUMN IF NOT EXISTS activity_level VARCHAR(50) DEFAULT 'moderate'",
    "ALTER TABLE body_profiles ADD COLUMN IF NOT EXISTS age INT DEFAULT 25"
];

foreach ($alter_queries as $query) {
    if ($conn->query($query) === TRUE) {
        echo "Column updated successfully.<br>";
    } else {
        echo "Error updating column: " . $conn->error . "<br>";
    }
}
?>
