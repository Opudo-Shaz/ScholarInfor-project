<?php
// Start session 
session_start();
include('includes/dbconnection.php');

$errors = '';
if (isset($_POST['submit'])) {
    // Sanitize and lowercase the school_name input.
    $school_name = trim($_REQUEST["school_name"]);
    $school_name = mb_strtolower($school_name);

    // Use prepared statement to prevent SQL injection.
    $sqlRead = "SELECT * FROM school WHERE school_name = ?";
    $stmt = mysqli_prepare($conn, $sqlRead);
    mysqli_stmt_bind_param($stmt, "s", $school_name);
    mysqli_stmt_execute($stmt);

    // Get the result set.
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $errors = "School Name Already Exists.";
    }

    if (!empty($errors)) {
        $_SESSION['insertRecordError'] = $errors;
        header("Location: school.php", true, 301);
        $startTime = time();
        $_SESSION['startTime'] = $startTime;
        exit();
    } else {
        // insert your values into the database 
        $sql = "INSERT INTO school(school_name, phone, email, county, sub_county, school_level, created, modified) VALUES (?,?,?,?,?,?,?,?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssss", $school_name, $phone, $email, $county, $sub_county, $school_level, $created, $modified);
            $school_name = trim($_REQUEST["school_name"]);
            $phone = trim($_REQUEST["phone"]);
            $email = trim($_REQUEST["email"]);
            $county = trim($_REQUEST["county"]);
            $sub_county = trim($_REQUEST["sub_county"]);
            $school_level = trim($_REQUEST["school_level"]);
            $created = date("Y-m-d H:i:s");
            $modified = date("Y-m-d H:i:s");
        }


        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $insertRecord = "Records inserted successfully.";
            $_SESSION['insertRecord'] = $insertRecord;
            header("Location: school.php", true, 301);
            $startTime = time();
            $_SESSION['startTime'] = $startTime;
            exit();
        } else {
            $insertRecordError = "ERROR: Could not execute query: $sql." . mysqli_error($link);
            $_SESSION['insertRecordError'] = $insertRecordError;
            header("Location: school.php", true, 301);
            $startTime = time();
            $_SESSION['startTime'] = $startTime;
            exit();

        }

    }


} else {
    echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
}



// Close connection
mysqli_close($conn);