<?php
require_once __DIR__ . '/../config/db.php';

$queries = [
    "ALTER TABLE users ADD COLUMN reset_otp VARCHAR(6) NULL",
    "ALTER TABLE users ADD COLUMN reset_expires DATETIME NULL"
];

$successCount = 0;
foreach ($queries as $query) {
    if ($conn->query($query) === TRUE) {
        $successCount++;
    } else {
        echo "Error: " . $conn->error . "<br>";
    }
}

echo "Added reset_otp and reset_expires columns. Successfully ran $successCount queries.";
?>
