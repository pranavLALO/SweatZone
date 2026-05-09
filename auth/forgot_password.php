<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../helpers/api_helper.php';

// Import PHPMailer explicitly since Composer is missing
require_once __DIR__ . '/../helpers/PHPMailer/Exception.php';
require_once __DIR__ . '/../helpers/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/../helpers/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

header('Content-Type: application/json');

// Read Request
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['email']) || empty(trim($data['email']))) {
    ApiHelper::sendResponse(false, "Email is required");
}

$email = trim($data['email']);

// Check if email exists
$stmt = $conn->prepare("SELECT id, name FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Security Best Practice: Don't reveal if email explicitly doesn't exist to prevent enumeration.
    // However, since it's a closed fitness app, providing a direct error is usually better UX.
    ApiHelper::sendResponse(false, "No account found with that email address.");
}

$user = $result->fetch_assoc();
$userId = $user['id'];
$userName = $user['name'];

// Generate 6-digit OTP
$opt = sprintf("%06d", mt_rand(100000, 999999));

// Set Expiration (10 mins from now)
$expires = date('Y-m-d H:i:s', strtotime('+10 minutes'));

$updateStmt = $conn->prepare("UPDATE users SET reset_otp = ?, reset_expires = ? WHERE id = ?");
$updateStmt->bind_param("ssi", $opt, $expires, $userId);

if (!$updateStmt->execute()) {
    ApiHelper::sendResponse(false, "Failed to initiate password reset.");
}

// Send Email via PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'sweatzonerecovery@gmail.com';          
    $mail->Password   = 'tpdtjnbmiolrcixw'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('sweatzonerecovery@gmail.com', 'SweatZone Support');
    $mail->addAddress($email, $userName);

    $mail->isHTML(true);
    $mail->Subject = 'SweatZone Password Reset Code';
    
    // Beautiful HTML formatting
    $mail->Body    = "
        <div style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;'>
            <div style='max-width: 600px; margin: auto; background: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);'>
                <h2 style='color: #333333; text-align: center;'>SweatZone Account Recovery</h2>
                <p style='color: #555555; font-size: 16px;'>Hello $userName,</p>
                <p style='color: #555555; font-size: 16px;'>We received a request to reset the password for your SweatZone account. Enter the following 6-digit code in the app to securely rest your password.</p>
                
                <div style='text-align: center; margin: 30px 0;'>
                    <span style='background: #E0FF63; color: #1A1A1A; font-size: 32px; font-weight: bold; padding: 15px 30px; border-radius: 8px; letter-spacing: 5px;'>
                        $opt
                    </span>
                </div>
                
                <p style='color: #888888; font-size: 14px;'>This code will naturally expire in 10 minutes. If you did not request this reset, you can safely ignore this email.</p>
                <br>
                <hr style='border: none; border-top: 1px solid #eeeeee;'>
                <p style='color: #aaaaaa; font-size: 12px; text-align: center;'>&copy; " . date('Y') . " SweatZone. All gains reserved.</p>
            </div>
        </div>
    ";
    
    $mail->AltBody = "Hello $userName,\n\nYour SweatZone password reset code is: $opt\nThis code expires in 10 minutes.";

    $mail->send();
    
    ApiHelper::sendResponse(true, "A 6-digit recovery OTP has been sent securely to your email address!");
} catch (Exception $e) {
    ApiHelper::sendResponse(false, "Failed to send email. Mailer Error: {$mail->ErrorInfo}");
}
?>
