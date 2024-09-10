<?php
// Include database configuration
include("config.php");

// Function to generate a simple, memorable ID
function generateFacultyID($name) {
    $nameParts = explode(" ", $name);
    $initials = "";
    foreach ($nameParts as $part) {
        $initials .= strtoupper($part[0]);
    }
    $randomNumber = rand(100, 999);
    return $initials . $randomNumber;
}

// Function to generate a simple, memorable password
function generatePassword() {
    $words = ['Welcome', 'Teacher', 'Edu', 'Learn', 'School'];
    $word = $words[array_rand($words)];
    $randomNumber = rand(10, 99);
    return $word . $randomNumber;
}

// Initialize variables for form data
$name = $email = $phone = $gender = $dob = $address = $qualifications = $department = $date_of_joining = $message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $qualifications = $_POST['qualifications'];
    $department = $_POST['department'];
    $date_of_joining = $_POST['date_of_joining'];

    // Generate ID and Password
    $facultyID = generateFacultyID($name);
    $password = generatePassword();

    // Insert data into the database
    $sql = "INSERT INTO faculty (faculty_id, password, name, email, phone, gender, dob, address, qualifications, department, date_of_joining)
            VALUES ('$facultyID', '$password', '$name', '$email', '$phone', '$gender', '$dob', '$address', '$qualifications', '$department', '$date_of_joining')";

    if ($conn->query($sql) === TRUE) {
        $message = "Faculty added successfully! ID: $facultyID, Password: $password";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Faculty</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

    <?php include("navbar.php"); ?>

    <div class="container mt-5">
        <h2>Add New Faculty</h2>
        <?php if (!empty($message)) { ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php } ?>
        <form method="post" action="add-faculty.php">
            <!-- Include all the form fields here -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="qualifications" class="form-label">Qualifications</label>
                <input type="text" class="form-control" id="qualifications" name="qualifications" required>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <select class="form-select" id="department" name="department" required>
                    <option value="Computer Science">Computer Science</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                    <option value="Civil Engineering">Civil Engineering</option>
                    <option value="Electrical Engineering">Electrical Engineering</option>
                    <option value="Electronics and Communication Engineering">Electronics and Communication Engineering</option>
                    <option value="Chemical Engineering">Chemical Engineering</option>
                    <option value="Biotechnology">Biotechnology</option>
                    <option value="Pharmacy">Pharmacy</option>
                    <option value="Business Administration">Business Administration</option>
                    <option value="Economics">Economics</option>
                    <option value="Physics">Physics</option>
                    <option value="Chemistry">Chemistry</option>
                    <option value="Mathematics">Mathematics</option>
                    <option value="Humanities">Humanities</option>
                    <!-- Add other departments as needed -->
                </select>
            </div>
            <div class="mb-3">
                <label for="date_of_joining" class="form-label">Date of Joining</label>
                <input type="date" class="form-control" id="date_of_joining" name="date_of_joining" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Faculty</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
