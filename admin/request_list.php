<?php
include('../admin/db_config.php');

// Fetch all requests from the search_requests table
$sql = "SELECT * FROM search_requests ORDER BY search_time DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Search Requests</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white px-4 shadow">
  <a class="navbar-brand" href="#" style="color: #b71c1c;"><i class="bi bi-droplet-half"></i> BloodConnect
    </a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
      <li class="nav-item">
        <a class="btn btn-outline-danger btn-sm me-2" href="../index.html"><i class="bi bi-house-door"></i> Home</a>
      </li>
      <li class="nav-item">
          <a class="btn btn-outline-danger btn-sm me-2" href="admin_dashboard.php"><i class="bi bi-arrow-left-circle"></i> Go to Dashboard</a>
        </li>
    </ul>
  </div>
</nav>

<div class="container">
  <h3 class="mb-4 mt-4">Search Requests Log</h3>

  <?php if ($result->num_rows > 0): ?>
    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped align-middle">
        <thead class="table-danger">
          <tr>
            <th>ID</th>
            <th>City</th>
            <th>Blood Group</th>
            <th>Searched At</th>
            <th>Search Time</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['id']) ?></td>
              <td><?= isset($row['address']) ? htmlspecialchars($row['address']) : 'N/A' ?></td>
              <td><?= isset($row['blood_group']) ? htmlspecialchars($row['blood_group']) : 'N/A' ?></td>
              <td><?= isset($row['searched_at']) ? htmlspecialchars($row['searched_at']) : 'N/A' ?></td>
              <td><?= isset($row['search_time']) ? htmlspecialchars($row['search_time']) : 'N/A' ?></td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  <?php else: ?>
    <p class="text-muted">No search requests found.</p>
  <?php endif; ?>
</div>

</body>
</html>
