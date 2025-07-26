<?php
session_start();
include("db_config.php");

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.html");
    exit();
}

// Fetch all admins
$query = "SELECT id, name, email, role, contact FROM admins";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Accounts</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f8f9fa;
        }
        h2 {
            color: #333;
        }
        .btn-back {
            background-color: #28a745;
            color: white;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn-back:hover {
            background-color: #218838;
        }
        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

<a class="btn-back" href="admin_dashboard.php">&larr; Back to Dashboard</a>

<h2>Admin Accounts</h2>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Contact</th>
    </tr>
  </thead>
  <tbody>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($admin = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($admin['id']) . "</td>";
            echo "<td>" . htmlspecialchars($admin['name']) . "</td>";
            echo "<td>" . htmlspecialchars($admin['email']) . "</td>";
            echo "<td>" . htmlspecialchars($admin['role']) . "</td>";
            echo "<td>" . htmlspecialchars($admin['contact']) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No admin accounts found.</td></tr>";
    }
    ?>
  </tbody>
</table>

</body>
</html>
