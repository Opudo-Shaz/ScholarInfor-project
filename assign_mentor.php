<?php
require_once('includes/dbconnection.php');
session_start();
$pageTitle = "Assign Mentor";
$userData = $_SESSION['userData'];
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';
$u = PrivilegedUser::getByEmail($userData['email']);

if (empty($userData) || !($u->hasRole("Admin") || $u->hasRole("Super_admin"))) {
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
    <title>Assign Mentor</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
    <link rel="stylesheet" type="text css" href="assets/css/sweetalert.min.css">
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
      <div class="page-content">
        <div class="container-fluid">
          <div class="card p-4 rounded-3">
                            <h3>Assign Mentor</h3>
                      
                    <div class="container">

                    <?php
                        // Display success or error message
                        if (isset($_GET['message'])) {
                            $message = $_GET['message'];
                            $status = ($_GET['status'] == 'success') ? 'alert-success' : 'alert-danger';
                            echo '<div class="alert ' . $status . '">' . $message . '</div>';
                        }
             // Check if 'id' parameter is set in the URL
                    if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                        // Get the student ID from the URL
                        $studentId = $_GET['id'];

                        // Query the database to fetch the student's details
                        $sql = "SELECT s.id, s.first_name, s.last_name, s.student_status, s.school_name
                                FROM student AS s
                                WHERE s.id = ?";
                        
                        $stmt = mysqli_prepare($conn, $sql);

                        if ($stmt) {
                            mysqli_stmt_bind_param($stmt, "i", $studentId);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            if ($row = mysqli_fetch_assoc($result)) {
                                // Display student details in a table
                                echo '<h6>Student Details</h6>';
                                echo '<table class="table table-bordered">';
                                echo '<tr><th>ID</th><td>' . $row['id'] . '</td></tr>';
                                echo '<tr><th>First Name</th><td>' . $row['first_name'] . '</td></tr>';
                                echo '<tr><th>Last Name</th><td>' . $row['last_name'] . '</td></tr>';
                                echo '<tr><th>Student Status</th><td>' . $row['student_status'] . '</td></tr>';
                                echo '<tr><th>School</th><td>' . $row['school_name'] . '</td></tr>';
                                echo '</table>';

                                // Create a form to select a mentor
                                echo '<form method="post" action="insert_student_mentor.php">';
                                echo '<div class="form-group">';
                                echo '<label for="mentorSelect">Select a Mentor:</label>';
                                echo '<select class="form-control" id="mentorSelect" name="mentor_id">';
                                
                                // Query the database to fetch mentor names and IDs
                                $mentorSql = "SELECT id, mentor_name FROM mentors";
                                $mentorResult = mysqli_query($conn, $mentorSql);
                                if (mysqli_num_rows($mentorResult) > 0) {
                                    while ($mentorRow = mysqli_fetch_assoc($mentorResult)) {
                                        echo '<option value="' . $mentorRow['id'] . '">' . $mentorRow['mentor_name'] . '</option>';
                                    }
                                }
                                echo '</select>';
                                echo '</div>';
                                echo '<input type="hidden" name="student_id" value="' . $studentId . '">';
                                // Include a hidden field to submit the student ID
                                echo '<button type="submit" class="btn btn-primary">Submit</button>';
                                echo '</form>';
                            } else {
                                echo 'Student not found.';
                            }
                        }
                    }
                    ?>
                    
                    <br>
                    <a href="javascript:history.go(-1)" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php } ?>
