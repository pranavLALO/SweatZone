<?php
header("Content-Type: application/json");
require "../config/db.php";

$data = json_decode(file_get_contents("php://input"), true);

$user_id   = $data['user_id'] ?? 0;
$height_cm = $data['height_cm'] ?? 0;
$weight_kg = $data['weight_kg'] ?? 0;
$gender    = $data['gender'] ?? '';
$age       = $data['age'] ?? null;
$goal      = $data['goal'] ?? 'maintain';
$activity_level = $data['activity_level'] ?? 'moderate';

if ($user_id == 0 || $height_cm == 0 || $weight_kg == 0 || $gender == '') {
    echo json_encode([
        "status" => false,
        "message" => "All body details are required"
    ]);
    exit;
}

/* Check if profile already exists */
$check = $conn->prepare(
    "SELECT id FROM body_profiles WHERE user_id = ?"
);
$check->bind_param("i", $user_id);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    // UPDATE existing profile
    $stmt = $conn->prepare(
        "UPDATE body_profiles
         SET height_cm = ?, weight_kg = ?, gender = ?, age = ?, goal = ?, activity_level = ?
         WHERE user_id = ?"
    );
    if (!$stmt) {
        echo json_encode(["status" => false, "message" => "DB Prepare Error (Update): " . $conn->error]);
        exit;
    }
    $stmt->bind_param(
        "ddssssi",
        $height_cm,
        $weight_kg,
        $gender,
        $age,
        $goal,
        $activity_level,
        $user_id
    );
} else {
    // INSERT new profile
    $stmt = $conn->prepare(
        "INSERT INTO body_profiles
         (user_id, height_cm, weight_kg, gender, age, goal, activity_level)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    if (!$stmt) {
        echo json_encode(["status" => false, "message" => "DB Prepare Error (Insert): " . $conn->error]);
        exit;
    }
    $stmt->bind_param(
        "iddssss",
        $user_id,
        $height_cm,
        $weight_kg,
        $gender,
        $age,
        $goal,
        $activity_level
    );
}

if ($stmt->execute()) {
    echo json_encode([
        "status" => true,
        "message" => "Body profile saved successfully"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Failed to save body profile"
    ]);
}
