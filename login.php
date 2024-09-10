<?php
// Start session to manage login state
session_start();

// Hardcoded ID and Password
$valid_id = "admin123";
$valid_password = "admin@123";

// Initialize error message variable
$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input values
    $id = $_POST['id'];
    $password = $_POST['password'];

    // Validate credentials
    if ($id === $valid_id && $password === $valid_password) {
        // Credentials are correct, set session and redirect
        $_SESSION['logged_in'] = true;
        header("Location: dashboard.php"); // Redirect to a dashboard or success page
        exit();
    } else {
        // Invalid credentials, set error message
        $error = "Invalid ID or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gatepass Application</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="login-form shadow">

        <!-- Display error message if login fails -->
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $error; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>


        <div class="upper">
            <img src="../Assets/logo.png" alt="" width="80px">
            <h3 class="fw-bold">Gate pass Application</h3>
            <hr>
            <h6 class="fw-bold">Admin Portal</h6>
        </div>

        <div class="login">
            <!-- Login Form -->
            <form action="" method="POST">
                <!-- ID Field -->
                <input type="text" name="id" placeholder="Enter ID" class="form-control rounded-pill mb-4" autocomplete="off" required>

                <!-- Password Field -->
                <input type="password" name="password" placeholder="Enter Password" class="form-control rounded-pill mb-4" autocomplete="off" required>

                <!-- Submit Button -->
                <button type="submit" class="btn login-btn btn-primary btn-block rounded-pill">Submit</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container text-center">
            <span class="text-muted">© 2024 Garruda Technologies. All rights reserved. | Privacy Policy | Terms</span>
        </div>
    </footer>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>