<?php require_once('includes/dbconnection.php');
session_start();
$pageTitle = "Student List";
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
} else { ?>

        <!DOCTYPE html>

        <html>

        <head>

            <meta charset="utf-8">

            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title>ScholarInfo -- Student List</title>

            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
            <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.min.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <style type="text/css">
                #tblStudent_wrapper {
                    background-color: aliceblue !important;
                    padding: 1rem;
                    color: #000;
                }

                .error input {
                    border-color: red !important;
                    border-width: 2px !important;
                }

                .success input {
                    border-color: green !important;
                    border-width: 2px !important;
                }

                .error span {
                    color: red !important;
                }

                .success span {
                    color: green !important;
                }

                span.error {
                    color: red !important;
                }

                i {
                    font-weight: 900;
                    font-family: "Font Awesome 5 Free";
                }
            </style>
            <!-- core:js -->
            <script src="assets/vendors/core/core.js"></script>
            <!-- endinject -->

            <!-- Plugin js for this page -->
            <script src="assets/vendors/flatpickr/flatpickr.min.js"></script>
            <script src="assets/vendors/apexcharts/apexcharts.min.js"></script>
            <!-- End plugin js for this page -->

            <!-- inject:js -->
            <script src="assets/vendors/feather-icons/feather.min.js"></script>
            <script src="assets/js/template.js"></script>
            <!-- endinject -->

            <!-- Custom js for this page -->
            <script src="assets/js/dashboard-dark.js"></script>
            <!-- End custom js for this page -->

            <script>
                function findAge() {
                    var day = document.getElementById("dateOfBirth").value;
                    var DOB = new Date(day);
                    var today = new Date();
                    var Age = today.getTime() - DOB.getTime();
                    Age = Math.floor(Age / (1000 * 60 * 60 * 24 * 365.25));
                    if (Age >= 100 || Age < 1) {
                        document.getElementById("ageStudent").value = "";
                    } else {
                        document.getElementById("ageStudent").value = Age;
                    }

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

            <?php
            @include "includes/head.php"
                ?>
        </head>

        <body>

            <div class="main-wrapper">
                <!-- partial:partials/_sidebar.html -->
            <?php @include "includes/sidebar.php" ?>
                <!-- partial -->

                <div class="page-wrapper">
                    <!-- partial:partials/_navbar.html -->
                <?php @include "includes/header.php" ?>
                    <!-- partial -->

                    <div class="container-fluid" style="margin-top:80px !important;">

                        <div class="container">

                            <div class="row mb-2">

                                <div class="col-md-9">

                                    <h3>Student List</h3>

                                </div>

                            <div class="card mb-3" id="form-body">

                                <div class="card-header">

                                 

                        <?php

                        require('includes/dbconnection.php');
                        $key = 0;

                        $sql = "SELECT * FROM student WHERE verification_status='verified'";

                        $result = mysqli_query($conn, $sql);

                        ?>


                        <table id="tblStudent">

                            <thead>

                                <th>ID</th>

                                <th>Name</th>
                                <th>Gender</th>

                                <th>School</th>
                                <th>County</th>
                                <?php



                                ?>
                            <?php if ($u->hasRole("Admin") || $u->hasRole("Editor")) { ?>

                                    <th>Action</th>
                            <?php } ?>

                            </thead>

                            <tbody>

                            <?php while ($user = mysqli_fetch_assoc($result)) { ?>

                                    <tr>

                                        <td>
                                            <?php

                                            echo ++$key; ?>
                                        </td>

                                        <td>
                                        <?php echo $user['first_name'] . " " . $user['last_name']; ?>
                                        </td>

                                        <td>
                                        <?php echo $user['gender']; ?>
                                        </td>


                                        <td>
                                        <?php echo $user['school_name']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $school_name = isset($user['school_name']) ? $user['school_name'] : '';

                                            // Prepare the SQL statement with a parameter placeholder
                                            $sql_county = "SELECT county FROM school WHERE school_name = ?";

                                            $stmt = mysqli_prepare($conn, $sql_county);

                                            if ($stmt) {
                                                // Bind the parameter and execute the statement
                                                mysqli_stmt_bind_param($stmt, "s", $school_name);
                                                mysqli_stmt_execute($stmt);

                                                // Bind the result
                                                mysqli_stmt_bind_result($stmt, $county);

                                                if (mysqli_stmt_fetch($stmt)) {
                                                    // Output the fetched county
                                                    echo htmlspecialchars($county);
                                                } else {
                                                    // County not found or no result returned
                                                    echo 'County not found.';
                                                }

                                                // Close the statement after fetching the data
                                                mysqli_stmt_close($stmt);
                                            } else {
                                                // Error preparing the statement
                                                echo 'Error preparing statement: ' . mysqli_error($conn);
                                            }
                                            ?>


                                        </td>
                                    <?php if ($u->hasRole("Admin") || $u->hasRole("Editor")): ?>
                                            <td>
                                            <?php if ($u->hasRole("Editor") || $u->hasRole("Admin")): ?>
                                                    <a href="update_data_form.php?id=<?php echo $user['id']; ?>"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                            <?php endif; ?>
                                            <?php if ($u->hasRole("Admin")): ?>
                                                    <a href="delete_data.php?id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this student ?');">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                            <?php endif; ?>
                                            </td>
                                    <?php endif;
                            } ?>


                            </tbody>

                        </table>

                    </div>

                </div>


                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
                <script src="assets/js/sweetalert2.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>



                <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
                <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
                <script>
    $(document).ready(function () {
        $('#tblStudent').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        // Rest of your code for other functionalities

        $("#form-body").on('submit', function (e) {
            e.preventDefault();

            var isValid = validateForm();

            if (isValid) {
                // Your AJAX request for form submission
            }
        });

        // Clear validation styles when input fields change
        $(".form-validation").on("input", function () {
            $(this).removeClass("is-invalid");
            $(this).siblings(".error-message").html('');
        });

        $("#ongoingRadio, #dropoutRadio").change(function () {
            var dropoutRadio = $("#dropoutRadio");
            var ongoingRadio = $("#ongoingRadio");
            var dropoutReason = $("#dropoutReason");
            var otherDropoutReason = $("#otherDropoutReason");

            if (dropoutRadio.is(":checked")) {
                dropoutReason.removeAttr("disabled");
                otherDropoutReason.removeAttr("disabled");
            } else if (ongoingRadio.is(":checked")) {
                dropoutReason.attr("disabled", true);
                otherDropoutReason.attr("disabled", true);
                dropoutReason.removeClass("is-invalid");
                otherDropoutReason.removeClass("is-invalid");
                $("#reason_err").text("");
            }
        });
    });
</script>

        </body>

        </html>
<?php } ?>