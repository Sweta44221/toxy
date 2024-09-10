<?php
session_start();
include 'config.php'; // Ensure you have your database connection here

// Fetch visitors with "Pending" admin status
$sql = "SELECT id, name, district, city, purpose, check_in_status FROM visitors WHERE admin_status = 'Pending' AND check_in_status='Pending'";
$result = $conn->query($sql);

$visitors = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $visitors[] = $row;
    }
}

echo json_encode($visitors);
?>
