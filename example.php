<?php
session_start();
include('includes/dbconnection.php');
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';



$roleName = "superadmin";
$permissionIds = [11];
$countyIds = [1];

$created = Role::insertRoleWithPermsAndCounties($roleName, $permissionIds, $countyIds);

if ($created) {
    echo "Role created successfully.\n";
} else {
    echo "Role creation failed.\n";
}

?>