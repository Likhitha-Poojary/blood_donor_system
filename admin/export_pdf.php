<?php
require_once '../fpdf/fpdf.php';
require_once 'db_config.php';

// Create new PDF document
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Donor List', 0, 1, 'C');
$pdf->Ln(5);

// Table headers
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(30, 10, 'Name', 1);
$pdf->Cell(15, 10, 'Age', 1);
$pdf->Cell(20, 10, 'Gender', 1);
$pdf->Cell(25, 10, 'Blood Group', 1);
$pdf->Cell(45, 10, 'Email', 1);
$pdf->Cell(35, 10, 'Phone', 1);
$pdf->Ln();

// Fetch data from DB
$result = mysqli_query($conn, "SELECT name, age, gender, blood_group, email, phone FROM donors");
$pdf->SetFont('Arial', '', 12);

while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(30, 10, $row['name'], 1);
    $pdf->Cell(15, 10, $row['age'], 1);
    $pdf->Cell(20, 10, $row['gender'], 1);
    $pdf->Cell(25, 10, $row['blood_group'], 1);
    $pdf->Cell(45, 10, $row['email'], 1);
    $pdf->Cell(35, 10, $row['phone'], 1);
    $pdf->Ln();
}

$pdf->Output();
?>
