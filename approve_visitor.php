<?php
session_start();
include 'config.php'; // Ensure you have your database connection here

if (isset($_GET['id'])) {
    $visitor_id = $conn->real_escape_string($_GET['id']);

    // Update the admin status to "Approved"
    $sql = "UPDATE visitors SET admin_status = 'Approved' WHERE id = '$visitor_id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert_message'] = "Visitor approved successfully!";
        $_SESSION['alert_type'] = "success";
    } else {
        $_SESSION['alert_message'] = "Error: " . $conn->error;
        $_SESSION['alert_type'] = "danger";
    }
}

$conn->close();

// Redirect back to the approve visitors page
header("Location: allow-check-in.php");
exit();
?>
