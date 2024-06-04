<?php
require_once('includes/dbconnection.php');
session_start();
$pageTitle = "Individual Student Records";
$userData = $_SESSION['userData'];
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';
$u = PrivilegedUser::getByEmail($userData['email']);

if (empty($userData) || !($u->hasRole("Admin") || $u->hasRole("Editor") || (!$u->hasRole("Super_admin")))) {
    // If $userData is empty or the user doesn't have any of the specified roles, log out the user
    header('Location: userAccount.php?logoutSubmit=1');
    exit();
} else if (strlen($_SESSION['sessData'] == 0)) {
    header('location:logout.php');
} else {
    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
        $studentId = $_GET['id'];

        // Fetch the student details for the selected student
        $sql = "SELECT * FROM student WHERE id = $studentId";
        $result = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
            $studentName = $row['first_name'] . " " . $row['middle_name'] . " " . $row['last_name'];
            $studentGender = $row['gender'];
            $studentSchool = $row['school_name'];

            // Fetch audit records for the selected student
            $auditSql = "SELECT * FROM student_audit WHERE student_id = $studentId";
            $auditResult = mysqli_query($conn, $auditSql);
        } else {
            // Student not found, redirect or display an error message
            header('Location: student_list.php'); // Redirect to the student list page or handle the error
            exit();
        }
    } else {
        // Invalid or missing student ID, redirect or display an error message
        header('Location: student_list.php'); // Redirect to the student list page or handle the error
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Individual Student Records</title>
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

        /* Additional custom styles for container layout */
        .container {
            margin-top: 80px;
        }

        .student-details {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .audit-table {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
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

            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <div class="student-details">
                            <h3>Individual Student Records - <?php echo $studentName; ?></h3>
                            <p><strong>Student Name:</strong> <?php echo $studentName; ?></p>
                            <p><strong>Gender:</strong> <?php echo $studentGender; ?></p>
                            <p><strong>School:</strong> <?php echo $studentSchool; ?></p>
                        </div>

                        <div class="audit-table">
                            <h4>Audit Records for <?php echo $studentName; ?></h4>
                            <table id="tblStudentAudit" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Date Modified</th>
                                        <th>Modified By</th>
                                        <th>Field Changed</th>
                                        <th>Old Value</th>
                                        <th>New Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($auditRow = mysqli_fetch_assoc($auditResult)): ?>
                                        <tr>
                                            <td><?php echo $auditRow['modified_date']; ?></td>
                                            <td><?php echo $auditRow['modified_by']; ?></td>
                                            <td><?php echo $auditRow['field_changed']; ?></td>
                                            <td><?php echo $auditRow['old_value']; ?></td>
                                            <td><?php echo $auditRow['new_value']; ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>                        <a href="javascript:history.go(-1)" class="btn btn-primary">Back</a>

            </div>
            
        </div>
        
    <!-- Add your JavaScript includes and scripts here -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"></script>
    <script src="assets/js/sweetalert2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Your additional JavaScript code if needed -->

    <script>
        // Your JavaScript code
    </script>
</body>

</html>
