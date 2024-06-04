<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home | Company</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css">
</head>

<body class="container">
    <?php
    require_once 'model/Role.php';
    require_once 'model/Permission.php';
    require_once 'model/PrivilegedUser.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $email = "admin@gmail.com";
    $u = PrivilegedUser::getByEmail($email);

    if (!$u) {
        header("Location: login.php", true, 302);
        die("<h2>302 Redirected</h2><p><a href='login.php'>Login</a> to continue.</p>");
    }
    // Inserting roles
    // Role::insertRole("Admin");
    // Role::insertRole("Editor");
    // Role::insertRole("User");
    

    $roleAdminId = 6;
    $roleEditorId = 7;
    $roleUserId = 8;
    $roleSuperadmin=36;

    // Permission::insertPerm("create_post");
    // Permission::insertPerm("edit_post");
    // Permission::insertPerm("delete_post");
    
    //Assign permissions to roles
    // Role::insertRolePerms($roleAdminId, [8, 9, 10]); // Admin has all permissions
    // Role::insertRolePerms($roleEditorId, [8, 9]); // Editor has limited permissions
    // Role::insertRolePerms($roleUserId, [8]); // User has basic permissions
    
    //$userRoles = [6];
    
    //Role::insertUserRoles($u->id, $userRoles);
    


    
    $selectedRoleId = $_POST["select\ed_role"];

    // Fetch user by email
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT email FROM users WHERE id='$user_id'";
    $u = PrivilegedUser::getByEmail($sql);

    $userRoles = [$selectedRoleId];
    Role::insertUserRoles($u->id, $userRoles);
    echo "Selected Role ID: " . $selectedRoleId;
    echo "Role assigned ";

    // Checking if the user has a specific privilege
    if ($u->hasPrivilege("edit_post")) {
        echo "User has the permission to edit posts.";
    } else {
        echo "User does not have the permission to edit posts.";
    }

    // Checking if the user has a specific role
    if ($u->hasRole("Editor")) {
        echo "User has the Admin role.";
    } else {
        echo "User does not have the Editor role.";
    }

    ?>
</body>

</html>
