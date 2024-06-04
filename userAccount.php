<?php 
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);?>

<?php
// Start session 
session_start();

// Load and initialize user class 
include_once 'model/User.class.php';
$user = new User();

$postData = $statusMsg = $valErr = '';
$status = 'error';
$redirectURL = 'index.php';
if (isset($_POST['signupSubmit'])) {
    $redirectURL = 'registration.php';

    // Get user's input 
    $postData = $_POST;
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate form fields 
    if (empty($first_name)) {
        $valErr .= 'Please enter your first name.<br/>';
    }
    if (empty($last_name)) {
        $valErr .= 'Please enter your last name.<br/>';
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valErr .= 'Please enter a valid email.<br/>';
    }
    if (empty($password)) {
        $valErr .= 'Please enter login password.<br/>';
    }
    if (empty($confirm_password)) {
        $valErr .= 'Please confirm your password.<br/>';
    }
    if ($password !== $confirm_password) {
        $valErr .= 'Confirm password should be matched with the password.<br/>';
    }


    // Validate password strength
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    if (!empty($password)) {
        if (!$uppercase || !$lowercase || strlen($password) < 6) {
            $valErr .= 'Password should be at least 6 characters in length and should include at least one upper case letter and one lowercase letter ';
        }
    }

    // Check whether user inputs are empty 
    if (empty($valErr)) {
        // Check whether the user already exists with the same email in the database 
        $prevCon['where'] = array(
            'email' => $_POST['email']
        );
        $prevCon['return_type'] = 'count';
        $prevUser = $user->getRows($prevCon);
        if ($prevUser > 0) {
            $statusMsg = 'Email already registered, please use another email.';
        } else {
            // Insert user data in the database 
            $password_hash = md5($password);
            $userData = array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => $password_hash,
            );


            $insert = $user->insert($userData);

            if ($insert) {
                $status = 'success';
                $statusMsg = 'Your account has been registered successfully, login to the account.';
                $postData = '';

                require_once 'model/Role.php';
                require_once 'model/Permission.php';
                require_once 'model/PrivilegedUser.php';

                // Assuming $userData contains user data retrieved from somewhere
                $userEmail = $userData['email'];

                // Get the PrivilegedUser object by user email
                $privilegedUser = PrivilegedUser::getByEmail($userEmail);

                // Define the role to assign
                $selectedRoleID = "8";

                // Insert the user's role into the database
                Role::insertUserRoles($privilegedUser->$id, [$selectedRoleID]);

                $redirectURL = 'index.php';
            } else {
                $statusMsg = 'Something went wrong, please try again after some time.';
            }
        }
    } else {
        $statusMsg = '<p>Please fill all the mandatory fields:</p>' . trim($valErr, '<br/>');
    }

    // Store registration status into the SESSION 
    $sessData['postData'] = $postData;
    $sessData['status']['type'] = $status;
    $sessData['status']['msg'] = $statusMsg;
    $_SESSION['sessData'] = $sessData;

    // Redirect to the home/registration page 
    header("Location: $redirectURL");
} elseif (isset($_POST['loginSubmit'])) {
    require_once ('includes/2faAuth.php');
    // Get user's input 
    $postData = $_POST;
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate form fields 
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valErr .= 'Please enter a valid email.<br/>';
    }
    if (empty($password)) {
        $valErr .= 'Please enter your password.<br/>';
    }

    // Check whether user inputs are empty 
    if (empty($valErr)) {
        // Check whether the user account exists with active status in the database 
        $password_hash = md5($password);
        $conditions['where'] = array(
            'email' => $email,
            'password' => $password_hash,
            'status' => 1
        );
        $conditions['return_type'] = 'single';
        $userData = $user->getRows($conditions);

        if (!empty($userData)) {
            $status = 'success';
            $statusMsg = 'Welcome ' . $userData['first_name'] . '!';
            enableTwoFactorAuth($userData['id'], $userData['email']);
            //$sessData['userLoggedIn'] = TRUE;
            //$sessData['userID'] = $userData['id'];

            // Redirect to 2faAuth.php using header redirect
            header("Location: includes/enter_code.php?userID=" .$userData['id']);
            exit();

           
        } else {
            $statusMsg = 'Wrong email or password, please try again!';
        }
    } else {
        $statusMsg = '<p>Please fill all the mandatory fields:</p>' . trim($valErr, '<br/>');
    }

    //Store login status into the SESSION 
    $sessData['postData'] = $postData;
    $sessData['status']['type'] = $status;
    $sessData['status']['msg'] = $statusMsg;
    $_SESSION['sessData'] = $sessData;

    //Redirect to the home page 
    header("Location: $redirectURL");
} elseif (!empty($_REQUEST['logoutSubmit'])) {
    // Remove session data 
    unset($_SESSION['sessData']);
    session_destroy();

    // Store logout status into the SESSION 
    $sessData['status']['type'] = 'success';
    $sessData['status']['msg'] = 'You have logout successfully!';
    $_SESSION['sessData'] = $sessData;

    // Redirect to the home page 
    header("Location: $redirectURL");
} else {
    // Redirect to the home page 
    header("Location: $redirectURL");
}
if (isset($_POST['resetSubmit'])) {
    $fp_code = '';
    if (!empty($_POST['password']) && !empty($_POST['confirm_password']) && !empty($_POST['fp_code'])) {
        $fp_code = $_POST['fp_code'];
        // Password and confirm password comparison
        if ($_POST['password'] !== $_POST['confirm_password']) {
            $sessData['status']['type'] = 'error';
            $sessData['status']['msg'] = 'Confirm password must match with the password.';
        } else {
            // Check whether identity code exists in the database
            $prevCon['where'] = array('forgot_pass_identity' => $fp_code);
            $prevCon['return_type'] = 'single';
            $prevUser = $user->getRows($prevCon);
            if (!empty($prevUser)) {
                // Update data with new password
                $conditions = array(
                    'forgot_pass_identity' => $fp_code
                );
                $data = array(
                    'password' => md5($_POST['password'])
                );
                $update = $user->update($data, $conditions);
                if ($update) {
                    $sessData['status']['type'] = 'success';
                    $sessData['status']['msg'] = 'Your account password has been reset successfully. Please login with your new password.';
                } else {
                    $sessData['status']['type'] = 'error';
                    $sessData['status']['msg'] = 'Some problem occurred, please try again.';
                }
            } else {
                $sessData['status']['type'] = 'error';
                $sessData['status']['msg'] = 'You are not authorized to reset the new password for this account.';
            }
        }
    } else {
        $sessData['status']['type'] = 'error';
        $sessData['status']['msg'] = 'All fields are mandatory, please fill all the fields.';
    }
    // Store reset password status into the session
    $_SESSION['sessData'] = $sessData;
    $redirectURL = ($sessData['status']['type'] == 'success') ? 'index.php' : 'resetPassword.php?fp_code=' . $fp_code;
    // Redirect to the login/reset password page
    header("Location:" . $redirectURL);
}
?>