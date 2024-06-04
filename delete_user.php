<?php
require_once('includes/dbconnection.php');
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user details before deletion
    $fetchQuery = "SELECT first_name, last_name FROM users WHERE id = ?";
    $fetchStatement = mysqli_prepare($conn, $fetchQuery);
    mysqli_stmt_bind_param($fetchStatement, "i", $id);
    mysqli_stmt_execute($fetchStatement);
    $fetchResult = mysqli_stmt_get_result($fetchStatement);

    if ($fetchResult && $userDetails = mysqli_fetch_assoc($fetchResult)) {
        $first_name = isset($userDetails['first_name']) ? htmlspecialchars($userDetails['first_name']) : '';
        $last_name = isset($userDetails['last_name']) ? htmlspecialchars($userDetails['last_name']) : '';

        // Delete user
        $deleteQuery = "DELETE FROM users WHERE id = ?";
        $deleteStatement = mysqli_prepare($conn, $deleteQuery);
        mysqli_stmt_bind_param($deleteStatement, "i", $id);

        if (mysqli_stmt_execute($deleteStatement)) {
            $_SESSION['insertRole'] = "User deleted successfully for $first_name $last_name";
        } else {
            $_SESSION['insertRoleError'] = "Error deleting user: " . mysqli_stmt_error($deleteStatement);
        }

        mysqli_stmt_close($deleteStatement);
    } else {
        $_SESSION['insertRoleError'] = "Error fetching user details.";
    }

    mysqli_stmt_close($fetchStatement);
} else {
    $_SESSION['insertRoleError'] = "Invalid user ID.";
}

mysqli_close($conn);

header("Location: users.php");
exit();
?>