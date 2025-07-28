<?php
include('../admin/db_config.php');

// Get the blood group and address from the previous form (via POST or SESSION)
$bloodGroup = $_POST['blood_group'] ?? '';
$address = $_POST['address'] ?? '';

if ($bloodGroup && $address) {
    // Log the search query
    $insertLog = $conn->prepare("INSERT INTO search_requests (blood_group, address, searched_at) VALUES (?, ?, NOW())");
    $insertLog->bind_param("ss", $bloodGroup, $address);
    $insertLog->execute();

    // Fetch matching donors
    $stmt = $conn->prepare("SELECT name, age, gender, phone, email, blood_group, address FROM donors WHERE blood_group = ? AND address LIKE ?");
    $likeAddress = "%" . $address . "%";
    $stmt->bind_param("ss", $bloodGroup, $likeAddress);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    echo "<script>alert('Invalid search. Please try again.'); window.location.href='../index.html';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Admin-style Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white px-4 shadow">
        <div class="container-fluid">
            <a class="navbar-brand fw-semibold" href="#" style="color: #b71c1c;">Search Results</a>
            <div class="ms-auto me-3">
                <a href="../index.html" class="btn btn-outline-danger btn-sm me-2">
                    <i class="bi bi-house-door-fill"></i> Home
                </a>
                <a href="../search/search.html" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-speedometer2"></i> Back to Search
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h4 class="mb-3 text-center text-danger">Matching Donors for Blood Group: <strong><?= htmlspecialchars($bloodGroup) ?></strong> in <strong><?= htmlspecialchars($address) ?></strong></h4>
        <?php if ($result->num_rows > 0): ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle text-center">
                    <thead class="table-danger">
                        <tr>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Blood Group</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['age']) ?></td>
                                <td><?= htmlspecialchars($row['gender']) ?></td>
                                <td><?= htmlspecialchars($row['phone']) ?></td>
                                <td><?= htmlspecialchars($row['email']) ?></td>
                                <td><?= htmlspecialchars($row['blood_group']) ?></td>
                                <td><?= htmlspecialchars($row['address']) ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                No donors found matching your criteria.
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
</body>
</html>
