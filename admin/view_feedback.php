<?php
include 'db_config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Feedback - BloodConnect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f9f9f9;
    }
    .navbar-brand {
      font-weight: bold;
      color: #dc3545 !important;
    }
    .feedback-container {
      padding: 30px;
    }
    h3 {
      margin-bottom: 20px;
    }
    .card {
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
          <a class="nav-link" href="admin_dashboard.php"><i class="bi bi-arrow-left-circle"></i> Go to Dashboard</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Feedback Content -->
<div class="container feedback-container">
  <h3 class="text-center text-danger">📬 User Feedback</h3>

  <?php
  $sql = "SELECT * FROM feedback ORDER BY id DESC";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo '
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title"><i class="bi bi-person-circle"></i> ' . htmlspecialchars($row['name']) . '</h5>
          <h6 class="card-subtitle mb-2 text-muted"><i class="bi bi-envelope-fill"></i> ' . htmlspecialchars($row['email']) . '</h6>
          <p class="card-text"><i class="bi bi-chat-left-text-fill"></i> ' . nl2br(htmlspecialchars($row['message'])) . '</p>
          <p class="text-end text-muted small"><i class="bi bi-clock"></i> ' . $row['submitted_at'] . '</p>
        </div>
      </div>';
    }
  } else {
    echo '<div class="alert alert-info text-center">No feedback messages found.</div>';
  }
  ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
