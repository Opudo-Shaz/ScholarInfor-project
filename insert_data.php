<?php
// includes/dbconnection.php
include('includes/dbconnection.php');

// Custom sanitizeInput function to sanitize input while preserving single quotes
function sanitizeInput($input)
{
    // Use FILTER_SANITIZE_STRING with FILTER_FLAG_NO_ENCODE_QUOTES
    $sanitized_input = filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    return $sanitized_input;
}

// Sanitize and validate inputs
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

// Prepare the SQL query using prepared statements
$sql = "INSERT INTO student (first_name, middle_name, last_name, gender,
    guardian_first_name, guardian_middle_name, guardian_last_name, age, date_of_birth, school_name, expected_completion_date,
    student_status, dropout_reason, other_dropout_reason)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Use PDO instead of mysqli
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param(
    "ssssssssssssss",
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
    $other_dropout_reason
);

// Execute the statement
if ($stmt->execute()) {
    // Insertion successful
    echo "Student added successfully";
} else {
    // Error handling
    echo "Error: " . mysqli_error($conn);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>