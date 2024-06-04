<?php require_once('includes/dbconnection.php');
session_start();
$pageTitle = "Student Details";
$userData = $_SESSION['userData'];
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';
$u = PrivilegedUser::getByEmail($userData['email']);

if (empty($userData) || !($u->hasRole("Admin") || $u->hasRole("Editor")|| (!$u->hasRole("Super_admin")))) {
    // If $userData is empty or the user doesn't have any of the specified roles, log out the user
    header('Location: userAccount.php?logoutSubmit=1');
    exit();
} else if (strlen($_SESSION['sessData'] == 0)) {
    header('location:logout.php');
} else {
?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Student Details</title>
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.min.css">
    <link href="https://cdn.jsdelivr.net/npm bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            Age = Math floor(Age / (1000 * 60 * 60 * 24 * 365.25));
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

    <?php @include "includes/head.php" ?>
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

                            <h3>Student Details</h3>

                        </div>
                    </div>

                    <?php

                    require('includes/dbconnection.php');
                    $key = 0;

                    $sql = "SELECT * FROM student WHERE student_status = 'ongoing' AND verification_status='verified'"; // Only select students with status 'ongoing'

                    $result = mysqli_query($conn, $sql);

                    ?>

                    <table id="tblStudent">
                        <thead>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>School</th>
                            <th>County</th>
                            <th>Community Name</th>
                        </thead>
                        <tbody>
                            <?php while ($user = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo ++$key; ?></td>
                                    <td>
                                        <a href="student_details1.php?id=<?php echo $user['id']; ?>">
                                            <?php echo $user['first_name'] . " " . $user['last_name']; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $user['gender']; ?></td>
                                    <td><?php echo $user['school_name']; ?></td>
                                   
                                    <td>
                                        <?php
                                        $school_name = isset($user['school_name']) ? $user['school_name'] : '';
                                        $sql_county = "SELECT county FROM school WHERE school_name = ?";
                                        $stmt = mysqli_prepare($conn, $sql_county);

                                        if ($stmt) {
                                            mysqli_stmt_bind_param($stmt, "s", $school_name);
                                            mysqli_stmt_execute($stmt);
                                            mysqli_stmt_bind_result($stmt, $county);

                                            if (mysqli_stmt_fetch($stmt)) {
                                                echo htmlspecialchars($county);
                                            } else {
                                                echo 'County not found.';
                                            }

                                            mysqli_stmt_close($stmt);
                                        } else {
                                            echo 'Error preparing statement: ' . mysqli_error($conn);
                                        }
                                        ?>
                                    </td>

                                    <td><?php echo $user['community_name']; ?></td>

                                </tr>
                            <?php endwhile; ?>
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
                    $('#tblStudent').DataTable();
                });
            </script>
        </div>
    </div>
</body>
</html>
<?php } ?>
