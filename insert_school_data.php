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
$school_name = isset($_POST["school_name"]) ? sanitizeInput($_POST["school_name"]) : '';
$county = isset($_POST["county"]) ? sanitizeInput($_POST["county"]) : null;
$sub_county = isset($_POST["sub_county"]) ? sanitizeInput($_POST["sub_county"]) : '';
$school_level = isset($_POST["school_level"]) ? sanitizeInput($_POST["school_level"]) : '';

// Prepare the SQL query using prepared statements
$sql = "INSERT INTO school (school_name, county, sub_county, school_level)
    VALUES (?, ?, ?, ?)";

// Use PDO instead of mysqli
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param(
    "ssss",
    $school_name,
    $county,
    $sub_county,
    $school_level,
);

// Execute the statement
if ($stmt->execute()) {
    // Insertion successful
    echo "School added successfully";
} else {
    // Error handling
    echo "Error: " . mysqli_error($conn);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>