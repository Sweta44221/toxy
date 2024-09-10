<?php

session_start(); // Start the session to access the alert message

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gatepass Application</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php
include("navbar.php");
?>

    <a href="dashboard.php"><button class="btn my-4 btn-danger">Back</button></a>

    <div class="container p-3">
        <div class="container p-4 mt-5 rounded shadow">
            <h3 class="text-center bg-primary p-2 mb-4 rounded text-white">Visitor Registration</h3>

            <?php
            if (isset($_SESSION['alert_message'])) {
                echo '<div class="alert alert-' . $_SESSION['alert_type'] . ' alert-dismissible fade show" role="alert">'
                    . $_SESSION['alert_message'] .
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';

                // Unset the alert message after displaying it
                unset($_SESSION['alert_message']);
                unset($_SESSION['alert_type']);
            }
            ?>
            <form action="visitor_process.php" method="POST">
                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                </div>

                <!-- District -->
                <div class="form-group">
                    <label for="district">District</label>
                    <select id="districtDropdown" name="district" class="form-control" required>
                        <option value="">Select a District</option>
                        <option value="Agra">Agra</option>
                        <option value="Aligarh">Aligarh</option>
                        <option value="Ambedkar Nagar">Ambedkar Nagar</option>
                        <option value="Amethi">Amethi</option>
                        <option value="Amroha">Amroha</option>
                        <option value="Auraiya">Auraiya</option>
                        <option value="Ayodhya">Ayodhya</option>
                        <option value="Baghpat">Baghpat</option>
                        <option value="Bahraich">Bahraich</option>
                        <option value="Ballia">Ballia</option>
                        <option value="Balrampur">Balrampur</option>
                        <option value="Banda">Banda</option>
                        <option value="Bangarmau">Bangarmau</option>
                        <option value="Barabanki">Barabanki</option>
                        <option value="Bareilly">Bareilly</option>
                        <option value="Basti">Basti</option>
                        <option value="Bijnor">Bijnor</option>
                        <option value="Budaun">Budaun</option>
                        <option value="Bulandshahr">Bulandshahr</option>
                        <option value="Chandauli">Chandauli</option>
                        <option value="Chitrakoot">Chitrakoot</option>
                        <option value="Deoria">Deoria</option>
                        <option value="Etah">Etah</option>
                        <option value="Etawah">Etawah</option>
                        <option value="Faizabad">Faizabad</option>
                        <option value="Farrukhabad">Farrukhabad</option>
                        <option value="Fatehpur">Fatehpur</option>
                        <option value="Firozabad">Firozabad</option>
                        <option value="Gautam Buddha Nagar">Gautam Buddha Nagar</option>
                        <option value="Ghaziabad">Ghaziabad</option>
                        <option value="Ghazipur">Ghazipur</option>
                        <option value="Gonda">Gonda</option>
                        <option value="Gorakhpur">Gorakhpur</option>
                        <option value="Hamirpur">Hamirpur</option>
                        <option value="Hapur">Hapur</option>
                        <option value="Hardoi">Hardoi</option>
                        <option value="Hathras">Hathras</option>
                        <option value="Jalaun">Jalaun</option>
                        <option value="Jaunpur">Jaunpur</option>
                        <option value="Jhansi">Jhansi</option>
                        <option value="Kannauj">Kannauj</option>
                        <option value="Kanpur Dehat">Kanpur Dehat</option>
                        <option value="Kanpur Nagar">Kanpur Nagar</option>
                        <option value="Kushinagar">Kushinagar</option>
                        <option value="Lakhimpur Kheri">Lakhimpur Kheri</option>
                        <option value="Lalitpur">Lalitpur</option>
                        <option value="Lucknow">Lucknow</option>
                        <option value="Maharajganj">Maharajganj</option>
                        <option value="Mahoba">Mahoba</option>
                        <option value="Mainpuri">Mainpuri</option>
                        <option value="Mathura">Mathura</option>
                        <option value="Meerut">Meerut</option>
                        <option value="Mirzapur">Mirzapur</option>
                        <option value="Moradabad">Moradabad</option>
                        <option value="Muzaffarnagar">Muzaffarnagar</option>
                        <option value="Pilibhit">Pilibhit</option>
                        <option value="Pratapgarh">Pratapgarh</option>
                        <option value="Rae Bareli">Rae Bareli</option>
                        <option value="Rampur">Rampur</option>
                        <option value="Saharanpur">Saharanpur</option>
                        <option value="Sambhal">Sambhal</option>
                        <option value="Sant Kabir Nagar">Sant Kabir Nagar</option>
                        <option value="Shahjahanpur">Shahjahanpur</option>
                        <option value="Shamli">Shamli</option>
                        <option value="Shravasti">Shravasti</option>
                        <option value="Siddharthnagar">Siddharthnagar</option>
                        <option value="Sitapur">Sitapur</option>
                        <option value="Sonbhadra">Sonbhadra</option>
                        <option value="Sultanpur">Sultanpur</option>
                        <option value="Unnao">Unnao</option>
                        <option value="Varanasi">Varanasi</option>
                    </select>
                </div>

                <!-- City -->
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" name="city" id="city" placeholder="City">
                </div>

                <!-- Address -->
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your address" required></textarea>
                </div>

                <!-- Mobile Number -->
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter your mobile number" required>
                </div>

                <!-- Purpose -->
                <div class="form-group">
                    <label for="purpose">Purpose</label>
                    <select class="form-control" id="purpose" name="purpose" required>
                        <option value="">Select Purpose</option>
                        <option value="Admissions">Admissions</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <!-- Other Purpose Textbox -->
                <div class="form-group hidden" id="otherPurposeDiv">
                    <label for="otherPurpose">Please specify the purpose</label>
                    <input type="text" class="form-control" id="otherPurpose" name="otherPurpose" placeholder="Enter your purpose">
                </div>

                <!-- Webcam Video Feed -->
                <div class="form-group">
                    <label for="webcam">Capture Photo</label>
                    <div class="embed-responsive embed-responsive-4by3">
                        <video id="webcam" class="embed-responsive-item" autoplay></video>
                        <canvas id="canvas" style="display:none;"></canvas>
                    </div>
                    <button type="button" id="capture" class="btn btn-secondary mt-2">Capture Photo</button>
                </div>

                <!-- Display Captured Photo -->
                <div class="form-group">
                    <label for="photo">Captured Photo</label>
                    <img id="photo" src="#" alt="Captured Photo" class="img-fluid">
                    <input type="hidden" id="photoData" name="photoData">
                </div>

                <!-- Date and Time Stamp -->
                <div class="form-group">
                    <label for="dateTime">Date and Time</label>
                    <input type="text" class="form-control" id="dateTime" name="dateTime" readonly>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Submit</button>
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

    <script>
        // Show/Hide the Other Purpose textbox based on selection
        document.getElementById('purpose').addEventListener('change', function() {
            var otherPurposeDiv = document.getElementById('otherPurposeDiv');
            if (this.value === 'Other') {
                otherPurposeDiv.classList.remove('hidden');
                document.getElementById('otherPurpose').setAttribute('required', 'required');
            } else {
                otherPurposeDiv.classList.add('hidden');
                document.getElementById('otherPurpose').removeAttribute('required');
            }
        });


        // Function to format date and time
        function formatDateTime(date) {
            const year = date.getFullYear();
            const month = ('0' + (date.getMonth() + 1)).slice(-2); // Months are zero-based
            const day = ('0' + date.getDate()).slice(-2);
            const hours = ('0' + date.getHours()).slice(-2);
            const minutes = ('0' + date.getMinutes()).slice(-2);
            const seconds = ('0' + date.getSeconds()).slice(-2);
            return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        }

        // Function to update the date and time every second
        function updateDateTime() {
            const now = new Date();
            document.getElementById('dateTime').value = formatDateTime(now);
        }

        // Initial call to display date and time immediately
        updateDateTime();

        // Update the date and time every second
        setInterval(updateDateTime, 1000);
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const video = document.getElementById('webcam');
            const canvas = document.getElementById('canvas');
            const captureButton = document.getElementById('capture');
            const photo = document.getElementById('photo');
            const photoData = document.getElementById('photoData');

            // Get access to the webcam
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    video.srcObject = stream;
                })
                .catch(function(error) {
                    console.error("Error accessing webcam:", error);
                });

            // Capture the photo when the button is clicked
            captureButton.addEventListener('click', function() {
                const context = canvas.getContext('2d');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                context.drawImage(video, 0, 0, canvas.width, canvas.height);

                // Convert the canvas to a base64 string
                const imageDataURL = canvas.toDataURL('image/png');
                photo.src = imageDataURL;
                photo.style.display = 'block';
                photoData.value = imageDataURL; // Store the base64 image data in the hidden input
            });
        });
    </script>

</body>

</html>