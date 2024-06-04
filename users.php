<?php
require_once('includes/dbconnection.php');
session_start();
$userData = $_SESSION['userData'];
$pageTitle = "Users List";
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';
$u = PrivilegedUser::getByEmail($userData['email']);

if (empty($userData) || (!$u->hasRole("Super_admin"))) {
    // If $userData is empty or user doesn't have "Admin" role, log out the user
    header('Location: userAccount.php?logoutSubmit=1');
    exit();
} else {
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ScholarInfo --Users</title>
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
        <?php
        @include "includes/head.php";
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

                <div class="container-fluid px-4" style="margin-top:80px !important;">
                    <div class="container">
                        <div class="row mb-2">
                            <div class="col-md-9">
                                <h3>Users List</h3>
                            </div>

                        </div>
                        <?php


                        if (!empty($_SESSION["insertRole"])) {

                            // Echo the success message
                            echo '<div class = "alert alert-success alert-dismissible fade show" role="alert">
<i data-feather="alert-circle"></i>';
                            echo $_SESSION["insertRole"];
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
</div>';
                            if (isset($_SESSION['insertRole'])) {
                                unset($_SESSION['insertRole']);
                            }
                        } else if (!empty($_SESSION['insertRoleError'])) {

                            // Echo the error message
                            echo '<div class = "alert alert-danger alert-dismissible fade show" role="alert">
<i data-feather="alert-circle"></i>';
                            echo $_SESSION["insertRoleError"];
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>

</div>';
                            if (isset($_SESSION['insertRoleError'])) {
                                unset($_SESSION['insertRoleError']);
                            }
                        }


                        ?>



                        <?php
                        require('includes/dbconnection.php');
                        $key = 0;
                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($conn, $sql);
                        ?>

                        <table id="tblStudent">
                            <thead>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php while ($user = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td>
                                            <?php echo ++$key; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['first_name'] . " " . $user['last_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['email'] ?>
                                        </td>

                                        <?php
                                        require_once 'model/Role.php';
                                        require_once 'model/Permission.php';
                                        require_once 'model/PrivilegedUser.php';

                                        $email = $user['email'];
                                        $sql_u = "SELECT * FROM user_role";
                                        $sql_r = "SELECT * FROM roles";
                                        $result_u = mysqli_query($conn, $sql_u);
                                        $result_r = mysqli_query($conn, $sql_r);

                                        if (mysqli_num_rows($result_u) > 0 && mysqli_num_rows($result_r) > 0) {
                                            $options_u = mysqli_fetch_all($result_u, MYSQLI_ASSOC);
                                            $options_r = mysqli_fetch_all($result_r, MYSQLI_ASSOC);
                                            $roles = array();

                                            foreach ($options_r as $option_r) {
                                                foreach ($options_u as $option) {
                                                    if ($option['user_id'] === $user["id"] && $option['role_id'] === $option_r['role_id']) {
                                                        $roles[] = $option_r['role_name'];
                                                        break;
                                                    }
                                                }
                                            }

                                            if (!empty($roles)) {
                                                ?>
                                                <td>
                                                    <?php echo implode(', ', $roles); ?>
                                                </td>
                                                <?php
                                            } else {
                                                ?>
                                                <td>
                                                    <?php echo "No Role"; ?>
                                                </td>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <td>
                                                <?php echo "No Role"; ?>
                                            </td>
                                            <?php
                                        }
                                        ?>


                                        <td>
                                            <?php

                                            $dateString = $user['created'];
                                            $formattedDate = date("Y-m-d", strtotime($dateString));
                                            echo $formattedDate;
                                            ?>
                                        </td>

                                        <td>
                                            <a href="update_user.php?id=<?php echo $user['id']; ?>"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>

                                            <button class="btn btn-danger btn-sm"
                                                onclick="deleteAllRoles(<?php echo $user['id']; ?>);"><i class="fa fa-trash"
                                                    aria-hidden="true"></i>

                                            </button>
                                            <button class="btn btn-danger btn-sm"
                                                onclick="deleteUser(<?php echo $user['id']; ?>);"><i
                                                    class="fas fa-user-times"></i></button>


                                            <script>
                                                function deleteAllRoles(userId) {
                                                    var confirmDelete = confirm("Are you sure you want to delete all roles associated with this user?");
                                                    if (confirmDelete) {
                                                        window.location.href = "delete_role.php?id=" + userId;
                                                    }
                                                }

                                                function deleteUser(userId) {
                                                    var confirmDelete = confirm("Are you sure you want to delete this user?");
                                                    if (confirmDelete) {
                                                        window.location.href = "delete_user.php?id=" + userId;
                                                    }
                                                }
                                            </script>







                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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

                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
                <script src="assets/js/sweetalert2.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#tblStudent').DataTable();

                        $("#form-body").hide();

                        $("#insert-btn").on('click', function () {
                            $("#form-body").toggle(500);
                        });

                        function validateForm() {
                            var isValid = true;

                            function validateField(inputElement, errorElement, errorMessage) {
                                var inputValue = inputElement.val().trim();
                                if (inputValue === "") {
                                    isValid = false;
                                    inputElement.addClass("is-invalid");
                                    errorElement.html(errorMessage);
                                } else {
                                    inputElement.removeClass("is-invalid");
                                    errorElement.html("");
                                }
                            }

                            validateField($('#schoolName'), $("#schoolName_err"), 'School name is required');
                            var schoolLevel = $("input[name='school_level']:checked").val();
                            if (!schoolLevel) {
                                isValid = false;
                                $("#schoolLevel_err").html("Please select a school level.");
                            } else {
                                $("#schoolLevel_err").html("");
                            }
                            var countyName = $("#cnty").val();
                            if (countyName === null || countyName === "") {
                                isValid = false;
                                $("#countyName_err").html('County name is required');
                            } else {
                                $("#countyName_err").html("");
                            }
                            var subCountyName = $("#sub_cnty").val();
                            if (subCountyName === null || subCountyName === "") {
                                isValid = false;
                                $("#subCountyName_err").html('Sub County name is required');
                            } else {
                                $("#subCountyName_err").html("");
                            }
                            return isValid;
                        }

                        $("#form-body").on('submit', function (e) {
                            e.preventDefault();

                            var isValid = validateForm();

                            if (isValid) {
                                var schoolName = $("input[name='school_name']").val();
                                var county = $("#cnty").val();
                                var subCounty = $("#sub_cnty").val();
                                var schoolLevel = $("input[name='school_level']:checked").val();

                                $.ajax({
                                    url: "insert_school_data.php",
                                    type: "POST",
                                    data: {
                                        school_name: schoolName,
                                        county: county,
                                        sub_county: subCounty,
                                        school_level: schoolLevel,
                                    },
                                    success: function (data) {
                                        alert("Data Inserted Successfully");
                                        $("#form-body").hide();
                                        location.reload();
                                    },
                                    error: function (xhr, status, error) {
                                        alert('Error: ' + error);
                                    }
                                });
                            }
                        });

                        // Clear validation styles when input fields change
                        $(".form-validation").on("input", function () {
                            $(this).removeClass("is-invalid");
                            $(this).siblings(".error-message").html('');
                        });
                    });
                </script>
    </body>

    </html>
<?php } ?>