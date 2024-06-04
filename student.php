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

if (empty($userData) || !($u->hasRole("Admin") || $u->hasRole("Editor") || $u->hasRole("User") || (!$u->hasRole("Super_admin")))) {
    // If $userData is empty or user doesn't have any of the specified roles, log out the user
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
                            <h3 class="pb-2">ADD STUDENT DETAILS</h3>
                            <form role="form" method="post" action="student_process.php" class="w-100">
                                <?php
                                if (!empty($_SESSION["insertStudent"])) {
                                    echo '<div class = "alert alert-success alert-dismissible fade show" role="alert">
  <i data-feather="alert-circle"></i>';
                                    echo $_SESSION["insertStudent"];
                                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
      </div>';
                                    if (isset($_SESSION['insertStudent'])) {
                                        unset($_SESSION['insertStudent']);
                                    }
                                } else if (!empty($_SESSION['insertStudentError'])) {
                                    echo '<div class = "alert alert-danger alert-dismissible fade show" role="alert">
    <i data-feather="alert-circle"></i>';
                                    echo $_SESSION["insertStudentError"];
                                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
        </div>';
                                    if (isset($_SESSION['insertStudentError'])) {
                                        unset($_SESSION['insertStudentError']);
                                    }
                                }


                                ?>
                                <div class="row mt-2 align-items-center g-3 justify-content-between">
                                    <div class="col-md-4">
                                        <label for="first_name">First Name</label>
                                        <input type="text" name="first_name" maxlength="50" placeholder="First Name"
                                            class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="middle_name">Middle Name</label>
                                        <input type="text" name="middle_name" maxlength="50" class="form-control"
                                            placeholder="Middle Name">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="last_name">Last Name</label>
                                        <input type="text" name="last_name" maxlength="50" placeholder="Last Name"
                                            class="form-control" required />
                                    </div>
                                </div>
                                <div class="row align-items-center mt-3 g-3 mb-3">
                                    <fieldset class="col-md-4">
                                        <h6 class="form-label">Gender</h6>
                                        <label class="form-check-label px-2">
                                            <input type="radio" class="form-check-input me-2" name="gender" value="male" />
                                            Male
                                        </label>
                                        <label class="form-check-label px-2">
                                            <input type="radio" class="form-check-input me-2" name="gender" value="Female" />
                                            Female
                                        </label>

                                    </fieldset>
                                </div>


                        <div class="col-md-6 mb-3">
                            <label for="date" class="form-label">Date Of Birth</label>
                            <input type="date" id="date_of_birth" required name="date_of_birth" class="form-control"
                                onchange="findAge()" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" required readonly class="form-control" name="age" min="0" max="100" id="age"
                                placeholder="Enter Date Of Birth First" />
                        </div>
                        <div class="mb-3 col-md-6">
                        <div class="col-md-6 mb-3">
                        <div class="col-md-15 mb-3">
    <label for="Community" class="form-label">Community</label>
    <select class="form-select" name="community_name" id="Community">
        <option selected disabled>Select your community</option>
        <?php
        // Fetch community names and types from the database
        $sql = "SELECT community_name, community_type FROM community";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
            // Organize options into categories based on community_type
            $categories = [];
            foreach ($options as $option) {
                $categories[$option['community_type']][] = $option['community_name'];
            }

            // Output options within categories
            foreach ($categories as $category => $communityNames) {
                echo '<optgroup label="' . $category . '">';
                foreach ($communityNames as $communityName) {
                    echo '<option>' . $communityName . '</option>';
                }
                echo '</optgroup>';
            }
        } else {
            echo "No data found.";
        }
        ?>
    </select>
</div>

                            <label for="ageSelect" class="form-label">School</label>

                            <select class="form-select" name="school_name" id="ageSelect">
                                <option selected disabled>Select your school</option>

                                <?php
                                $sql = "SELECT school_name FROM school";

                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                } else {
                                    echo "No data found.";
                                }



                                foreach ($options as $option) {
                                    ?>
                                    <option>
                                    <?php echo $option['school_name']; ?>
                                    </option>
                                <?php
                                }
                                ?>


                            </select>
                        </div>
                        <div class=" mb-3 col-md-6">
                            <label for="expectedComp" class="form-label">Expected Completion Date</label>

                            <input type="date" name="expected_completion_date" class="form-control" id="expectedCompDate"
                                onmouseout="checkYear()" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Student Status</label>
                            <div class="mb-3 ps-4">
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input me-2" name="student_status" value="ongoing"
                                        id="ongoingRadio">
                                    <label class="form-check-label" for="ongoingRadio me-2"> Ongoing </label>
                                    <div class="form-check form-check-inline ms-2">
                                        <input type="radio" class="form-check-input me-2" name="student_status" value="dropout"
                                            id="dropoutRadio">
                                        <label class="form-check-label" for="dropoutRadio">
                                            Dropped out
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dropout_reason" class="form-label">In case you dropped out, Give a reason why?
                            </label>
                            <select class="form-control mb-3 " disabled id="dropoutReason" name="dropout_reason">
                                <option selected disabled>Select the reason</option>
                                <option>Pregnancy</option>
                                <option>School Fees</option>
                                <option>Tough Curriculum</option>
                                <option>By Choice</option>
                            </select>


                        </div>
                        <div class="col-md-7">
                            <h6 class="form-label">Other</h6>

                            <textarea class="form-control col-md-4" id="dropoutTextArea" rows="3" name="other_dropout_reason"
                                cols="5" disabled></textarea>
                        </div>
                        <div class="container ">
<br>
<br>
<div class="row align-items-center g-3 mt-3 ">
                                    <h6>Name of Parent/ Guardian</h6>
                                    <div class="col-md-4">
                                        <label for="guardian_first_name">First Name</label>
                                        <input type="text" name="guardian_first_name" maxlength="50" placeholder="First Name"
                                            class="form-control" required />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="middleNameParent">Middle Name</label>
                                        <input type="text" name="guardian_middle_name" maxlength="50" class="form-control"
                                            placeholder="Middle Name" />
                                    </div>
                                    <div class="col-md-4">
                                        <label for="lastNameParent">Last Name</label>
                                        <input type="text" name="guardian_last_name" maxlength="50" placeholder="Last Name"
                                            class="form-control" required />
                                    </div>
                                </div>

                                <h4>Contact Information</h4>
                                <div class="col-md-6">
                                <label for="Phone">Phone</label>
                                <input type="text" name="phone" maxlength="10" placeholder="Phone" class="form-control" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <br>
                                <label for="Email">Email</label>
                                <input type="email" name="email" maxlength="100" placeholder="Email" class="form-control" required />
                                </div>
                        </div>

                        <br>

                    <div class=" row align-items-center mb-5 ms-3">
                        <div class="col">
                            <input type="submit" class="btn btn-primary justify-content-start text-uppercase" value="submit"
                                name="submit" />
                        </div>
                        <div class="col">
                            <input type="reset" class="btn btn-danger justify-content-end text-uppercase" name="reset" />
                        </div>
                    </div>
                </div>






            </div>

            </form>
            </div>
            </div>
            </div>
            </div>
        <?php @include "includes/footer.php" ?>
            <script>
                function findAge() {
                    var day = document.getElementById("date_of_birth").value;
                    var DOB = new Date(day);
                    var today = new Date();
                    var Age = today.getTime() - DOB.getTime();
                    Age = Math.floor(Age / (1000 * 60 * 60 * 24 * 365.25));
                    document.getElementById("age").value = Age;
                }

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
            <script>
                $(function () {
                    $("#ongoingRadio, #dropoutRadio").change(function () {
                        // Disable the text area and select element
                        $("#dropoutTextArea").val("").attr("disabled", true);
                        $("#dropoutReason").attr("disabled", true);

                        // Check if the ongoing radio button is checked
                        if ($("#ongoingRadio").is(":checked")) {
                            // Focus the text area
                            $("#dropoutTextArea").focus();
                        } else {
                            // Enable the text area and select element
                            $("#dropoutTextArea").removeAttr("disabled");
                            $("#dropoutReason").removeAttr("disabled");
                            // Focus the text area
                            $("#dropoutTextArea").focus();
                        }
                    });
                });


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


</body>

</html>