<?php
include 'db_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Blood Requests - BloodConnect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .navbar-brand {
      font-weight: bold;
      color: #dc3545 !important;
    }
    .container {
      margin-top: 40px;
    }
    table th {
      background-color: #dc3545;
      color: #fff;
    }
    h3 {
      margin-bottom: 25px;
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
          <a class="nav-link" href="admin_dashboard.php"><i class="bi bi-arrow-left-circle"></i> Go to Dashboard</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#" onclick="exportPDF()"><i class="bi bi-file-earmark-arrow-down-fill"></i> Export PDF</a>
      </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Blood Requests Content -->
<div class="container">
  <h3 class="text-center text-danger">📄 Blood Request List</h3>

  <div class="table-responsive">
    <table class="table table-bordered table-hover align-middle text-center">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Contact</th>
          <th>Email</th>
          <th>Blood Group</th>
          <th>Location</th>
          <th>Reason</th>
          <th>Date Requested</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM blood_requests ORDER BY requested_at DESC";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>
              <td>' . $row['id'] . '</td>
              <td>' . htmlspecialchars($row['name']) . '</td>
              <td>' . htmlspecialchars($row['phone']) . '</td>
              <td>' . htmlspecialchars($row['email']) . '</td>
              <td>' . htmlspecialchars($row['blood_group']) . '</td>
              <td>' . htmlspecialchars($row['location']) . '</td>
              <td>' . htmlspecialchars($row['reason']) . '</td>
              <td>' . $row['requested_at'] . '</td>
            </tr>';
          }
        } else {
          echo '<tr><td colspan="8" class="text-center">No blood requests found.</td></tr>';
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Export Function -->
  <script>
    function exportPDF() {
      const element = document.getElementById("requestTable");
      html2pdf().from(element).set({
        margin: 0.5,
        filename: 'Blood_Requests_Report.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
      }).save();
    }
  </script>
</body>
</html>
