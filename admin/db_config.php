<?php
$host = "localhost";
$user = "root";       // Default user for Laragon/XAMPP
$password = "";       // Leave blank if not set
$database = "blood_donor_db"; // Ensure this DB exists in phpMyAdmin

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
