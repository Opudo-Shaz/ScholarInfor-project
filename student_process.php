<?php
include('includes/dbconnection.php');
// Start session 
session_start();
if (isset($_POST['submit'])) {

  $first_name = $_REQUEST["first_name"];
  $middle_name = isset($_REQUEST["middle_name"]) ? $_REQUEST["middle_name"] : null;
  $last_name = $_REQUEST["last_name"];
  $phone = $_REQUEST["phone"];
  $email = $_REQUEST["email"];
  $gender = $_REQUEST["gender"];
  $guardian_first_name = $_REQUEST["guardian_first_name"];
  $guardian_middle_name = isset($_REQUEST["guardian_middle_name"]) ? $_REQUEST["guardian_middle_name"] : null;
  $guardian_last_name = $_REQUEST["guardian_last_name"];
  $age = $_REQUEST["age"];
  $community_name = $_REQUEST["community_name"];
  $date_of_birth = $_REQUEST["date_of_birth"];
  $school_name = isset($_REQUEST["school_name"]) ? $_REQUEST["school_name"] : null;
  $expected_completion_date = $_REQUEST["expected_completion_date"];
  $student_status = $_REQUEST["student_status"];
  $dropout_reason = isset($_REQUEST["dropout_reason"]) ? $_REQUEST["dropout_reason"] : null;
  $other_dropout_reason = isset($_REQUEST["other_dropout_reason"]) ? $_REQUEST["other_dropout_reason"] : null;
  $created = date("Y-m-d H:i:s");
  $modified = date("Y-m-d H:i:s");

  $sql = "INSERT INTO student (first_name, middle_name, last_name, phone, email, gender,
        guardian_first_name, guardian_middle_name, guardian_last_name, age, community_name, date_of_birth,
        school_name, expected_completion_date, student_status, dropout_reason,
        other_dropout_reason, created, modified) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param(
      $stmt,
      "sssssssssssssssssss",
      $first_name,
      $middle_name,
      $last_name,
      $phone,
      $email,
      $gender,
      $guardian_first_name,
      $guardian_middle_name,
      $guardian_last_name,
      $age,
      $community_name,
      $date_of_birth,
      $school_name,
      $expected_completion_date,
      $student_status,
      $dropout_reason,
      $other_dropout_reason,
      $created,
      $modified
    );
  }


  // Attempt to execute the prepared statement
  if (mysqli_stmt_execute($stmt)) {

    $insertRecord = "Congratulations! Records inserted successfully. Kindly Wait for verification to see details.";
    $_SESSION['insertStudent'] = $insertRecord;
    header("Location: student.php", true, 301);
    exit();
  } else {
    $insertRecordError = "ERROR: Could not execute query: $sql." . mysqli_error($link);
    $_SESSION['insertStudentError'] = $insertRecordError;
    header("Location: student.php", true, 301);
    exit();
  }
} else {
  echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
}

// Close statement
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($conn);
?>