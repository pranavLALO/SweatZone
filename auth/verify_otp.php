<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/api_helper.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['email']) || !isset($data['otp'])) {
    ApiHelper::sendResponse(false, "Email and OTP are required");
}

$email = trim($data['email']);
$otp = trim($data['otp']);

$stmt = $conn->prepare("SELECT id, reset_otp, reset_expires FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    ApiHelper::sendResponse(false, "Invalid email address.");
}

$user = $result->fetch_assoc();

if ($user['reset_otp'] !== $otp) {
    ApiHelper::sendResponse(false, "The OTP you entered is strictly incorrect.");
}

$expiresStr = $user['reset_expires'];
if (!$expiresStr || strtotime($expiresStr) < time()) {
    ApiHelper::sendResponse(false, "This OTP has mathematically expired. Please request a new one.");
}

// Success
ApiHelper::sendResponse(true, "OTP Verified successfully!");
?>
