<?php
session_start();
include("db_config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Hashed password

    // SQL Injection prevention (Optional: use prepared statements for better security)
    $query = "SELECT * FROM admins WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $_SESSION['admin_email'] = $email;
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "<script>
            alert('Invalid email or password');
            window.location.href = 'admin_login.html';
        </script>";
    }
} else {
    // If accessed directly
    header("Location: admin_login.html");
    exit();
}
?>
