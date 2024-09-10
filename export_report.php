<?php
include("config.php");

// Capture filter values
$day = isset($_POST['day']) ? $_POST['day'] : '';
$month = isset($_POST['month']) ? $_POST['month'] : '';
$year = isset($_POST['year']) ? $_POST['year'] : '';

// Query to filter data based on selected filters
$sql = "SELECT * FROM visitors WHERE 1=1";

if (!empty($day)) {
    $sql .= " AND DAY(date_time) = '$day'";
}
if (!empty($month)) {
    $sql .= " AND MONTH(date_time) = '$month'";
}
if (!empty($year)) {
    $sql .= " AND YEAR(date_time) = '$year'";
}

$result = $conn->query($sql);

// Check which export button was clicked
if (isset($_POST['export_pdf'])) {
    // Export to PDF
    require('fpdf.php');
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 10);

    // Table Header
    $pdf->Cell(10, 10, 'ID', 1);
    $pdf->Cell(30, 10, 'Name', 1);
    $pdf->Cell(30, 10, 'City', 1);
    $pdf->Cell(30, 10, 'Purpose', 1);
    $pdf->Cell(30, 10, 'Check-In', 1);
    $pdf->Cell(30, 10, 'Check-Out', 1);
    $pdf->Cell(35, 10, 'Date', 1);
    $pdf->Ln();

    // Table Data
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $pdf->Cell(10, 10, $row['id'], 1);
            $pdf->Cell(30, 10, $row['name'], 1);
            $pdf->Cell(30, 10, $row['city'], 1);
            $pdf->Cell(30, 10, $row['purpose'], 1);
            $pdf->Cell(30, 10, $row['check_in_status'], 1);
            $pdf->Cell(30, 10, $row['check_out_status'], 1);
            $pdf->Cell(35, 10, $row['date_time'], 1);
            $pdf->Ln();
        }
    }

    $pdf->Output('D', 'Visitor_Report.pdf');
} elseif (isset($_POST['export_excel'])) {
    // Export to Excel
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Visitor_Report.xls"');
    header('Cache-Control: max-age=0');

    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>City</th>
                <th>Purpose</th>
                <th>Check-In</th>
                <th>Check-Out</th>
                <th>Date</th>
            </tr>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['city']}</td>
                    <td>{$row['purpose']}</td>
                    <td>{$row['check_in_status']}</td>
                    <td>{$row['check_out_status']}</td>
                    <td>{$row['date_time']}</td>
                </tr>";
        }
    }

    echo "</table>";
}
?>
