<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guard Registration</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            width: 60%;
            margin: auto;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .form-container {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<?php
include("navbar.php");
?>

<div class="container form-container my-5 shadow">
    <h2 class="text-center mb-4">Guard Registration Form</h2>

    <!-- Display Alert Message -->
    <?php if (isset($_SESSION['alert_message_guard'])): ?>
        <div class="alert alert-<?= $_SESSION['alert_type'] ?>">
            <?= $_SESSION['alert_message_guard'] ?>
        </div>
        <?php unset($_SESSION['alert_message_guard']); ?>
    <?php endif; ?>

    <form action="guard_add_process.php" method="POST" enctype="multipart/form-data">
        <!-- Name -->
        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" class="form-control rounded-pill" placeholder="Enter full name" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" class="form-control rounded-pill" placeholder="Enter email address" required>
        </div>

        <!-- Phone Number -->
        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="text" name="phone" id="phone" class="form-control rounded-pill" placeholder="Enter phone number" required>
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" id="address" class="form-control rounded-pill" placeholder="Enter address" required>
        </div>

        <!-- Date of Birth -->
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            <input type="date" name="dob" id="dob" class="form-control rounded-pill" required>
        </div>

        <!-- ID Proof Type -->
        <div class="form-group">
            <label for="id_proof_type">ID Proof Type</label>
            <select name="id_proof_type" id="id_proof_type" class="form-control rounded-pill" required>
                <option value="Aadhaar">Aadhaar Card</option>
                <option value="PAN">PAN Card</option>
            </select>
        </div>

        <!-- Upload ID Proof -->
        <div class="form-group">
            <label for="id_proof_file">Upload ID Proof</label>
            <input type="file" name="id_proof_file" id="id_proof_file" class="form-control rounded-pill" required>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary btn-block rounded-pill">Register Guard</button>
    </form>
</div>



    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">© 2024 Garruda Technologies. All rights reserved. | Privacy Policy | Terms</span>
        </div>
    </footer>

</body>
</html>
