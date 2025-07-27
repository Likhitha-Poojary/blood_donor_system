<?php
session_start();
require_once 'connection.php'; // Make sure this uses MySQLi

function generateOTP() {
    return str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $otp = generateOTP();
    $created_at = date('Y-m-d H:i:s');
    $expires_at = date('Y-m-d H:i:s', strtotime('+10 minutes'));

    try {
        // MySQLi uses bind_param() instead of bindParam()
        $stmt = $conn->prepare("INSERT INTO otp_verification (email, otp, created_at, expires_at) 
                               VALUES (?, ?, ?, ?)
                               ON DUPLICATE KEY UPDATE 
                               otp = ?, created_at = ?, expires_at = ?");
        
        // 'sssssss' = 7 string parameters
        $stmt->bind_param('sssssss', $email, $otp, $created_at, $expires_at, 
                                 $otp, $created_at, $expires_at);
        
        $stmt->execute();
        
        // Email sending code remains the same...
        $subject = "Your Verification Code";
        $message = "Your OTP is: $otp (Valid for 10 minutes)";
        $headers = "From: no-reply@yourdomain.com";
        
        if (mail($email, $subject, $message, $headers)) {
            header("Location: email_verification.html?email=" . urlencode($email));
            exit();
        } else {
            throw new Exception("Email sending failed");
        }
        
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        header("Location: register.html?error=otp_failed");
        exit();
    }
} else {
    header("Location: register.html");
    exit();
}