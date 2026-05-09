<?php
require __DIR__ . '/../config/db.php';

echo "<h2>Meal Counts Debug</h2>";

$goals = ['muscle_gain', 'weight_loss', 'maintain'];
$is_regs = [0, 1];

foreach ($goals as $g) {
    foreach ($is_regs as $v) {
        $vLabel = $v ? "Veg" : "Non-Veg";
        echo "<h3>Goal: $g ($vLabel)</h3>";
        
        $sql = "SELECT meal_type, COUNT(*) as count FROM meals WHERE purpose='$g' AND is_vegetarian=$v GROUP BY meal_type";
        $res = $conn->query($sql);
        
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                echo "{$row['meal_type']}: {$row['count']}<br>";
            }
        } else {
            echo "No meals found.<br>";
        }
    }
}
?>
