<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allow Check-In</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php
    include("navbar.php");
?>

    <a href="index.php"><button class="btn my-4 btn-danger">Back</button></a>

    <div class="container p-3">
        <h2>Approve Visitors</h2>
        <?php
        if (isset($_SESSION['alert_message'])) {
            echo '<div class="alert alert-' . $_SESSION['alert_type'] . '">' . $_SESSION['alert_message'] . '</div>';
            unset($_SESSION['alert_message']);
            unset($_SESSION['alert_type']);
        }
        ?>
        <table class="table" id="visitorTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>District</th>
                    <th>City</th>
                    <th>Purpose</th>
                    <th>Check-in Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="visitorTableBody">
                <tr><td colspan='6'>Loading data...</td></tr>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">© 2024 Garruda Technologies. All rights reserved. | Privacy Policy | Terms</span>
        </div>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function fetchVisitors() {
            $.ajax({
                url: 'fetch_visitors.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var tbody = $('#visitorTableBody');
                    tbody.empty();

                    if (data.length > 0) {
                        $.each(data, function(index, visitor) {
                            var row = $('<tr>');
                            row.append('<td>' + visitor.name + '</td>');
                            row.append('<td>' + visitor.district + '</td>');
                            row.append('<td>' + visitor.city + '</td>');
                            row.append('<td>' + visitor.purpose + '</td>');
                            row.append('<td>' + visitor.check_in_status + '</td>');
                            row.append('<td><a href="approve_visitor.php?id=' + visitor.id + '" class="btn btn-success">Approve</a></td>');
                            tbody.append(row);
                        });
                    } else {
                        tbody.append('<tr><td colspan="6">No pending visitors.</td></tr>');
                    }
                }
            });
        }

        // Fetch visitors when the page loads
        $(document).ready(function() {
            fetchVisitors();

            // Fetch visitors every 2 seconds
            setInterval(fetchVisitors, 2000); // 2 seconds interval
        });
    </script>

</body>

</html>
