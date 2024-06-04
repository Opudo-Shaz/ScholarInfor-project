<?php
// Start session
session_start();

include('includes/dbconnection.php');

function sanitizeInput($input)
{
    // Use FILTER_SANITIZE_STRING with FILTER_FLAG_NO_ENCODE_QUOTES
    $sanitized_input = filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    return $sanitized_input;
}

// Validate and sanitize inputs
$id = $_SESSION['school_id'];

$school_name = trim($_REQUEST["school_name"]);
$school_name = sanitizeInput($school_name);

$county = trim($_REQUEST["county"]);
$sub_county = trim($_REQUEST["sub_county"]);
$school_level = trim($_REQUEST["school_level"]);
$modified = date("Y-m-d H:i:s");

// Use prepared statement to prevent SQL injection.
$sqlUpdate = "UPDATE school SET school_name = ?, county = ?, sub_county = ?, school_level = ? , modified = ? WHERE id = ?";

$stmtUpdate = mysqli_prepare($conn, $sqlUpdate);

if ($stmtUpdate) {
    try {
        mysqli_stmt_bind_param($stmtUpdate, "sssssi", $school_name, $county, $sub_county, $school_level, $modified, $id);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmtUpdate)) {
            $_SESSION['insertSchool'] = "School Record updated successfully.";
        } else {
            $_SESSION['insertSchoolError'] = "Error updating data: " . mysqli_error($conn);
        }
    } catch (mysqli_sql_exception $e) {
        $_SESSION['insertSchoolError'] = "Error updating data: " . $e->getMessage();
    }
    // Close the update statement

    mysqli_stmt_close($stmtUpdate);
} else {
    $_SESSION['insertSchoolError'] = "ERROR: Could not prepare query: $sqlUpdate. " . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);

// Redirect to the appropriate page after processing
header("Location: school_list.php");
exit();
?>