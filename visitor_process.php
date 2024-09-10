<?php

session_start(); // Start the session to store the alert message

include("config.php");

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $district = $conn->real_escape_string($_POST['district']);
    $city = $conn->real_escape_string($_POST['city']);
    $address = $conn->real_escape_string($_POST['address']);
    $mobile_number = $conn->real_escape_string($_POST['mobile']);
    $purpose = $conn->real_escape_string($_POST['purpose']);
    $other_purpose = !empty($_POST['otherPurpose']) ? $conn->real_escape_string($_POST['otherPurpose']) : null;
    
    // Handle the photo data
    $photoData = $_POST['photoData'];
    $photoPath = null; // Initialize the photo path variable
    
    if (!empty($photoData)) {
        // Decode the base64 image data
        $photoData = str_replace('data:image/png;base64,', '', $photoData);
        $photoData = str_replace(' ', '+', $photoData);
        $decodedData = base64_decode($photoData);

        // Define the path to save the image (make sure the 'uploads' directory exists and is writable)
        $photoPath = 'uploads/' . uniqid() . '.png';

        // Save the decoded image data to a file
        if (file_put_contents($photoPath, $decodedData) === false) {
            $_SESSION['alert_message'] = "Error saving the photo.";
            $_SESSION['alert_type'] = "danger";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }
    }

    // Insert query including the photo path
    $sql = "INSERT INTO visitors (name, district, city, address, mobile_number, purpose, other_purpose, photo_path, admin_status, check_in_status, check_out_status) 
            VALUES ('$name', '$district', '$city', '$address', '$mobile_number', '$purpose', '$other_purpose', '$photoPath', 'Pending', 'Not Checked In', 'Not Checked Out')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert_message'] = "New record created successfully!";
        $_SESSION['alert_type'] = "success";
    } else {
        $_SESSION['alert_message'] = "Error: " . $conn->error;
        $_SESSION['alert_type'] = "danger";
    }

    $conn->close();

    // Redirect back to the previous page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
