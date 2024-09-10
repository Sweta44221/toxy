<?php
session_start();
include("../conn.php"); // Include your database connection

// Initialize variables for ID and Password
$generated_id = "";
$generated_password = "";

// Function to generate a simple, memorable ID and password
function generateIdAndPassword($name) {
    $id = strtolower(str_replace(' ', '', $name)) . rand(100, 999);
    $password = 'guard@' . rand(1000, 9999);
    return [$id, $password];
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $address = $conn->real_escape_string($_POST['address']);
    $dob = $conn->real_escape_string($_POST['dob']);
    $id_proof_type = $conn->real_escape_string($_POST['id_proof_type']);
    
    // File Upload Logic
    $target_dir = "guard_data/";
    $id_proof_file = $target_dir . basename($_FILES["id_proof_file"]["name"]);
    
    if (move_uploaded_file($_FILES["id_proof_file"]["tmp_name"], $id_proof_file)) {
        // File successfully uploaded
    } else {
        $_SESSION['alert_message_guard'] = "Error uploading file.";
        $_SESSION['alert_type'] = "danger";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    // Generate ID and password
    list($generated_id, $generated_password) = generateIdAndPassword($name);

    $password_hash = password_hash($generated_password, PASSWORD_DEFAULT);

    // Insert data into database
    $sql = "INSERT INTO guards (name, email, phone, address, dob, id_proof_type, id_proof_file, generated_id, generated_password)
            VALUES ('$name', '$email', '$phone', '$address', '$dob', '$id_proof_type', '$id_proof_file', '$generated_id', '$password_hash')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert_message_guard'] = "Guard registered successfully! Generated ID: $generated_id, Password: $generated_password";
        $_SESSION['alert_type'] = "success";
    } else {
        $_SESSION['alert_message_guard'] = "Error: " . $conn->error;
        $_SESSION['alert_type'] = "danger";
    }

    $conn->close();
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
