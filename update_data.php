<?php
require_once('includes/dbconnection.php');
session_start();
function sanitizeInput($input)
{
    // Use FILTER_SANITIZE_STRING with FILTER_FLAG_NO_ENCODE_QUOTES
    $sanitized_input = filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    return $sanitized_input;
}

// Validate and sanitize inputs
$id = $_SESSION['id'];
$first_name = isset($_POST["first_name"]) ? sanitizeInput($_POST["first_name"]) : '';
$middle_name = isset($_POST["middle_name"]) ? sanitizeInput($_POST["middle_name"]) : null;
$last_name = isset($_POST["last_name"]) ? sanitizeInput($_POST["last_name"]) : '';
$gender = isset($_POST["gender"]) ? sanitizeInput($_POST["gender"]) : '';
$guardian_first_name = isset($_POST["guardian_first_name"]) ? sanitizeInput($_POST["guardian_first_name"]) : '';
$guardian_middle_name = isset($_POST["guardian_middle_name"]) ? sanitizeInput($_POST["guardian_middle_name"]) : null;
$guardian_last_name = isset($_POST["guardian_last_name"]) ? sanitizeInput($_POST["guardian_last_name"]) : '';
$age = isset($_POST["age"]) ? intval($_POST["age"]) : 0;
$date_of_birth = isset($_POST["date_of_birth"]) ? sanitizeInput($_POST["date_of_birth"]) : '';
$school_name = isset($_POST["school_name"]) ? sanitizeInput($_POST["school_name"]) : '';
$expected_completion_date = isset($_POST["expected_completion_date"]) ? sanitizeInput($_POST["expected_completion_date"]) : '';
$student_status = isset($_POST["student_status"]) ? sanitizeInput($_POST["student_status"]) : '';
$dropout_reason = isset($_POST["dropout_reason"]) ? sanitizeInput($_POST["dropout_reason"]) : null;
$other_dropout_reason = isset($_POST["other_dropout_reason"]) ? sanitizeInput($_POST["other_dropout_reason"]) : null;

// Building the UPDATE query using prepared statement
$query = "UPDATE student SET
            first_name = ?,
            middle_name = ?,
            last_name = ?,
            gender = ?,
            guardian_first_name = ?,
            guardian_middle_name = ?,
            guardian_last_name = ?,
            age = ?,
            date_of_birth = ?,
            school_name = ?,
            expected_completion_date = ?,
            student_status = ?,
            dropout_reason = ?,
            other_dropout_reason = ?
          WHERE id = ?";

// Prepare the statement
$stmt = mysqli_prepare($conn, $query);

// Bind parameters using prepared statement
mysqli_stmt_bind_param(
    $stmt,
    "ssssssisssssssi",
    $first_name,
    $middle_name,
    $last_name,
    $gender,
    $guardian_first_name,
    $guardian_middle_name,
    $guardian_last_name,
    $age,
    $date_of_birth,
    $school_name,
    $expected_completion_date,
    $student_status,
    $dropout_reason,
    $other_dropout_reason,
    $id
);

// Execute the prepared statement
if (mysqli_stmt_execute($stmt)) {
    echo "Student updated successfully.";
    header("location:student_list.php");
} else {
    echo "Error updating data: " . mysqli_error($conn);
}

// Close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>