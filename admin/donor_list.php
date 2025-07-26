<?php
include 'db_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Donor List - BloodConnect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f7f7f7;
    }
    .navbar-brand {
      font-weight: bold;
      color: #dc3545 !important;
    }
    .table-container {
      padding: 30px;
    }
    h3 {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">🩸 BloodConnect</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../index.html"><i class="bi bi-house-door-fill"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="export_donor_pdf.php" target="_blank"><i class="bi bi-file-earmark-pdf-fill"></i> Export PDF</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_dashboard.php"><i class="bi bi-arrow-left-circle"></i> Go to Dashboard</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Donor Table -->
<div class="table-container">
  <h3 class="text-center text-danger">🩸 Donor List</h3>
  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle">
      <thead class="table-danger">
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Blood Group</th>
          <th>City</th>
          <th>Contact</th>
          <th>Email</th>
          <th>Last Donation</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM donors ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        $sn = 1;
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
            <td>{$sn}</td>
            <td>{$row['name']}</td>
            <td>{$row['blood_group']}</td>
            <td>{$row['city']}</td>
            <td>{$row['contact']}</td>
            <td>{$row['email']}</td>
            <td>{$row['last_donation_date']}</td>
          </tr>";
          $sn++;
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
