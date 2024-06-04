<?php
@include("includes/head.php");
session_start();
error_reporting(0);
$pageTitle = "Student";
session_start();
include('includes/dbconnection.php');
$userData = $_SESSION['userData'];
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';
$u = PrivilegedUser::getByEmail($userData['email']);

// Fetch countries from the external API
// Initialize the cURL session
$ch = curl_init();

// Set the cURL options
curl_setopt($ch, CURLOPT_URL, "https://restcountries.com/v2/all");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL session and store the JSON response
$response = curl_exec($ch);

// Close the cURL session
curl_close($ch);

// Decode the JSON response
$countryData = json_decode($response, true);

// Initialize an empty array to store country names
$countries = array();

// Extract country names from the JSON data
foreach ($countryData as $country) {
    $countries[] = $country['name'];
}

// Sort the country names in alphabetical order
sort($countries);

if (empty($userData) || !($u->hasRole("Admin") || $u->hasRole("Super_admin"))) {
    // If $userData is empty or the user doesn't have any of the specified roles, log out the user
    header('Location: userAccount.php?logoutSubmit=1');
    exit();
} else if (strlen($_SESSION['sessData'] == 0)) {
    header('location:logout.php');
} else {
    ?>
   <body>
  <div class="main-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <?php @include "includes/sidebar.php" ?>
    <!-- partial -->

    <div class="page-wrapper">
      <!-- partial:partials/_navbar.html -->
      <?php @include "includes/header.php" ?>
      <!-- partial -->
      <div class="page-content">
        <div class="container-fluid">
          <div class="card p-4 rounded-3">
                        <h3 class="pb-2">Add Mentors</h3>
                        <form role="form" method="post" action="Mentor_process.php" class="w-100">
                            <?php
                            if (!empty($_SESSION["insertMentor"])) {
                                echo '<div class = "alert alert-success alert-dismissible fade show" role="alert">
                                <i data-feather="alert-circle"></i>';
                                echo $_SESSION["insertMentor"];
                                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                            </div>';
                                if (isset($_SESSION['insertMentor'])) {
                                    unset($_SESSION['insertMentor']);
                                }
                            } else if (!empty($_SESSION['insertMentorError'])) {
                                echo '<div class = "alert alert-danger alert-dismissible fade show" role="alert">
                                <i data-feather="alert-circle"></i>';
                                echo $_SESSION["insertMentorError"];
                                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                            </div>';
                                if (isset($_SESSION['insertMentorError'])) {
                                    unset($_SESSION['insertMentorError']);
                                }
                            }

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $MentorName = $_POST["mentor_name"];
                                $email = $_POST["email"];
                                $phoneNumber = $_POST["phone_number"];
                                $countryOfOrigin = $_POST["nationality"];
                                $MentorType = $_POST["mentor_group"];
                                $additionalInfo = $_POST["additional_info"];

                                // Insert the Mentor data into the Mentors table
                                $insertMentorQuery = "INSERT INTO Mentors (mentor_name, email, phone_number, nationality, mentor_group, additional_info, created, modified) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
                                // Execute the query and handle any errors
                            }
                            ?>
<!-- Mentor Information Fields -->
<div class="mb-3 col-md-4">
    <label for="mentor_name" class="form-label">Mentor Full Names</label>
    <input type="text" name="mentor_name" maxlength="100" placeholder="Mentor Name" class="form-control" required>
</div>
<div class="mb-3 col-md-4">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" maxlength="100" placeholder="Email" class="form-control" required>
</div>
<div class="mb-3 col-md-4">
    <label for="phone_number" class="form-label">Phone Number</label>
    <input type="text" name="phone_number" maxlength="10" placeholder="Phone Number" class="form-control" required>
</div>
<div class="mb-3 col-md-4">
        <label for="nationality" class="form-label">Nationality</label>
        <select name="nationality" class="form-control" required>
            <option value="" disabled selected>Select Country of Origin</option>
            <?php
            foreach ($countries as $country) {
                echo '<option value="' . $country . '">' . $country . '</option>';
            }
            ?>
        </select>
    </div><div class="mb-3 col-md-4">
    <label for="mentor_group" class="form-label">Mentor Group</label>
    <select name="mentor_group" class="form-control" required>
        <option value="" disabled selected>Select Mentor Group</option>
        <option value="Zuri Mentorship Program">Zuri Mentorship Program</option>
        <option value="Saka Mentorship Program">Saka Mentorship Program</option>
    </select>
</div>
<div class="mb-3 col-md-6">
    <label for="additional_info" class="form-label">Additional Information</label>
    <textarea class="form-control" name="additional_info" rows="3" placeholder="Additional Information"></textarea>
</div>
                        <div class=" row align-items-center mb-5 ms-3">
                            <div class="col">
                                <input type="submit" class="btn btn-primary justify-content-start text-uppercase" value="Submit" name="submit" />
                            </div>
                            <div class="col">
                                <input type="reset" class="btn btn-danger justify-content-end text-uppercase" name="reset" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <?php @include "includes/footer.php" ?>
    <script>
        function checkYear() {
            var year = document.getElementById("expectedCompDate").value;
            var chosenYear = new Date(year);
            var currentYear = new Date();
            var diff = currentYear.getTime() - chosenYear.getTime();
            if (diff > 0) {
                document.getElementById("expectedCompDate").value = "";
            } else {
                document.getElementById("expectedCompDate").value = year;
            }

        }
    </script>
    <!-- core:js -->
    <script src="assets/vendors/core/core.js"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="assets/vendors/flatpickr/flatpickr.min.js"></script>
    <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="assets/vendors/feather-icons/feather.min.js"></script>
    <script src="assets/js/template.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="assets/js/dashboard-dark.js"></script>
    <!-- End custom js for this page -->

    <?php
}
?>
<!-- JavaScript to show pop-up message if the session variable is set -->
<script>
        <?php
        if (isset($_SESSION["insertMentor"])) {
            echo "alert('" . $_SESSION["insertMentor"] . "');";
            unset($_SESSION["insertMentor"]);
        }
        ?>
    </script>
</body>
</html>