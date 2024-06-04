<?php require_once('includes/dbconnection.php');
session_start();
$pageTitle = "Community List";
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

            <title>ScholarInfo -- Community List</title>

            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
            <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.min.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                crossorigin="anonymous">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <style type="text/css">
                #tblCommunity_wrapper {
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

                                    <h3>Community List</h3>

                                </div>

                            <div class="card mb-3" id="form-body">

                                <div class="card-header">

                                 

                        <?php

                        require('includes/dbconnection.php');
                        $key = 0;

                        $sql = "SELECT * FROM community";

                        $result = mysqli_query($conn, $sql);

                        ?>


                        <table id="tblCommunity">

                            <thead>


                                <th>Community Name</th>
                                <th>Community Type</th>
                                <th>County</th>
                                <th>Sub County</th>
                                <th>Community Leader</th>
                                <th>Leader Phone Number</th>
                                <th>Leader Email</th>
                                <th>Assistant Leader Name</th>
                                <th>Assistant Phone Number</th>
                                <th>Assistant Leader Email</th>
                                <?php



                                ?>
                           
                            </thead>

                            <tbody>

                            <?php while ($user = mysqli_fetch_assoc($result)) { ?>

                                    <tr>

                                       

                                        <td>
                                        <?php echo $user['community_name']; ?>
                                        </td>

                                        <td>
                                        <?php echo $user['community_type']; ?>
                                        </td>
                                        <td>
                                        <?php echo $user['county']; ?>
                                        </td>
                                        <td>
                                        <?php echo $user['sub_county']; ?>
                                        </td>
                                        <td>
                                        <?php echo $user['cm_leader_name']; ?>
                                        </td>
                                        <td>
                                        <?php echo $user['cm_leader_phone']; ?>
                                        </td>
                                        <td>
                                        <?php echo $user['cm_leader_email']; ?>
                                        </td>
                                        <td>
                                        <?php echo $user['asscm_leader_name']; ?>
                                        </td>
                                        <td>
                                        <?php echo $user['asscm_leader_phone']; ?>
                                        </td>

                                        <td>
                                        <?php echo $user['asscm_leader_email']; ?>
                                        </td>


                                        


                                        </td>
                                    <?php if ($u->hasRole("Admin") || $u->hasRole("Editor")): ?>
                                            
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
        $('#tblCommunity').DataTable({
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