<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Report - Blood Donor System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- html2pdf.js for Export -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

  <style>
    body {
      background-color: #f8f9fa;
    }
    .navbar-brand img {
      height: 40px;
    }
    .summary-card {
      background-color: #ffffff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    canvas {
      max-height: 300px;
    }
  </style>
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
        <a class="btn btn-outline-danger btn-sm me-2" href="#" onclick="exportPDF()"><i class="bi bi-file-earmark-arrow-down-fill"></i> Export PDF</a>
      </li>
      <li class="nav-item">
          <a class="btn btn-outline-danger btn-sm me-2" href="admin_dashboard.php"><i class="bi bi-arrow-left-circle"></i> Go to Dashboard</a>
        </li>
    </ul>
  </div>
</nav>

<!-- Report Section -->
<div class="container mt-4" id="reportSection">

  <h3 class="text-center mb-4">📊 Donor Statistics Report</h3>

  <!-- Summary Cards -->
  <div class="row text-center">
    <div class="col-md-4">
      <div class="summary-card">
        <h5>Total Donors</h5>
        <h2>124</h2>
      </div>
    </div>
    <div class="col-md-4">
      <div class="summary-card">
        <h5>Blood Requests</h5>
        <h2>37</h2>
      </div>
    </div>
    <div class="col-md-4">
      <div class="summary-card">
        <h5>Pending Feedbacks</h5>
        <h2>5</h2>
      </div>
    </div>
  </div>

  <!-- Blood Group Distribution Chart -->
  <div class="card mt-4">
    <div class="card-body">
      <h5 class="card-title text-center">Donor Distribution by Blood Group</h5>
      <canvas id="bloodChart"></canvas>
    </div>
  </div>

  <!-- Monthly Donations Chart -->
  <div class="card mt-4 mb-5">
    <div class="card-body">
      <h5 class="card-title text-center">Monthly Donations</h5>
      <canvas id="donationChart"></canvas>
    </div>
  </div>

</div> <!-- end #reportSection -->

<!-- Chart Scripts -->
<script>
  const bloodCtx = document.getElementById('bloodChart').getContext('2d');
  new Chart(bloodCtx, {
    type: 'bar',
    data: {
      labels: ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'],
      datasets: [{
        label: '# of Donors',
        data: [15, 8, 20, 5, 10, 3, 50, 13],
        backgroundColor: [
          '#dc3545', '#c82333', '#fd7e14', '#ffc107', 
          '#20c997', '#17a2b8', '#007bff', '#6f42c1'
        ],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0
          }
        }
      }
    }
  });

  const donationCtx = document.getElementById('donationChart').getContext('2d');
  new Chart(donationCtx, {
    type: 'bar',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May'],
      datasets: [{
        label: 'Donations',
        data: [12, 19, 8, 15, 11],
        backgroundColor: '#dc3545'
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false }
      }
    }
  });

  // PDF Export Function
  function exportPDF() {
    const element = document.getElementById("reportSection");
    html2pdf().from(element).set({
      margin: 0.5,
      filename: 'Donor_Report.pdf',
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    }).save();
  }
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
