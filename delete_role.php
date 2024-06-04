<?php
session_start();
include_once "includes/dbconnection.php";
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';

$user_id = $_GET['id']; // Replace with the actual user ID for which you want to delete roles

$query = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if (Role::deleteUserRoles($user_id)) {
    $first_name = isset($row['first_name']) ? htmlspecialchars($row['first_name']) : '';
    $last_name = isset($row['last_name']) ? htmlspecialchars($row['last_name']) : '';
    $_SESSION['insertRole'] = "Roles deleted successfully for $first_name $last_name";
} else {
    $_SESSION['insertRoleError'] = "Error deleting roles for $first_name $last_name";
}

header("Location: users.php");
exit();
?>