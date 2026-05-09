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

$is_vegetarian = isset($_GET['is_vegetarian']) ? (int)$_GET['is_vegetarian'] : 0;

$stmt = $conn->prepare(
    "SELECT 
        id,
        meal_name,
        meal_type,
        purpose,
        calories,
        protein,
        carbs,
        fats
     FROM meals
     WHERE purpose = ? AND is_vegetarian = ?
     ORDER BY meal_type"
);

$stmt->bind_param("si", $goal, $is_vegetarian);
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
