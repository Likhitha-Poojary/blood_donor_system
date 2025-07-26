<?php
session_start();
$message = "";

if (isset($_SESSION['logout_message'])) {
    $message = $_SESSION['logout_message'];
    unset($_SESSION['logout_message']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logging Out</title>
    <script>
        // Show alert and then redirect
        window.onload = function() {
            alert("<?php echo $message; ?>");
            window.location.href = "../index.html"; // Now go to your unchanged login page
        }
    </script>
</head>
<body>
</body>
</html>
