<?php
header("Content-Type: application/json; charset=UTF-8");
require "../config/db.php";

$meal_id = $_GET['meal_id'] ?? 0;

if ($meal_id == 0) {
    echo json_encode([
        "status" => false,
        "message" => "Meal ID required"
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
     WHERE id = ?"
);

$stmt->bind_param("i", $meal_id);
$stmt->execute();
$result = $stmt->get_result();

$meal = $result->fetch_assoc();

if (!$meal) {
    echo json_encode([
        "status" => false,
        "message" => "Meal not found"
    ]);
    exit;
}

echo json_encode([
    "status" => true,
    "data" => $meal
]);
