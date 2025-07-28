<?php
// Corrected path to config file
include('admin/db_config.php');

// Fetch admin details
$sql = "SELECT name, email, role, contact FROM admins LIMIT 1";
$result = $conn->query($sql);
$admin = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Contact Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" />
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 shadow">
    <div class="container-fluid">
      <a class="navbar-brand fw-semibold" href="#" style="color: #b71c1c;">Admin Information</a>
      <div class="ms-auto me-3">
        <a href="index.html" class="btn btn-outline-danger btn-sm me-2">
          <i class="bi bi-house-door-fill"></i> Home
        </a>
      </div>
    </div>
  </nav>

  <!-- Admin Contact Card -->
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-4">
          <div class="card-body">
            <h4 class="card-title text-center mb-3" style="color: #b71c1c;">Admin Contact Information</h4>
            <?php if ($admin): ?>
              <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Name:</strong> <?= htmlspecialchars($admin['name']) ?></li>
                <li class="list-group-item"><strong>Email:</strong> <?= htmlspecialchars($admin['email']) ?></li>
                <li class="list-group-item"><strong>Role:</strong> <?= htmlspecialchars($admin['role']) ?></li>
                <li class="list-group-item"><strong>Contact:</strong> <?= htmlspecialchars($admin['contact']) ?></li>
              </ul>
            <?php else: ?>
              <div class="alert alert-warning text-center mt-3">No admin data found.</div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
