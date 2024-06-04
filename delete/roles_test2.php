<?php
// Include the classes
require_once 'model/Role.php';
require_once 'model/PrivilegedUser.php';

// Database connection setup (replace with your actual database connection)


// Create roles and permissions
Role::insertRole('Admin');
Role::insertRole('Moderator');
Role::insertRole('User');

PrivilegedUser::insertPerm(1, 1); // Associate 'Admin' role with 'Create Post' permission
PrivilegedUser::insertPerm(1, 2); // Associate 'Admin' role with 'Edit Post' permission
PrivilegedUser::insertPerm(1, 3); // Associate 'Admin' role with 'Delete Post' permission

PrivilegedUser::insertPerm(2, 2); // Associate 'Moderator' role with 'Edit Post' permission
PrivilegedUser::insertPerm(2, 3); // Associate 'Moderator' role with 'Delete Post' permission

PrivilegedUser::insertPerm(3, 1); // Associate 'User' role with 'Create Post' permission

// Create a new user or get an existing user by email (replace with your actual user email)
$email = '.com';
$user = PrivilegedUser::getByUsername($email);

if (!$user) {
    // User doesn't exist, so create a new user (replace with your actual user details)
    $user = new PrivilegedUser();
    $user->email = $email;
    $user->password = 'hashed_password'; // Replace with the hashed password
    $user->save(); // Assuming a method to save the user to the 'users' table
}

// Assign roles to the user
$userRoles = [1]; // Assuming role IDs from the 'roles' table
PrivilegedUser::insertUserRoles($user->id, $userRoles);

// Check user permissions and roles

// Check if the user has a specific permission
$permissionToCheck = 'Create Post';
if ($user->hasPrivilege($permissionToCheck)) {
    echo "User has permission to create a post.\n";
} else {
    echo "User does not have permission to create a post.\n";
}

// Check if the user has a specific role
$roleToCheck = 'Admin';
if ($user->hasRole($roleToCheck)) {
    echo "User has the Admin role.\n";
} else {
    echo "User does not have the Admin role.\n";
}
