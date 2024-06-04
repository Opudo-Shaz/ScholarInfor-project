



<?php
// Include necessary files and start session
@include("includes/head.php");
session_start();
$pageTitle = "Community";
include('includes/dbconnection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $community_name = $_POST['community_name'];
    $community_type = $_POST['community_type'];
    $county = $_POST['county'];
    $sub_county = $_POST['sub_county'];
    $cm_leader_name = $_POST['cm_leader_name'];
    $cm_leader_phone = $_POST['cm_leader_phone'];
    $cm_leader_email = $_POST['cm_leader_email'];
    $asscm_leader_name = $_POST['asscm_leader_name'];
    $asscm_leader_phone = $_POST['asscm_leader_phone'];
    $asscm_leader_email = $_POST['asscm_leader_email'];

    // Your SQL query to insert data into the community table
    $sql = "INSERT INTO community (community_name, community_type, county, sub_county, cm_leader_name, cm_leader_phone, cm_leader_email, asscm_leader_name, asscm_leader_phone, asscm_leader_email)
            VALUES ('$community_name', '$community_type', '$county', '$sub_county', '$cm_leader_name', '$cm_leader_phone', '$cm_leader_email', '$asscm_leader_name', '$asscm_leader_phone', '$asscm_leader_email')";

    // Execute the query
    // Replace $conn with your actual database connection variable
    if (mysqli_query($conn, $sql)) {
        $_SESSION["insertRecord"] = "Record inserted successfully!";
    } else {
        $_SESSION["insertRecordError"] = "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Redirect back to the form page
    header("Location: community.php");
    exit();
} else {
    // If the form is not submitted, redirect to the form page
    header("Location: your_form_page.php");
    exit();
}
?>
