<?php
session_start();
session_unset();
session_destroy();

// Set logout message
session_start(); // Start again to set new session var
$_SESSION['logout_message'] = "Admin successfully logged out.";

// Redirect to intermediate page
header("Location: admin_redirect.php");
exit();
?>
