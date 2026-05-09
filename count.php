<?php
require 'config/db.php';
$res = $conn->query("SELECT target_muscle, difficulty, COUNT(*) FROM workout_exercises GROUP BY target_muscle, difficulty");
while($row = $res->fetch_row()) {
    echo $row[0] . " | " . $row[1] . " | " . $row[2] . "\n";
}
?>
