<?php
session_start();

include_once "../includes/dbconnection.php";
include_once "../User.class.php";

if (isset($_SESSION['userData'])) {
    if (isset($_POST['submit'])) {
        // Get the form data
        $first_name = trim($_POST["first_name"]);
        $last_name = trim($_POST["last_name"]);
        $email = trim($_POST["email"]);
        $old_pp = trim($_POST["old_profile_picture"]);

        $userData = $_SESSION['userData'];
        $id = $userData["id"];

        // Initialize the error message variable
        $em = "";

        if (empty($first_name) && empty($last_name) && empty($email)) {
            $em = "Please update at least one field (first name, last name, or email).";
        } else if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $em = "Please enter a valid email.";
        } else if (!empty($email) && $email !== $userData['email']) {
            // Check if the email has changed and if it is valid
            $prevCon['where'] = array('email' => $email);
            $prevCon['return_type'] = 'count';
            $user = new User();
            $prevUser = $user->getRows($prevCon);
            if ($prevUser > 0) {
                $em = 'Email already registered, please use another email.';
            }
        }

        if (!empty($em)) {
            // If there are errors, redirect back to the profile page with the error message
            header("Location: ../profile.php?error=$em");
            exit;
        }

        // Update user data if everything is valid
        if (isset($_FILES['profile_image']['name']) && !empty($_FILES['profile_image']['name'])) {
            // Handle profile picture upload
            $img_name = $_FILES['profile_image']['name'];
            $tmp_name = $_FILES['profile_image']['tmp_name'];
            $error = $_FILES['profile_image']['error'];

            if ($error === 0) {
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_to_lc = strtolower($img_ex);

                $allowed_exs = array('jpg', 'jpeg', 'png');
                if (in_array($img_ex_to_lc, $allowed_exs)) {
                    $new_img_name = uniqid('user_', true) . '.' . $img_ex_to_lc;
                    $img_upload_path = '../upload/' . $new_img_name;

                    // Delete old profile pic
                    $old_pp_path = "../upload/$old_pp";
                    if (file_exists($old_pp_path) && unlink($old_pp_path)) {
                        // The old picture was successfully deleted
                        move_uploaded_file($tmp_name, $img_upload_path);
                    } else {
                        // Error occurred while deleting the old picture or it was already deleted
                        move_uploaded_file($tmp_name, $img_upload_path);
                    }

                    // Update the Database
                    $sql = "UPDATE users 
                            SET first_name=?, last_name=?, email=?, profile_image=?
                            WHERE id=?";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute([$first_name, $last_name, $email, $new_img_name, $id]);

                    // Update the session data
                    $_SESSION['userData']['first_name'] = $first_name;

                    header("Location: ../profile.php?success=Your account has been updated successfully");
                    exit;
                } else {
                    $em = "You can't upload files of this type";
                }
            } else {
                $em = "Unknown error occurred!";
            }
        } else {
            // Update the user data without changing the profile picture
            $sql = "UPDATE users SET first_name=?, last_name=?, email=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$first_name, $last_name, $email, $id]);

            // Update the session data
            if (!empty($first_name)) {
                $_SESSION['userData']['first_name'] = $first_name;
            }
            if (!empty($last_name)) {
                $_SESSION['userData']['last_name'] = $last_name;
            }
            if (!empty($email)) {
                $_SESSION['userData']['email'] = $email;
            }
            header("Location: ../profile.php?success=Your account has been updated successfully");
            exit;
        }

        // Redirect back to the profile page with the error message (if any)
        header("Location: ../profile.php?error=$em");
        exit;
    } else {
        header("Location: ../profile.php?error=error");
        exit;
    }
} else {
    header("Location: index.php");
    exit;
}
?>