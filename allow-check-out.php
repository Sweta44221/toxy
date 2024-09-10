<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allow Check-Out</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

<?php
    include("navbar.php");
?>
    <div class="container">
        <h2>Allow Check-Out</h2>

        <?php
        if (isset($_SESSION['alert_message'])) {
            $alert_type = $_SESSION['alert_type'] ?? 'info';
            echo "<div class='alert alert-$alert_type'>" . $_SESSION['alert_message'] . "</div>";
            unset($_SESSION['alert_message']);
            unset($_SESSION['alert_type']);
        }
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>District</th>
                    <th>City</th>
                    <th>Purpose</th>
                    <th>Check-In Status</th>
                    <th>Check-Out Status</th>
                    <th>Date & Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="visitor-data">
                <!-- Real-time data will be loaded here -->
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        function fetchVisitorData() {
            fetch('fetch_visitors.php')
                .then(response => response.json())
                .then(data => {
                    let visitorData = '';
                    if (data.length > 0) {
                        data.forEach(visitor => {
                            visitorData += `<tr>
                                <td>${visitor.name}</td>
                                <td>${visitor.district}</td>
                                <td>${visitor.city}</td>
                                <td>${visitor.purpose}</td>
                                <td>${visitor.check_in_status}</td>
                                <td>${visitor.check_out_status}</td>
                                <td>${visitor.date_time}</td>
                                <td>
                                    <form method='POST' action='allow-check-out.php' style='display:inline;'>
                                        <input type='hidden' name='check_out_id' value='${visitor.id}'>
                                        <button type='submit' class='btn btn-success'>Allow Check-Out</button>
                                    </form>
                                </td>
                            </tr>`;
                        });
                    } else {
                        visitorData = '<tr><td colspan="8">No visitors are currently checked in.</td></tr>';
                    }
                    document.getElementById('visitor-data').innerHTML = visitorData;
                });
        }

        // Fetch data every 5 seconds
        setInterval(fetchVisitorData, 5000);

        // Fetch data when the page loads
        fetchVisitorData();
    </script>
</body>

</html>
