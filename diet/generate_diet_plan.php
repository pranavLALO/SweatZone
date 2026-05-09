<?php
header("Content-Type: application/json");
require "../config/db.php";
require "../helpers/calorie_helper.php";

/* ===============================
   READ INPUT
   =============================== */
$data = json_decode(file_get_contents("php://input"), true);

$user_id = isset($data['user_id']) ? (int)$data['user_id'] : 0;
$goal    = isset($data['goal']) ? trim($data['goal']) : '';

if ($user_id === 0) {
    echo json_encode([
        "status" => false,
        "message" => "User ID required"
    ]);
    exit;
}

$today = date("Y-m-d");

/* ===============================
   1️⃣ GET BODY PROFILE
   =============================== */
$bodyStmt = $conn->prepare(
    "SELECT height_cm, weight_kg, gender, goal
     FROM body_profiles
     WHERE user_id = ?"
);
$bodyStmt->bind_param("i", $user_id);
$bodyStmt->execute();
$body = $bodyStmt->get_result()->fetch_assoc();

if (!$body) {
    echo json_encode([
        "status" => false,
        "message" => "Body profile not found"
    ]);
    exit;
}

// USE DB GOAL IF INPUT GOAL IS EMPTY
if ($goal === '') {
    $goal = $body['goal'];
}

// Fallback if still empty
if ($goal === '') {
    $goal = 'maintain';
}

// ⬇️ NORMALIZE GOAL for DB Matching (e.g. "Weight Loss" -> "weight_loss")
$goal = strtolower(trim($goal));
$goal = str_replace(' ', '_', $goal);

// Validate against allowed ENUM values in 'meals' table
$allowed_goals = ['weight_loss', 'muscle_gain', 'maintain'];
if (!in_array($goal, $allowed_goals)) {
    $goal = 'maintain'; // Default fallback
}

/* ===============================
   2️⃣ CALCULATE CALORIES
   =============================== */
$totalCalories = calculateDailyCalories(
    (float)$body['height_cm'],
    (float)$body['weight_kg'],
    25,
    $body['gender'],
    $goal
);


// CHECK WORKOUT FOR TODAY
$workStmt = $conn->prepare("SELECT muscle_group, intensity FROM user_workouts WHERE user_id = ? AND workout_date = ?");
$workStmt->bind_param("is", $user_id, $today);
$workStmt->execute();
$workout = $workStmt->get_result()->fetch_assoc();

if ($workout) {
    if ($workout['muscle_group'] == 'legs' || $workout['muscle_group'] == 'full_body') {
        $totalCalories += 300; // Extra fuel for big days
        $goal = 'muscle_gain'; // Prioritize carbs/protein
    } elseif ($workout['muscle_group'] == 'rest') {
        $totalCalories -= 200; // Lower calories for rest
    }
}


/* ===============================
   3️⃣ CREATE / UPDATE PLAN
   =============================== */
$planStmt = $conn->prepare(
    "INSERT INTO diet_plans (user_id, plan_date, total_calories)
     VALUES (?, ?, ?)
     ON DUPLICATE KEY UPDATE total_calories = VALUES(total_calories)"
);
$planStmt->bind_param("isi", $user_id, $today, $totalCalories);
$planStmt->execute();

/* ===============================
   4️⃣ GET PLAN ID
   =============================== */
$getPlan = $conn->prepare(
    "SELECT id FROM diet_plans WHERE user_id = ? AND plan_date = ?"
);
$getPlan->bind_param("is", $user_id, $today);
$getPlan->execute();
$plan = $getPlan->get_result()->fetch_assoc();

if (!$plan) {
    echo json_encode([
        "status" => false,
        "message" => "Failed to create plan"
    ]);
    exit;
}

$plan_id = (int)$plan['id'];

/* ===============================
   5️⃣ CLEAR OLD MEALS
   =============================== */
$clear = $conn->prepare(
    "DELETE FROM diet_plan_meals WHERE diet_plan_id = ?"
);
$clear->bind_param("i", $plan_id);
$clear->execute();

/* ===============================
   6️⃣ RANDOM MEAL PICKER FUNCTION
   =============================== */
function insertMeals($conn, $plan_id, $goal, $meal_type, $limit) {
    $stmt = $conn->prepare(
        "SELECT id FROM meals
         WHERE purpose = ? AND meal_type = ?
         ORDER BY RAND()
         LIMIT $limit"
    );

    $stmt->bind_param("ss", $goal, $meal_type);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $insert = $conn->prepare(
            "INSERT INTO diet_plan_meals (diet_plan_id, meal_id, meal_time)
             VALUES (?, ?, ?)"
        );
        $insert->bind_param("iis", $plan_id, $row['id'], $meal_type);
        $insert->execute();
    }
}

/* ===============================
   7️⃣ INSERT RANDOM MEALS
   =============================== */
insertMeals($conn, $plan_id, $goal, 'breakfast', 6);
insertMeals($conn, $plan_id, $goal, 'lunch', 6);
insertMeals($conn, $plan_id, $goal, 'snack', 4);
insertMeals($conn, $plan_id, $goal, 'dinner', 6);

/* ===============================
   8️⃣ RESPONSE
   =============================== */
echo json_encode([
    "status" => true,
    "message" => "Diet plan generated successfully",
    "total_calories" => $totalCalories
]);
