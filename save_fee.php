<?php
require_once('includes/dbconnection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize input data
    $student_id = filter_input(INPUT_POST, 'student_id', FILTER_VALIDATE_INT);
    $academic_year = filter_input(INPUT_POST, 'academic_year', FILTER_SANITIZE_STRING);
    $term = filter_input(INPUT_POST, 'term', FILTER_SANITIZE_STRING);
    $fee_amount = filter_input(INPUT_POST, 'fee_amount', FILTER_VALIDATE_FLOAT);
    $fee_status = filter_input(INPUT_POST, 'fee_status', FILTER_SANITIZE_STRING);

    // Check for missing or invalid data
    if ($student_id === false || $academic_year === null || $term === null || $fee_amount === false || $fee_status === null) {
        $response = ["success" => false, "error" => "Invalid or missing data"];
    } else {
        // Insert data into school_fees table
        $insert_query = "INSERT INTO school_fees (student_id, academic_year, term, fee_amount, fee_status, created, modified) 
                        VALUES ($student_id, '$academic_year', '$term', $fee_amount, '$fee_status', NOW(), NOW())";

        if (mysqli_query($conn, $insert_query)) {
            $response = ["success" => true];
        } else {
            $response = ["success" => false, "error" => "Error inserting fee record: " . mysqli_error($conn)];
        }
    }

    mysqli_close($conn);
} else {
    $response = ["success" => false, "error" => "Invalid request method"];
}

header("Content-Type: application/json");
echo json_encode($response);
