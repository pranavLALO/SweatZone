<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/api_helper.php';

header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['email']) || !isset($data['otp']) || !isset($data['new_password'])) {
    ApiHelper::sendResponse(false, "Email, OTP, and new password are required");
}

$email = trim($data['email']);
$otp = trim($data['otp']);
$newPassword = $data['new_password'];

// Verify OTP again just to be secure (prevents brute-force direct calls)
$stmt = $conn->prepare("SELECT id, reset_otp, reset_expires FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    ApiHelper::sendResponse(false, "Invalid email address.");
}

$user = $result->fetch_assoc();

if ($user['reset_otp'] !== $otp) {
    ApiHelper::sendResponse(false, "Invalid OTP.");
}

$expiresStr = $user['reset_expires'];
if (!$expiresStr || strtotime($expiresStr) < time()) {
    ApiHelper::sendResponse(false, "OTP Expired.");
}

// All checks passed! Hash the new password and update.
$hash = password_hash($newPassword, PASSWORD_BCRYPT);
$userId = $user['id'];

// Clear the OTP so it can't be reused, and securely apply the new password hash
$updateStmt = $conn->prepare("UPDATE users SET password = ?, reset_otp = NULL, reset_expires = NULL WHERE id = ?");
$updateStmt->bind_param("si", $hash, $userId);

if ($updateStmt->execute()) {
    ApiHelper::sendResponse(true, "Password successfully reset! You may now login.");
} else {
    ApiHelper::sendResponse(false, "Failed to update password completely.");
}
?>
