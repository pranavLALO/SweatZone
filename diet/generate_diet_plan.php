<?php
header("Content-Type: application/json");
require "../config/db.php";
require "../helpers/calorie_helper.php";

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $data['user_id'] ?? 0;
$goal    = $data['goal'] ?? '';

if ($user_id == 0 || $goal == '') {
    echo json_encode(["status" => false, "message" => "User ID and goal required"]);
    exit;
}

$today = date("Y-m-d");

/* 1. Get body profile */
$bodyStmt = $conn->prepare(
    "SELECT height_cm, weight_kg, gender, age
     FROM user_body_profile
     WHERE user_id = ?"
);
$bodyStmt->bind_param("i", $user_id);
$bodyStmt->execute();
$body = $bodyStmt->get_result()->fetch_assoc();

if (!$body) {
    echo json_encode(["status" => false, "message" => "Body profile not found"]);
    exit;
}

/* 2. Calculate calories */
$totalCalories = calculateDailyCalories(
    $body['height_cm'],
    $body['weight_kg'],
    $body['age'],
    $body['gender'],
    $goal
);

/* 3. Create plan */
$conn->query(
    "INSERT IGNORE INTO daily_diet_plan (user_id, plan_date, total_calories)
     VALUES ($user_id, '$today', $totalCalories)"
);

/* 4. Get plan id */
$res = $conn->query(
    "SELECT id FROM daily_diet_plan
     WHERE user_id = $user_id AND plan_date = '$today'"
);
$plan_id = $res->fetch_assoc()['id'];

/* 5. Clear old meals */
$conn->query("DELETE FROM daily_diet_meals WHERE diet_plan_id = $plan_id");

/* 6. Insert meals */
$mealTimes = ['breakfast','lunch','snack','dinner'];

foreach ($mealTimes as $time) {

    $stmt = $conn->prepare(
        "SELECT id FROM meals
         WHERE purpose = ? AND meal_type = ?
         ORDER BY protein DESC
         LIMIT 1"
    );
    $stmt->bind_param("ss", $goal, $time);
    $stmt->execute();
    $meal = $stmt->get_result()->fetch_assoc();

    if ($meal) {
        $ins = $conn->prepare(
            "INSERT INTO daily_diet_meals (diet_plan_id, meal_id, meal_time)
             VALUES (?, ?, ?)"
        );
        $ins->bind_param("iis", $plan_id, $meal['id'], $time);
        $ins->execute();
    }
}

echo json_encode([
    "status" => true,
    "message" => "Diet plan generated",
    "total_calories" => $totalCalories
]);
