<?php
session_start();
include('includes/dbconnection.php');
require_once 'model/Role.php';
require_once 'model/Permission.php';
require_once 'model/PrivilegedUser.php';
// Insert regional admin role
//Role::insertRole("Regional Admin");

// Insert permissions associated with the role
//$permissionDescriptions = ["create_post_re", "edit_post_re", "delete_post_re"];
$roleId = 9;

// foreach ($permissionDescriptions as $permDesc) {
//     Permission::insertPerm($permDesc, [$roleId]);

// }
//$regional_perm_id = [13];
//Role::insertRolePerms($roleId, $regional_perm_id);


###### Step 2
//Selected Role Id
// 
 // Step 1: Create the "Regional Admin" role with associated permissions and counties
//  require_once 'model/CountyRole.php';

//  // Step 3: Assign the "Regional Admin" role to specific counties
//  $roleIds = [$roleId]; // Use the previously obtained role ID
//  $countyIds = [1];

//  foreach ($countyIds as $countyId) {
//      foreach ($roleIds as $roleId) {
//          CountyRole::assignRoleToCounty($roleId, $countyId);
//      }
//  }

//  echo "Role assigned to counties.\n";




// Step 1: Create the "Regional Admin" role with associated permissions and counties
$roleName = "Joho";
$permissionIds = [11];
$countyIds = [1];

$created = Role::insertRoleWithPermsAndCounties($roleName, $permissionIds, $countyIds);

if ($created) {
    echo "Role created successfully.\n";
} else {
    echo "Role creation failed.\n";
}

?>