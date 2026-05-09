<?php
header("Content-Type: application/json");
require "../config/db.php";

$user_id = $_GET['user_id'] ?? 0;

if ($user_id == 0) {
    echo json_encode([
        "status" => false,
        "message" => "User ID required"
    ]);
    exit;
}

$today = date("Y-m-d");

/* 1️⃣ Get diet plan ID and total calories */
$planStmt = $conn->prepare(
    "SELECT id, total_calories FROM diet_plans WHERE user_id = ? AND plan_date = ?"
);

if (!$planStmt) {
    echo json_encode([
        "status" => false,
        "message" => "Plan query failed",
        "error" => $conn->error
    ]);
    exit;
}

$planStmt->bind_param("is", $user_id, $today);
$planStmt->execute();
$planRes = $planStmt->get_result();
$plan = $planRes->fetch_assoc();

if (!$plan) {
    echo json_encode([
        "status" => false,
        "message" => "No plan found"
    ]);
    exit;
}

$plan_id = $plan['id'];
$total_calories = (int)$plan['total_calories'];

/* 2️⃣ Get meals */
$mealStmt = $conn->prepare(
    "SELECT m.meal_name, m.meal_type, m.calories, m.protein, m.carbs, m.fats, dpm.meal_time
     FROM diet_plan_meals dpm
     JOIN meals m ON dpm.meal_id = m.id
     WHERE dpm.diet_plan_id = ?"
);

if (!$mealStmt) {
    echo json_encode([
        "status" => false,
        "message" => "Meals query failed",
        "error" => $conn->error
    ]);
    exit;
}

$mealStmt->bind_param("i", $plan_id);
$mealStmt->execute();
$result = $mealStmt->get_result();

$meals = [
    "breakfast" => [],
    "lunch" => [],
    "snack" => [],
    "dinner" => []
];

while ($row = $result->fetch_assoc()) {
    $meals[$row['meal_time']][] = $row;
}

/* 3️⃣ FINAL JSON */
echo json_encode([
    "status" => true,
    "date" => $today,
    "total_calories" => $total_calories,
    "meals" => $meals
]);
