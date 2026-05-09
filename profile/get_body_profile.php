<?php
header("Content-Type: application/json");
require "../config/db.php";
require_once "../helpers/api_helper.php";

// Authenticate user
$userPayload = ApiHelper::authenticate();
$authUserId = $userPayload['user_id'];

$user_id = $authUserId; // Use authenticated ID instead of GET param for security

$stmt = $conn->prepare(
    "SELECT u.name, bp.height_cm, bp.weight_kg, bp.gender, bp.goal, bp.activity_level
     FROM body_profiles bp
     JOIN users u ON u.id = bp.user_id
     WHERE bp.user_id = ?"
);

if (!$stmt) {
    echo json_encode([
        "status" => false,
        "message" => "Query failed",
        "error" => $conn->error
    ]);
    exit;
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Fetch user name to show personalized default profile
    $name = "New User";
    $userStmt = $conn->prepare("SELECT name FROM users WHERE id = ?");
    $userStmt->bind_param("i", $user_id);
    $userStmt->execute();
    $userRes = $userStmt->get_result();
    if ($row = $userRes->fetch_assoc()) {
        $name = $row['name'];
    }

    // Return default empty profile so the App UI doesn't block the user with an "Error" screen
    echo json_encode([
        "status" => true,
        "body_profile" => [
            "name" => $name,
            "height_cm" => 170,
            "weight_kg" => 70,
            "gender" => "Male",
            "goal" => "maintain",
            "activity_level" => "intermediate"
        ]
    ]);
    exit;
}

$profile = $result->fetch_assoc();

// Map DB values to App Display values
$levelMapping = [
    'sedentary' => 'Beginner',
    'light' => 'Beginner',
    'moderate' => 'Intermediate',
    'active' => 'Advanced',
    'very_active' => 'Advanced'
];

$dbLevel = strtolower($profile['activity_level'] ?? '');
if (isset($levelMapping[$dbLevel])) {
    $profile['activity_level'] = $levelMapping[$dbLevel];
} else {
    // Fallback capitalizing
    $profile['activity_level'] = ucfirst($dbLevel); 
}

// Clean up Goal string
$profile['goal'] = str_replace('_', ' ', $profile['goal'] ?? 'maintain');

echo json_encode([
    "status" => true,
    "body_profile" => $profile
]);
