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
      background-color: #f9f9f9;
    }
    .navbar-brand {
      font-weight: bold;
    }
    .nav-link {
      color: #fff !important;
    }
    .nav-link:hover {
      text-decoration: underline;
    }
    .table-container {
      padding: 40px 20px;
    }
    h3 {
      margin-bottom: 20px;
    }
    .btn-export {
      float: right;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white px-4 shadow">
  <div class="container-fluid">
    <a class="navbar-brand text-danger fw-semibold" href="#">
      <i class="bi bi-droplet-half"></i> BloodConnect
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item me-2">
          <a class="btn btn-outline-danger btn-sm" href="../index.html">
            <i class="bi bi-house-door-fill"></i> Home
          </a>
        </li>
        <li class="nav-item me-2">
          <a class="btn btn-outline-danger btn-sm me-2" href="export_pdf.php" target="_blank">
            <i class="bi bi-file-earmark-pdf-fill"></i> Export PDF
        </a>

        </li>
        <li class="nav-item">
          <a class="btn btn-outline-danger btn-sm" href="admin_dashboard.php">
            <i class="bi bi-arrow-left-circle"></i>Got to Dashboard
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Donor Table -->
<div class="table-container">
  <h3 class="text-center text-danger"><i class="bi bi-people-fill"></i> Registered Donor List</h3>
  <div class="table-responsive">
    <table class="table table-striped table-hover table-bordered align-middle">
      <thead class="table-danger text-center">
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Age</th>
          <th>Gender</th>
          <th>Blood Group</th>
          <th>Phone</th>
          <th>Email</th>
          <th>Address</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php
        $sql = "SELECT * FROM donors ORDER BY id DESC";
        $result = mysqli_query($conn, $sql);
        $sn = 1;
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$sn}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['blood_group']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['address']}</td>
                  </tr>";
            $sn++;
          }
        } else {
          echo "<tr><td colspan='8'>No donors found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
