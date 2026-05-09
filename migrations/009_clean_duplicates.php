<?php
require __DIR__ . '/../config/db.php';

// Remove duplicates, keeping the one with the lowest ID
$sql = "DELETE m1 FROM meals m1
        INNER JOIN meals m2 
        WHERE m1.id > m2.id 
        AND m1.meal_name = m2.meal_name 
        AND m1.purpose = m2.purpose 
        AND m1.meal_type = m2.meal_type";

if ($conn->query($sql) === TRUE) {
    echo "Duplicates removed successfully.<br>";
} else {
    echo "Error removing duplicates: " . $conn->error;
}
?>
