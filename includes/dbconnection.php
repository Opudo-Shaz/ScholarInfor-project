<?php 
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);
?>

<?php
  $dbHost     = "localhost"; 
  $dbUsername = "root"; 
  $dbPassword = "Pass@1234567890"; 
  $dbName     = "faweall"; 

// Establish database connection.
$conn = new mysqli($dbHost, $dbUsername,$dbPassword, $dbName); 
            
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
 }

 