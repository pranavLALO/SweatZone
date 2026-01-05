<?php
header("Content-Type: application/json");
require "../config/db.php";

$user_id = $_GET['user_id'] ?? 0;
$today = date("Y-m-d");

$stmt = $conn->prepare(
    "SELECT 
        m.meal_name,
        m.meal_type,
        m.calories,
        m.protein,
        m.carbs,
        m.fats,
        dm.meal_time
     FROM daily_diet_plan dp
     JOIN daily_diet_meals dm ON dp.id = dm.diet_plan_id
     JOIN meals m ON dm.meal_id = m.id
     WHERE dp.user_id = ? AND dp.plan_date = ?"
);

$stmt->bind_param("is", $user_id, $today);
$stmt->execute();
$res = $stmt->get_result();

$meals = [
    "breakfast" => [],
    "lunch" => [],
    "snack" => [],
    "dinner" => []
];

while ($row = $res->fetch_assoc()) {
    $meals[$row['meal_time']][] = $row;
}

echo json_encode([
    "status" => true,
    "date" => $today,
    "meals" => $meals
]);
