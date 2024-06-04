<?php
session_start();
// Include the database connection
include_once "includes/dbconnection.php";
include_once "userAccount.php";

if (isset($_POST['submit'])) {
    if (!empty($_POST['email'])) {
        //check whether user exists in the database
        $prevCon['where'] = array('email' => $_POST['email']);
        $prevCon['return_type'] = 'count';
        $prevUser = $user->getRows($prevCon);
        if ($prevUser > 0) {
            // Retrieve the email address from the form data
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

            // Generate a unique token
            $token = md5(uniqid('', true));

            // Store the token in the database
            $sql = "INSERT INTO password_reset_tokens (email, token, expiration) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $token);

            if ($stmt->execute()) {
                // Token stored successfully, send an email to the user with the password reset link
                $reset_link = "http://localhost/fall/reset_password.php?token=" . urlencode($token);

                // Require the PHPMailer autoloader
                require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
                require 'vendor/phpmailer/phpmailer/src/SMTP.php';
                require 'vendor/phpmailer/phpmailer/src/Exception.php';

                // Create a new instance of PHPMailer
                $mail = new PHPMailer\PHPMailer\PHPMailer(true);

                try {
                    // Configure SMTP settings
                    $mail->isSMTP();
                    $mail->Host = 'smtp-relay.brevo.com'; // Change this to your SMTP server
                    $mail->SMTPAuth = true;
                    $mail->Username = 'harrymuthee254@gmail.com'; // Your email address
                    $mail->Password = 'TCP4rH2fdDAKMBm3'; // Your email password
                    $mail->Port = 587; // SMTP port for TLS

                    // Set the sender and recipient email addresses
                    $mail->setFrom('harrymuthee254@gmail.com', 'oslabs ke');
                    $mail->addAddress($email);

                    // Set email content
                    $mail->isHTML(false);
                    $mail->Subject = 'Password Reset';
                    $mail->Body = "Click the link below to reset your password:\n\n" . $reset_link;

                    // Send the email
                    $mail->send();
                    $forgotPassSuccess = "An email with instructions to reset your password has been sent to your email address.";
                    $_SESSION['forgotPassSuccess'] = $forgotPassSuccess;
                    header("location:forget_password.php");
                    exit();
                } catch (PHPMailer\PHPMailer\Exception $e) {
                    $forgotPassError = "Failed to send email. Error: " . $e->getMessage(); // Display detailed error message
                    $_SESSION['forgotPassError'] = $forgotPassError;
                    header("location:forget_password.php");
                    exit();
                }
            } else {
                $forgotPassError = "Error storing the token in the database" . $stmt->error;
                $_SESSION['forgotPassError'] = $forgotPassError;
                header("location:forget_password.php");
                exit();
            }
            $stmt->close();
            $conn->close();
        } else {
            $forgotPassError = 'Given email is not associated with any account.';
            $_SESSION['forgotPassError'] = $forgotPassError;
            header("location:forget_password.php");
            exit();
        }

    } else {
        $forgotPassError = 'Enter email to create a new password for your account.';
        $_SESSION['forgotPassError'] = $forgotPassError;
        header("location:forget_password.php");
        exit();
    }


}
?>