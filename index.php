<?php

include("config.php");

// Fetch visitor data
$sql = "SELECT * FROM visitors";
$result = $conn->query($sql);

// Variables to store counts for different categories
$totalVisitors = 0;
$totalCheckIn = 0;
$totalCheckOut = 0;
$admissionVisits = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $totalVisitors++;
        if ($row["check_in_status"] == "Checked In") {
            $totalCheckIn++;
        }
        if ($row["check_out_status"] == "Checked Out") {
            $totalCheckOut++;
        }
        if ($row["purpose"] == "Admissions") {
            $admissionVisits++;
        }
    }
}

// Fetch total number of guards
$queryGuards = "SELECT COUNT(*) as totalGuards FROM guards"; // Replace 'guards' with the actual table name for guards
$resultGuards = $conn->query($queryGuards);
$rowGuards = $resultGuards->fetch_assoc();
$totalGuards = $rowGuards['totalGuards'];

// Fetch total number of faulty records
$queryFaculty = "SELECT COUNT(*) as totalFaculty FROM faculty"; // Replace 'faulty' with the actual table name for faulty records
$resultFaculty = $conn->query($queryFaculty);
$rowFaculty = $resultFaculty->fetch_assoc();
$totalFaculty = $rowFaculty['totalFaculty'];

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <?php
    include("navbar.php");
    ?>
    <!-- Displaying cards with dynamic counts -->
    <div class="card-container">
        <div class="card blue">
            <div class="card-body">
                <p>Total Visitors</p>
                <h1><?php echo $totalVisitors; ?></h1>
            </div>
        </div>
        <div class="card yellow">
            <div class="card-body">
                <p>Total Check-In</p>
                <h1><?php echo $totalCheckIn; ?></h1>
            </div>
        </div>
        <div class="card green">
            <div class="card-body">
                <p>Total Check-Out</p>
                <h1><?php echo $totalCheckOut; ?></h1>
            </div>
        </div>
        <div class="card purple">
            <div class="card-body">
                <p>Admission Visits</p>
                <h1><?php echo $admissionVisits; ?></h1>
            </div>
        </div>
        <div class="card blue">
            <div class="card-body">
                <p>Total Guard</p>
                <h1><?php echo $totalGuards; ?></h1>
            </div>
        </div>
        <div class="card yellow">
            <div class="card-body">
                <p>Total Faulty</p>
                <h1><?php echo $totalFaculty; ?></h1>
            </div>
        </div>

    </div>

    <div class="dashboard">
        <a href="add_visitor.php">
            <div class="dashboard-item">
                <img src="users3_add.png" alt="Add visitors">
                <h6>Add Visitors</h6>
            </div>
        </a>
        <a href="allow-check-in.php">
            <div class="dashboard-item">
                <img src="checkin.png" alt="Allow checkin">
                <h6>Allow Checkin</h6>
            </div>
        </a>
        <a href="allow-check-out.php">
            <div class="dashboard-item">
                <img src="checkout.png" alt="Allow checkout">
                <h6>Allow Checkout</h6>
            </div>
        </a>
        <a href="report.php">
            <div class="dashboard-item">
                <img src="report.webp" alt="Report">
                <h6>Report</h6>
            </div>
        </a>
        <a href="add_guard.php">
            <div class="dashboard-item">
                <img src="addguard.png" alt="Add Guard">
                <h6>Add Guard</h6>
            </div>
        </a>
        <a href="add-faculty.php">
            <div class="dashboard-item">
                <img src="addfaculty.png" alt="Add Faculty">
                <h6>Add Faculty</h6>
            </div>
        </a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>