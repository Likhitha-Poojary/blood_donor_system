<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
  <style>
    body {
      background-color: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .navbar {
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .dashboard-title {
      font-weight: 600;
      color: #b71c1c;
    }

    .card {
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      background: linear-gradient(to right, #fff, #f9f9f9);
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
    }

    .card-icon {
      font-size: 2.5rem;
      color: #dc3545;
      margin-bottom: 10px;
    }

    .card-title {
      font-size: 1.3rem;
      font-weight: 600;
    }

    .btn-danger {
      border-radius: 20px;
      padding: 6px 20px;
      font-weight: 500;
    }

    .description {
      color: #6c757d;
      font-size: 1rem;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand fw-semibold" href="#" style="color: #b71c1c;">Admin Dashboard</a>
    
    <!-- Home Button -->
    <div class="ms-auto me-3">
      <a href="admin.php" class="btn btn-outline-danger btn-sm me-2">
      <i class="bi bi-person-circle"></i> Admin
    </a>
      <a href="../index.html" class="btn btn-outline-danger btn-sm me-2">
        <i class="bi bi-house-door-fill"></i> Home
      </a>

      <!-- Logout Button -->
      <a href="logout.php" class="btn btn-outline-danger btn-sm">
        Logout
      </a>
    </div>
  </div>
</nav>

  <!-- Welcome & Description -->
  <!-- Welcome & Description -->
<div class="container mt-5 text-center">
  <div class="row justify-content-center align-items-center">
    <div class="col-md-6">
      <h2 class="dashboard-title display-5 mb-2" style="color: #b21f2d;">👋 Welcome, Admin</h2>
      <p class="description lead">
        Manage blood donors, view reports, and handle feedback and requests.
      </p>
    </div>
  </div>
</div>


  <!-- Cards Section -->
  <div class="container mt-4">
    <div class="row g-4">

      <!-- Donor List -->
      <div class="col-md-7 col-lg-4">
        <div class="card text-center p-4">
          <div class="card-body">
            <div class="card-icon"><i class="bi bi-people-fill"></i></div>
            <h5 class="card-title">View Donor List</h5>
            <p class="card-text">Access and manage all registered blood donors.</p>
            <a href="donor_list.php" class="btn btn-danger">View Donors</a>
          </div>
        </div>
      </div>

      <!-- Reports -->
      <div class="col-md-7 col-lg-4">
        <div class="card text-center p-4">
          <div class="card-body">
            <div class="card-icon"><i class="bi bi-bar-chart-fill"></i></div>
            <h5 class="card-title">Reports</h5>
            <p class="card-text">Check reports on blood donations and donor activity.</p>
            <a href="reports.php" class="btn btn-danger">View Reports</a>
          </div>
        </div>
      </div>


      <!-- Request List -->
      <div class="col-md-7 col-lg-4">
        <div class="card text-center p-4">
          <div class="card-body">
            <div class="card-icon"><i class="bi bi-list-ul"></i></div>
            <h5 class="card-title">Request List</h5>
            <p class="card-text">Monitor incoming blood donation requests.</p>
            <a href="request_list.php" class="btn btn-danger">View Requests</a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
