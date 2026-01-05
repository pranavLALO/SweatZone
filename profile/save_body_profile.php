<?php
header("Content-Type: application/json");
require "../config/db.php";

$data = json_decode(file_get_contents("php://input"), true);

$user_id   = $data['user_id'] ?? 0;
$height_cm = $data['height_cm'] ?? 0;
$weight_kg = $data['weight_kg'] ?? 0;
$gender    = $data['gender'] ?? '';
$age       = $data['age'] ?? null;

if ($user_id == 0 || $height_cm == 0 || $weight_kg == 0 || $gender == '') {
    echo json_encode([
        "status" => false,
        "message" => "All body details are required"
    ]);
    exit;
}

/* Check if profile already exists */
$check = $conn->prepare(
    "SELECT id FROM user_body_profile WHERE user_id = ?"
);
$check->bind_param("i", $user_id);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    // UPDATE existing profile
    $stmt = $conn->prepare(
        "UPDATE user_body_profile
         SET height_cm = ?, weight_kg = ?, gender = ?, age = ?
         WHERE user_id = ?"
    );
    $stmt->bind_param(
        "ddssi",
        $height_cm,
        $weight_kg,
        $gender,
        $age,
        $user_id
    );
} else {
    // INSERT new profile
    $stmt = $conn->prepare(
        "INSERT INTO user_body_profile
         (user_id, height_cm, weight_kg, gender, age)
         VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->bind_param(
        "iddsi",
        $user_id,
        $height_cm,
        $weight_kg,
        $gender,
        $age
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
