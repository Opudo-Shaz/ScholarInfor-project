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
                        <h3 class="pb-2">Add Sponsors</h3>
                        <form role="form" method="post" action="sponsor_process.php" class="w-100">
                            <?php
                            if (!empty($_SESSION["insertSponsor"])) {
                                echo '<div class = "alert alert-success alert-dismissible fade show" role="alert">
                                <i data-feather="alert-circle"></i>';
                                echo $_SESSION["insertSponsor"];
                                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                            </div>';
                                if (isset($_SESSION['insertSponsor'])) {
                                    unset($_SESSION['insertSponsor']);
                                }
                            } else if (!empty($_SESSION['insertSponsorError'])) {
                                echo '<div class = "alert alert-danger alert-dismissible fade show" role="alert">
                                <i data-feather="alert-circle"></i>';
                                echo $_SESSION["insertSponsorError"];
                                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
                            </div>';
                                if (isset($_SESSION['insertSponsorError'])) {
                                    unset($_SESSION['insertSponsorError']);
                                }
                            }

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                $sponsorName = $_POST["sponsor_name"];
                                $email = $_POST["email"];
                                $phoneNumber = $_POST["phone_number"];
                                $countryOfOrigin = $_POST["country_of_origin"];
                                $sponsorType = $_POST["sponsor_type"];
                                $additionalInfo = $_POST["additional_info"];

                                // Insert the sponsor data into the sponsors table
                                $insertSponsorQuery = "INSERT INTO sponsors (sponsor_name, email, phone_number, country_of_origin, sponsor_type, additional_info, created, modified) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";
                                // Execute the query and handle any errors
                            }
                            ?>
<!-- Sponsor Information Fields -->
<div class="mb-3 col-md-4">
    <label for="sponsor_name" class="form-label">Sponsor Full Names</label>
    <input type="text" name="sponsor_name" maxlength="100" placeholder="Sponsor Name" class="form-control" required>
</div>
<div class="mb-3 col-md-4">
    <label for="email" class="form-label">Email</label>
    <input type="email" name="email" maxlength="100" placeholder="Email" class="form-control" required>
</div>
<div class="mb-3 col-md-4">
    <label for="phone_number" class="form-label">Phone Number</label>
    <input type="text" name="phone_number" maxlength="15" placeholder="Phone Number" class="form-control" required>
</div>
<div class="mb-3 col-md-4">
        <label for="country_of_origin" class="form-label">Country of Origin</label>
        <select name="country_of_origin" class="form-control" required>
            <option value="" disabled selected>Select Country of Origin</option>
            <?php
            foreach ($countries as $country) {
                echo '<option value="' . $country . '">' . $country . '</option>';
            }
            ?>
        </select>
    </div><div class="mb-3 col-md-4">
    <label for="sponsor_type" class="form-label">Sponsor Type</label>
    <select name="sponsor_type" class="form-control" required>
        <option value="" disabled selected>Select Sponsor Type</option>
        <option value="Family">Family</option>
        <option value="Individual">Individual</option>
        <option value="Institutional">Organization</option>
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
        if (isset($_SESSION["insertSponsor"])) {
            echo "alert('" . $_SESSION["insertSponsor"] . "');";
            unset($_SESSION["insertSponsor"]);
        }
        ?>
    </script>
</body>
</html>