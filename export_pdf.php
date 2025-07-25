<?php
require('libs/fpdf/fpdf.php');
require('config.php'); // If DB credentials are in config.php

$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, blood_group, age, gender, phone FROM donors";
$result = $conn->query($sql);

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Blood Donor List', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40, 10, 'Name', 1);
$pdf->Cell(30, 10, 'Blood Group', 1);
$pdf->Cell(20, 10, 'Age', 1);
$pdf->Cell(30, 10, 'Gender', 1);
$pdf->Cell(50, 10, 'Phone', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(40, 10, $row['name'], 1);
        $pdf->Cell(30, 10, $row['blood_group'], 1);
        $pdf->Cell(20, 10, $row['age'], 1);
        $pdf->Cell(30, 10, $row['gender'], 1);
        $pdf->Cell(50, 10, $row['phone'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No donor data found.', 1, 1, 'C');
}

$pdf->Output('D', 'donor_list.pdf');
$conn->close();
?>
