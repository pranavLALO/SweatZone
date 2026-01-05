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

$stmt = $conn->prepare(
    "SELECT height_cm, weight_kg, gender, age
     FROM user_body_profile
     WHERE user_id = ?"
);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo json_encode([
        "status" => false,
        "message" => "Body profile not found"
    ]);
    exit;
}

$profile = $result->fetch_assoc();

echo json_encode([
    "status" => true,
    "body_profile" => $profile
]);
