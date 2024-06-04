<?php
require_once('includes/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the student_id and sponsor_id from the form
    $student_id = $_POST['student_id'];
    $sponsor_id = $_POST['sponsor_id'];

     // Check if the sponsor is already assigned to the student in the student_sponsor table
     $checkAssignmentSql = "SELECT COUNT(*) FROM student_sponsor WHERE student_id = ? AND sponsor_id = ?";
     $checkAssignmentStmt = mysqli_prepare($conn, $checkAssignmentSql);
 
     if ($checkAssignmentStmt) {
         mysqli_stmt_bind_param($checkAssignmentStmt, "ii", $student_id, $sponsor_id);
         mysqli_stmt_execute($checkAssignmentStmt);
         $result = mysqli_stmt_get_result($checkAssignmentStmt);
         $count = mysqli_fetch_row($result)[0];
 
         if ($count > 0) {
             // sponsor is already assigned to the student
             $message = "sponsor is already assigned to the student.";
             $status = "error";
             header("Location: assign_sponsor.php?message=$message&status=$status");
             exit();
         }
 
         // Continue with the sponsor assignment
         mysqli_stmt_close($checkAssignmentStmt);
     } else {
         echo 'Failed to prepare the SQL statement for checking sponsor assignment.';
         exit();
     }
    // Fetch the sponsor name associated with the provided sponsor_id
    $getSponsorNameSql = "SELECT sponsor_name FROM sponsors WHERE id = ?";
    $stmt = mysqli_prepare($conn, $getSponsorNameSql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $sponsor_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        
        if ($row = mysqli_fetch_assoc($result)) {
            $sponsor_name = $row['sponsor_name'];

            // Insert the student-sponsor relationship into the student_sponsor table with the sponsor name
            $insertSql = "INSERT INTO student_sponsor (student_id, sponsor_id, sponsor_name) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insertSql);
            
            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "iis", $student_id, $sponsor_id, $sponsor_name);
                
                if (mysqli_stmt_execute($stmt)) {
                    // Insertion successful
                    $message = "Sponsor assigned successfully.";
                    $status = "success";
                    header("Location: assign_sponsor.php?message=$message&status=$status");
                    exit();
                } else {
                    // Insertion failed
                    $message = "Error assigning sponsor.";
                    $status = "error";
                    echo '<div class="alert alert-danger">' . $message . '</div>';
                }
            } else {
                echo 'Failed to prepare the SQL statement for insertion.';
            }
        } else {
            echo 'Sponsor not found for the provided sponsor_id.';
        }
    } else {
        echo 'Failed to prepare the SQL statement to fetch the sponsor name.';
    }
} else {
    echo 'Invalid request method.';
}
?>
