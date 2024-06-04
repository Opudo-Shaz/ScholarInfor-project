<?php
session_start();

include_once "includes/dbconnection.php";
require_once "model/Role.php";
require_once "model/Permission.php";
require_once "model/PrivilegedUser.php";

$pageTitle = "Organizational Sponsors";
$userData = $_SESSION["userData"];
$user = PrivilegedUser::getByEmail($userData["email"]);

// Log out the user if $userData is empty, or if the user doesn't have any of the specified roles
if (empty($userData) || !($user->hasRole("Admin") || $user->hasRole("Editor") || (!$u->hasRole("Super_admin")))) {
    header("Location: userAccount.php?logoutSubmit=1");
    exit();
} elseif (strlen($_SESSION["sessData"] == 0)) {
    header("location:logout.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organizational Sponsors</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/sweetalert.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
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

        .table-container {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }
    </style>

    <?php @include_once "includes/head.php" ?>
</head>
<body>
<?php 
require("includes/dbconnection.php");

$idx = 0;
$query = "SELECT * FROM sponsors WHERE sponsor_type='Organization'";
$queryExecutionResult = mysqli_query($conn, $query);
?>

<div class="main-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <?php @include "includes/sidebar.php" ?>
    <!-- partial -->

    <div class="page-wrapper">
        <!-- partial:partials/_navbar.html -->
        <?php @include "includes/header.php" ?>
        <!-- partial -->

        <div class="container-fluid" style="margin-top: 80px !important;">

            <div class="container table-container">
                <h3>Organizational Sponsors</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Country Of Origin</th>
                            <th>Additional Information</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($user = mysqli_fetch_assoc($queryExecutionResult)) {
                        ?>
                        <tr>
                            <td><?php echo ++$idx; ?></td>
                            <td><?php echo $user["sponsor_name"]; ?></td>
                            <td><?php echo $user["email"] ?></td>
                            <td><?php echo $user["phone_number"] ?></td>
                            <td><?php echo $user["country_of_origin"] ?></td>
                            <td><?php echo $user["additional_info"] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a href="javascript:history.go(-1)" class="btn btn-primary">Back</a>

            </div>
        </div>
    </div>
</div>
</body>
</html>
