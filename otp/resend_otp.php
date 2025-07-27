<?php
// resend_otp.php
session_start();
include('../admin/db_config.php'); // Use your existing DB connection

// Function to generate and send new OTP
function resendOTP($email, $conn) {
    // 1. Generate new 6-digit OTP
    $new_otp = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
    $expires_at = date('Y-m-d H:i:s', strtotime('+10 minutes'));
    
    // 2. Update in database
    $stmt = $conn->prepare("UPDATE otp_verification 
                          SET otp = ?, created_at = NOW(), expires_at = ?
                          WHERE email = ?");
    $stmt->bind_param("sss", $new_otp, $expires_at, $email);
    $stmt->execute();
    
    // 3. Send email
    $subject = "Your New Verification Code";
    $message = "Your new OTP is: $new_otp\nValid for 10 minutes";
    $headers = "From: no-reply@blooddonation.com";
    
    if (mail($email, $subject, $message, $headers)) {
        return true;
    }
    return false;
}

// Main execution
if (isset($_GET['email'])) {
    $email = $_GET['email'];
    
    // Verify email exists in unverified donors
    $check = $conn->prepare("SELECT email FROM donors WHERE email = ? AND is_verified = 0");
    $check->bind_param("s", $email);
    $check->execute();
    
    if ($check->get_result()->num_rows > 0) {
        // Resend OTP
        if (resendOTP($email, $conn)) {
            header("Location: email_verification.html?email=".urlencode($email)."&resend=success");
        } else {
            header("Location: email_verification.html?email=".urlencode($email)."&error=send_failed");
        }
    } else {
        header("Location: register.html?error=invalid_email");
    }
    exit();
} else {
    header("Location: register.html");
    exit();
}
?>
<?php if (isset($_GET['resend']) && $_GET['resend'] === 'success'): ?>
<div class="success">New OTP sent successfully!</div>
<?php endif; ?>

<?php if (isset($_GET['error']) && $_GET['error'] === 'send_failed'): ?>
<div class="error">Failed to resend OTP. Please try again.</div>
<?php endif; ?>

