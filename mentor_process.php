<?php
session_start();
include('includes/dbconnection.php'); // Include your database connection script here

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Gather data from the form
    $mentorName = $_POST["mentor_name"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phone_number"];
    $nationality = $_POST["nationality"];
    $mentorGroup = $_POST["mentor_group"]; // Change $mentorType to $mentorGroup
    $additionalInfo = $_POST["additional_info"];

    // Prepare the INSERT query
    $insertMentorQuery = "INSERT INTO mentors (mentor_name, email, phone_number, nationality, mentor_group, additional_info, created, modified) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";

    // Create a prepared statement
    $stmt = $conn->prepare($insertMentorQuery);

    // Bind the parameters
    $stmt->bind_param("ssssss", $mentorName, $email, $phoneNumber, $nationality, $mentorGroup, $additionalInfo);

    // Execute the query
    if ($stmt->execute()) {
        $_SESSION["insertMentor"] = "Mentor data has been successfully inserted.";
    } else {
        $_SESSION["insertMentorError"] = "Error: " . $stmt->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();

    // Redirect to the previous page or any other desired page
    header('Location: add_mentor.php');
    exit();
} else {
    // If the form was not submitted correctly, redirect to the previous page or show an error message
    $_SESSION["insertMentorError"] = "Form not submitted correctly.";
    header('Location: add_mentor.php');
    exit();
}
?>
