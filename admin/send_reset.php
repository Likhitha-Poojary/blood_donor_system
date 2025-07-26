<?php
include 'db_config.php'; // connect to DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Check if email exists in admin table
    $stmt = $conn->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // ✅ Found email – in real use, send reset link here
        echo "<h2 style='color:green;'>Password reset link sent to: $email</h2>";
    } else {
        // ❌ Email not found
        echo "<h2 style='color:red;'>No admin found with email: $email</h2>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<h2>Access Denied!</h2>";
}
?>
