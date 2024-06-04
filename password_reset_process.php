<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET['token'])) {
    $token = $_GET['token'];

    include_once "includes/dbconnection.php";

    // Check if the token exists and is valid
    $sql = "SELECT * FROM password_reset_tokens WHERE token = '$token' AND expiration > NOW()";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $newPassword = $_POST["new_password"];
        $hashedPassword = md5($newPassword);

        // Update the password in the users table
        $updateSql = "UPDATE users SET password = '$hashedPassword' WHERE email = (SELECT email FROM password_reset_tokens WHERE token = '$token')";
        if ($conn->query($updateSql) === TRUE) {
            $_SESSION['reset_success'] = true;
        } else {
            $_SESSION['reset_error'] = "Error updating password: " . $conn->error;
        }

        $conn->close();
    }
}

header("Location: reset_password.php?token=$token"); // Redirect back to the reset password page
exit();
?>