<?php
session_start();
// Get data from session
$sessData = !empty($_SESSION['sessData']) ? $_SESSION['sessData'] : '';

// Get status from session
$statusMsg = $status = '';
if (!empty($sessData['status']['msg'])) {
    $statusMsg = $sessData['status']['msg'];
    $status = $sessData['status']['type'];
    unset($_SESSION['sessData']['status']);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Reset Password</title>
    <?php include "includes/head.php"; ?>
    <style>
        .password-container {
            position: relative;
        }

        .password-icon {
            position: absolute;
            top: 70%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?php
    // Retrieve the token from the URL query parameters
    if (isset($_GET['token'])) {
        $token = $_GET['token'];
        $valErr = '';

        include_once "includes/dbconnection.php";

        // Check if the token exists and is valid
        $sql = "SELECT * FROM password_reset_tokens WHERE token = '$token' AND expiration > NOW()";
        $result = $conn->query($sql);

        if ($result->num_rows === 1) {
            // Token is valid, allow the user to reset the password
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $confirm_password = $_POST["confirm_password"];
                $password = $_POST["new_password"];

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
                if (empty($valErr)) {
                    $newPassword = $_POST["new_password"];
                    $hashedPassword = md5($newPassword);

                    // Update the password in the users table
                    $updateSql = "UPDATE users SET password = '$hashedPassword' WHERE email = (SELECT email FROM password_reset_tokens WHERE token = '$token')";
                    if ($conn->query($updateSql) === TRUE) {
                        $statusMsg = "Password reset successfully. You can now login with the new password";
                        $status = "success";
                        $_SESSION['sessData']['status']['msg'] = $statusMsg;
                        $_SESSION['sessData']['status']['type'] = $status;
                        header("location:index.php");
                        exit();
                    }
                } else {
                    $status = "error";
                    $statusMsg = $valErr;
                    $_SESSION['sessData']['status']['msg'] = $statusMsg;
                    $_SESSION['sessData']['status']['type'] = $status;
                    header("Location: reset_password.php?token=$token"); // Redirect back to the reset password page
                    exit();
                }
            } else {
                ?>
                <div class="container d-flex flex-column">

                    <div class="row align-items-center justify-content-center min-vh-100">
                        <div class="col-12 col-md-8 col-lg-4">
                            <div class="card shadow-sm">
                                <div class="card-body">

                                    <div class="mb-4">
                                        <h5>Reset Password</h5>
                                        <!-- Status message -->
                                        <?php if (!empty($statusMsg)) { ?>
                                            <div style="color: red" class="mt-2 status-msg alert alert-danger">
                                                <p style="text-transform: uppercase;">
                                                    <?php echo $status; ?>
                                                </p>
                                                <?php echo $statusMsg; ?>
                                                <?php echo $valErr; ?>
                                            </div>
                                        <?php } ?>
                                        <p class="mb-2">
                                            Enter your new password and ensure they match
                                        </p>
                                    </div>
                                    <form method="POST">

                                        <div class="mb-3 form-field password-container">
                                            <label for="new_password" class="form-label">Password</label>
                                            <input type="password" name="new_password" id="password" class="form-control"
                                                placeholder="Enter your new password" required>
                                            <i class="password-icon" id="password-icon"><i class="fas fa-eye"></i></i>
                                        </div>
                                        <div class="mb-3 form-field password-container">
                                            <label for="confirm_password" class="form-label">Confirm Password</label>
                                            <input type="password" id="confirm-password" name="confirm_password"
                                                class="form-control" placeholder="Confirm password" required>
                                            <i class="password-icon" id="confirm-password-icon"><i class="fas fa-eye"></i></i>
                                        </div>

                                        <div class="mb-3 d-grid">
                                            <button type="submit" name="submit" class="btn btn-primary">
                                                Reset Password
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="assets/js/appRegister.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const passwordInput = document.getElementById('password');
                        const confirmPasswordInput = document.getElementById('confirm-password');
                        const passwordIcon = document.getElementById('password-icon');
                        const confirmPasswordIcon = document.getElementById('confirm-password-icon');

                        passwordIcon.addEventListener('click', function () {
                            if (passwordInput.type === 'password') {
                                passwordInput.type = 'text';
                                passwordIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
                            } else {
                                passwordInput.type = 'password';
                                passwordIcon.innerHTML = '<i class="fas fa-eye"></i>';
                            }
                        });

                        confirmPasswordIcon.addEventListener('click', function () {
                            if (confirmPasswordInput.type === 'password') {
                                confirmPasswordInput.type = 'text';
                                confirmPasswordIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
                            } else {
                                confirmPasswordInput.type = 'password';
                                confirmPasswordIcon.innerHTML = '<i class="fas fa-eye"></i>';
                            }
                        });
                    });
                </script>
                <?php
            }
        } else {
            echo '<center><div class="alert alert-danger">
            <h2>ERROR</h2>
  <strong>Invalid or expired token!</strong> Please try again.
</div></center>';

        }

        $conn->close();
    } else {
        echo '<center><div class="alert alert-danger">
        <h2>ERROR</h2>
        <strong>Invalid token!</strong> Please provide a valid token.
      </div></center>';
    }
    ?>

</body>

</html>