<?php
include('includes/dbconnection.php');
session_start();
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';

if (isset($_POST['submit'])) {
    // Check if the form has been submitted

    // Retrieve the user_id from the session, assuming it's already set during the login process
    $user_id = $_SESSION['user_id_role'];

    // Prepare a SQL query to select the email from the users table based on the provided user_id
    $sql = "SELECT email FROM users WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        // If the user is found, fetch the email from the result
        $row = mysqli_fetch_assoc($result);
        $email = $row['email'];

        // Create a PrivilegedUser object using the getByEmail() method
        $u = PrivilegedUser::getByEmail($email);

        // Assuming you have a form field with the name "selected_role" that holds the selected role ID
        // Retrieve the selected role ID from the submitted form
        $selectedRoleId = $_POST["selected_role"];
        try {
            // Assuming you have a function insertUserRoles() in the Role class that assigns roles to a user
            // Use the insertUserRoles() function to assign the selected role to the user
            Role::insertUserRoles($u->id, [$selectedRoleId]);

            $insertRecord = "Role assigned successfully!";
            $_SESSION['insertRole'] = $insertRecord;
            header("Location: users.php", true, 301);
            exit();
        } catch (PDOException $e) {
            // Check if the error code corresponds to a duplicate entry error
            if ($e->getCode() == 23000) {
                $insertRecordError = "Role assignment failed. The selected role is already assigned to this user.";
            } else {
                // For other PDO exceptions, you can display a generic error message or log the error
                $insertRecordError = "An error occurred while assigning the role.";
            }
            $_SESSION['insertRoleError'] = $insertRecordError;
            header("Location: users.php", true, 301);
            exit();
        }

    } else {
        $insertRecordError = "No user with given role.";
        $_SESSION['insertRoleError'] = $insertRecordError;
        header("Location: users.php", true, 301);
        exit();

    }
} else {
    // If the form is not submitted, display a message or take appropriate action
    echo "Please submit the form to insert a role.";
}
?>