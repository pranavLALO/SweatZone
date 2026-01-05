<?php
header("Content-Type: application/json; charset=UTF-8");
require "../config/db.php";

$goal = $_GET['goal'] ?? '';

if ($goal == '') {
    echo json_encode([
        "status" => false,
        "message" => "Goal is required",
        "data" => []
    ]);
    exit;
}

$stmt = $conn->prepare(
    "SELECT 
        id,
        meal_name,
        meal_type,
        purpose,
        calories,
        protein,
        carbs,
        fats,
        is_vegetarian
     FROM meals
     WHERE purpose = ?
     ORDER BY meal_type"
);

$stmt->bind_param("s", $goal);
$stmt->execute();
$result = $stmt->get_result();

$meals = [];
while ($row = $result->fetch_assoc()) {
    $meals[] = $row;
}

echo json_encode([
    "status" => true,
    "message" => "Meals fetched successfully",
    "data" => $meals
]);
