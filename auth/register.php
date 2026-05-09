<?php
header("Content-Type: application/json");
require_once __DIR__ . "/../config/db.php";

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode([
        "status" => false,
        "message" => "Invalid JSON input"
    ]);
    exit;
}

$name = trim($data['name'] ?? '');
$email = trim($data['email'] ?? '');
$password = trim($data['password'] ?? '');

if ($name === '' || $email === '' || $password === '') {
    echo json_encode([
        "status" => false,
        "message" => "All fields are required"
    ]);
    exit;
}

$check = $conn->prepare("SELECT id FROM users WHERE email = ?");
$check->bind_param("s", $email);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    echo json_encode([
        "status" => false,
        "message" => "Email already registered"
    ]);
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
);
$stmt->bind_param("sss", $name, $email, $hashedPassword);

if ($stmt->execute()) {
    $newUserId = $conn->insert_id;

    require_once __DIR__ . "/../helpers/jwt_helper.php";

    $token = JwtHelper::generate([
        "user_id" => $newUserId,
        "email" => $email
    ]);

    echo json_encode([
        "status" => true,
        "message" => "Registration successful",
        "token" => $token,
        "user" => [
            "id" => $newUserId,
            "name" => $name,
            "email" => $email
        ]
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Registration failed"
    ]);
}
