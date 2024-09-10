<?php
// Database credentials
$servername = "localhost";   // or the database server IP
$username = "root"; // your database username
$password = ""; // your database password
$dbname = "toxy";   // the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>
