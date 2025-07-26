<?php
// Include the DB connection
include('../admin/db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect data from form
    $name = $_POST["name"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $blood_group = $_POST["blood_group"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    // Prepare insert query
    $stmt = $conn->prepare("INSERT INTO donors (name, age, gender, blood_group, email, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssss", $name, $age, $gender, $blood_group, $email, $phone, $address);

    if ($stmt->execute()) {
        echo "✅ Donor registered successfully!";
    } else {
        echo "❌ Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
