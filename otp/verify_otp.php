<?php
session_start();
include('../admin/db_config.php'); // Use the same DB connection as register.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Get the submitted OTP and email
    $submitted_otp = $_POST["otp"];
    $email = $_POST["email"]; // Passed from verification form

    // 2. Verify OTP exists and isn't expired
    $stmt = $conn->prepare("SELECT otp, created_at FROM otp_verification 
                           WHERE email = ? AND expires_at > NOW()");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        // OTP expired or doesn't exist
        header("Location: email_verification.html?email=".urlencode($email)."&error=expired");
        exit();
    }

    $row = $result->fetch_assoc();
    $stored_otp = $row['otp'];

    // 3. Compare OTPs
    if ($submitted_otp !== $stored_otp) {
        // Invalid OTP
        header("Location: email_verification.html?email=".urlencode($email)."&error=invalid");
        exit();
    }

    // 4. Mark donor as verified
    $update_stmt = $conn->prepare("UPDATE donors SET is_verified = 1, verified_at = NOW() 
                                 WHERE email = ?");
    $update_stmt->bind_param("s", $email);
    $update_stmt->execute();

    // 5. Clear used OTP
    $delete_stmt = $conn->prepare("DELETE FROM otp_verification WHERE email = ?");
    $delete_stmt->bind_param("s", $email);
    $delete_stmt->execute();

    // 6. Set session and redirect
    $_SESSION['verified_email'] = $email;
    $_SESSION['verified'] = true;
    
    header("Location: registration_success.php");
    exit();
} else {
    // Direct access without POST
    header("Location: register.php");
    exit();
}
?>