<?php
session_start();
include('includes/dbconnection.php'); // Include your database connection script here

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Gather data from the form
    $sponsorName = $_POST["sponsor_name"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phone_number"];
    $countryOfOrigin = $_POST["country_of_origin"];
    $sponsorType = $_POST["sponsor_type"];
    $additionalInfo = $_POST["additional_info"];

    // Prepare the INSERT query
    $insertSponsorQuery = "INSERT INTO sponsors (sponsor_name, email, phone_number, country_of_origin, sponsor_type, additional_info, created, modified) VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";

    // Create a prepared statement
    $stmt = $conn->prepare($insertSponsorQuery);

    // Bind the parameters
    $stmt->bind_param("ssssss", $sponsorName, $email, $phoneNumber, $countryOfOrigin, $sponsorType, $additionalInfo);

    // Execute the query
    if ($stmt->execute()) {
        $_SESSION["insertSponsor"] = "Sponsor data has been successfully inserted.";
    } else {
        $_SESSION["insertSponsorError"] = "Error: " . $stmt->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $conn->close();

    // Redirect to the previous page or any other desired page
    header('Location: add_sponsor.php');
    exit();
} else {
    // If the form was not submitted, redirect to the previous page or show an error message
    $_SESSION["insertSponsorError"] = "Form not submitted correctly.";
    header('Location: previous_page.php');
    exit();
}
