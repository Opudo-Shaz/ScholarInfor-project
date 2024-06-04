<?php
// Retrieve the token and new password from the form data
$token = $_POST['token'];
$new_password = $_POST['new_password'];

// Validate the token again before updating the password
// Establish a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "faweall";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the token exists and is valid
$sql = "SELECT * FROM password_reset_tokens WHERE token = '$token' AND expiration > NOW()";
$result = $conn->query($sql);

if ($result->num_rows === 1) {
    // Token is valid, update the password
    $row = $result->fetch_assoc();
    $email = $row['email'];

    // Hash and salt the new password before storing it in the database
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the password for the user in the database
    $sql = "UPDATE users SET password = '$hashed_password' WHERE email = '$email'";

    if ($conn->query($sql) === TRUE) {
        // Password updated successfully
        echo "Password has been successfully reset.";
    } else {
        echo "Error updating the password: " . $conn->error;
    }
} else {
    echo "Invalid or expired token. Please try again.";
}

$conn->close();
?>
