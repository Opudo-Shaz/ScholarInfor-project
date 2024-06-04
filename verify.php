<?php
require_once('includes/dbconnection.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = $_POST['student_id'];
    $verification_status = $_POST['verification_status'];
    $remarks = $_POST['remarks'];

    // In this example, we assume that you have a session or authentication system to get the user ID.
    // Replace this with the actual user ID retrieval logic based on your system.
    $verified_by = 1; // Replace with the actual user ID.

    // Insert data into student_verification
    $verification_date = date('Y-m-d');
    $insert_query = "INSERT INTO student_verification (student_id, verification_status, verification_date, verified_by, remarks) VALUES ($student_id, '$verification_status', '$verification_date', $verified_by, '$remarks')";

    if (mysqli_query($conn, $insert_query)) {
        // Update the student table's verification_status
        $update_query = "UPDATE student SET verification_status = '$verification_status' WHERE id = $student_id";

        if (mysqli_query($conn, $update_query)) {
            // Set success message in session variable
            $_SESSION['verification_success'] = true;
        } else {
            // Set error message in session variable
            $_SESSION['verification_error'] = true;
        }
    } else {
        // Set error message in session variable
        $_SESSION['verification_error'] = true;
    }

    mysqli_close($conn);
// ...

// Redirect back to the previous page with the student ID and a query parameter indicating success or error
header('Location: verification.php?id=' . $student_id . '&result=' . (isset($_SESSION['verification_success']) ? 'success' : 'error'));
exit();
} else {
    // Redirect to the verification form
    header('Location: verification.php');
    exit();
}
?>
