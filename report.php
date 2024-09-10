<?php
include("navbar.php");
include("config.php");

// Initialize variables for filters
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
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visitor Report</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Visitor Report</h2>

        <!-- Filter Form -->
        <form method="post" action="">
            <div class="row">
                <div class="col-md-3">
                    <input type="number" name="day" class="form-control" placeholder="Day" value="<?php echo $day; ?>">
                </div>
                <div class="col-md-3">
                    <input type="number" name="month" class="form-control" placeholder="Month" value="<?php echo $month; ?>">
                </div>
                <div class="col-md-3">
                    <input type="number" name="year" class="form-control" placeholder="Year" value="<?php echo $year; ?>">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <!-- Report Table -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>District</th>
                    <th>City</th>
                    <th>Purpose</th>
                    <th>Check-In Status</th>
                    <th>Check-Out Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['district']}</td>
                                <td>{$row['city']}</td>
                                <td>{$row['purpose']}</td>
                                <td>{$row['check_in_status']}</td>
                                <td>{$row['check_out_status']}</td>
                                <td>{$row['date_time']}</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Export Buttons -->
        <div class="mt-3">
            <form action="export_report.php" method="post">
                <input type="hidden" name="day" value="<?php echo $day; ?>">
                <input type="hidden" name="month" value="<?php echo $month; ?>">
                <input type="hidden" name="year" value="<?php echo $year; ?>">
                <button type="submit" name="export_pdf" class="btn btn-danger">Export to PDF</button>
                <button type="submit" name="export_excel" class="btn btn-success">Export to Excel</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
