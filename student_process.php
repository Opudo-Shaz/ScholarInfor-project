<?php
include('includes/dbconnection.php');
if (isset($_POST['submit'])) {

  $first_name = $_REQUEST["first_name"];
  $middle_name = isset($_REQUEST["middle_name"]) ? $_REQUEST["middle_name"] : null;
  $last_name = $_REQUEST["last_name"];
  $gender = $_REQUEST["gender"];
  $guardian_first_name = $_REQUEST["guardian_first_name"];
  $guardian_middle_name = isset($_REQUEST["guardian_middle_name"]) ? $_REQUEST["guardian_middle_name"] : null;
  $guardian_last_name = $_REQUEST["guardian_last_name"];
  $age = $_REQUEST["age"];
  $date_of_birth = $_REQUEST["date_of_birth"];
  $school_name = $_REQUEST["school_name"];
  $expected_completion_date = $_REQUEST["expected_completion_date"];
  $student_status = $_REQUEST["student_status"];
  $dropout_reason = isset($_REQUEST["dropout_reason"]) ? $_REQUEST["dropout_reason"] : null;
  $other_dropout_reason = isset($_REQUEST["other_dropout_reason"]) ? $_REQUEST["other_dropout_reason"] : null;


  $sql = "INSERT INTO student( first_name, middle_name, last_name, gender,
     guardian_first_name, guardian_middle_name,guardian_last_name, age, date_of_birth,school_name, expected_completion_date,
      student_status, dropout_reason, other_dropout_reason) values(?,?,?,?,?,?,?,?,?,?,?,?,?, ?)";

  if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "ssssssssssssss", $first_name, $middle_name, $last_name, $gender, $guardian_first_name, $guardian_middle_name, $guardian_last_name, $age, $date_of_birth, $school_name, $expected_completion_date, $student_status, $dropout_reason, $other_dropout_reason);
  }




  // Attempt to execute the prepared statement
  if (mysqli_stmt_execute($stmt)) {
    echo "Records inserted successfully.";
  } else {
    echo "ERROR: Could not execute query: $sql. " . mysqli_error($link);
  }
} else {
  echo "ERROR: Could not prepare query: $sql. " . mysqli_error($conn);
}

// Close statement
mysqli_stmt_close($stmt);

// Close connection
mysqli_close($conn);
?>