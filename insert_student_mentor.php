<?php
require_once('includes/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the student_id and mentor_id from the form
    $student_id = $_POST['student_id'];
    $mentor_id = $_POST['mentor_id'];

    // Check if the mentor is already assigned to the student
    $checkAssignmentSql = "SELECT COUNT(*) FROM student_mentors WHERE student_id = ? AND mentor_id = ?";
    $checkAssignmentStmt = mysqli_prepare($conn, $checkAssignmentSql);

    if ($checkAssignmentStmt) {
        mysqli_stmt_bind_param($checkAssignmentStmt, "ii", $student_id, $mentor_id);
        mysqli_stmt_execute($checkAssignmentStmt);
        $result = mysqli_stmt_get_result($checkAssignmentStmt);
        $count = mysqli_fetch_row($result)[0];

        if ($count > 0) {
            // Mentor is already assigned to the student
            $message = "Mentor is already assigned to the student.";
            $status = "error";
            header("Location: assign_mentor.php?message=$message&status=$status");
            exit();
        }

        // Continue with the mentor assignment
        mysqli_stmt_close($checkAssignmentStmt);
    } else {
        echo 'Failed to prepare the SQL statement for checking mentor assignment.';
        exit();
    }

    // Fetch the mentor name associated with the provided mentor_id
    $getMentorNameSql = "SELECT mentor_name FROM mentors WHERE id = ?";
    $stmt = mysqli_prepare($conn, $getMentorNameSql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $mentor_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $mentor_name = $row['mentor_name'];

            // Insert the student-mentor relationship into the student_mentors table with the mentor name
            $insertSql = "INSERT INTO student_mentors (student_id, mentor_id, mentor_name) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $insertSql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "iis", $student_id, $mentor_id, $mentor_name);

                if (mysqli_stmt_execute($stmt)) {
                    // Insertion successful
                    $message = "Mentor assigned successfully.";
                    $status = "success";
                    header("Location: assign_mentor.php?message=$message&status=$status");
                    exit();
                } else {
                    // Insertion failed
                    $message = "Error assigning mentor.";
                    $status = "error";
                    echo '<div class="alert alert-danger">' . $message . '</div>';
                }
            } else {
                echo 'Failed to prepare the SQL statement for insertion.';
            }
        } else {
            echo 'Mentor not found for the provided mentor_id.';
        }
    } else {
        echo 'Failed to prepare the SQL statement to fetch the mentor name.';
    }
} else {
    echo 'Invalid request method.';
}
?>
