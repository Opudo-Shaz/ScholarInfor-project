<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
session_start();

$pageTitle = "Dashboard";
// Initialize $userData as an empty array to avoid "Undefined array key" warnings
$userData = $_SESSION['userData'] ?? [];

require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';

// Check if $userData array is not null and the necessary 'email' key is set
if (!empty($userData) && isset($userData['email'])) {
    $u = PrivilegedUser::getByEmail($userData['email']);

    if (!$u->hasRole("Admin") && !$u->hasRole("Editor") && !$u->hasRole("User") && !$u->hasRole("Super_admin")) {
        // If user doesn't have any of the specified roles, log out the user
        // header('Location: userAccount.php?logoutSubmit=1');
        // exit();
    } elseif (empty($_SESSION['sessData'])) {
        header('location:logout.php');
        exit();
    } else {
        ?>

        <!-- Existing HTML code and further PHP logic -->

    <?php } ?>

    <!-- Existing HTML code and further PHP logic -->

<?php } ?>
