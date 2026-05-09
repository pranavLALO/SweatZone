<?php
require __DIR__ . '/config/db.php';

$sql = "SELECT * FROM user_workouts ORDER BY id DESC LIMIT 5";
$result = $conn->query($sql);

$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}
echo json_encode($rows, JSON_PRETTY_PRINT);
?>
