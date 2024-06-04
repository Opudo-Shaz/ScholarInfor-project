<?php 
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);?>

<?php
// Start session 
session_start();
// Include PHPMailer Autoloader
require dirname(__FILE__, 2).'/vendor/autoload.php'; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
include dirname(__FILE__, 2).'/model/database2.php';


$status = 'error';
$isValidOTP = false;
$redirectURL = 'enter_code.php';

// Function to generate random verification code
function generateVerificationCode() {
    return mt_rand(100000, 999999);
}

// Function to send verification email
function sendEmail($email, $subject, $body) {
    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'opudosharon6@gmail.com';
        $mail->Password   = 'zcpg zvqj sfww pqne';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('opudosharon6@gmail.com', 'ScholarInfo');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        //$mail->Subject = 'Two Factor Authentication Code';
        //$mail->Body    = 'Your verification code is: ' . $code;
        $mail->AltBody =  $body;

        // Send email
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Function to enable 2FA for a user
function enableTwoFactorAuth($user_id, $email) {
    $dbConn = new Database2();
    $conn = $dbConn->db;
    $code = generateVerificationCode();
    $stmt = $conn->prepare("UPDATE users SET otp = ? WHERE id = ?");
    $stmt->bind_param("si", $code, $user_id);
    $subject= 'Two Factor Authentication Code';
    $body= 'Your verification code is: ' . $code;

    $stmt->execute();
    $stmt->close();

    // Send email
    if (sendEmail($email, $subject, $body)) {
        return true;
    } else {
        return false;
    }
}

// Function to verify 2FA code and unset OTP after usage
function verifyTwoFactorCode($user_id, $otp) {
    $dbConn = new Database2();
    $conn = $dbConn->db;
    

    // Retrieve the stored OTP from the database
    $stmt = $conn->prepare("SELECT id, first_name, last_name, email, status, phone_number, otp FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($id, $first_name, $last_name, $email, $status, $phone_number,$otp);
    $stmt->fetch();
    $stmt->close();
    $user = array("id"=>$id,"first_name"=>$first_name,"last_name"=>$last_name,"email"=>$email,"status"=>$status,"phone_number"=>$phone_number);
    

    // Check if the stored OTP matches the provided code
    if ($user && $otp == $otp) {
        // Unset the OTP by updating the database
        $stmt = $conn->prepare("UPDATE users SET otp = NULL WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
        
        return $user;
    } else {
        // Return false if the OTP is invalid
        return array();
    }
}

if (isset($_POST['OTPSubmit'])) {
    // Get user's input 
    $postData = $_POST;
    $otp = trim($_POST['otp']);

    // Validate form field 
    if (empty($otp)) {
        $valErr .= 'Please enter the OTP.<br/>';
    }

    // Check whether user input is empty 
    if (empty($valErr)) {
        $user_id = $_POST['userID'];
        

        $authorizedUser = verifyTwoFactorCode($user_id, $otp); 
        
        if (sizeof($authorizedUser)>0) {
            $status = 'success';
            $statusMsg = 'Welcome...';
            $sessData['userLoggedIn'] = TRUE;
            $sessData['userID'] = $user_id;

                // Store verification status into the SESSION 
            $sessData['postData'] = $postData;
            $sessData['status']['type'] = $status;
            $sessData['status']['msg'] = $statusMsg;
            $_SESSION['sessData'] = $sessData;
            $_SESSION['userData'] = $authorizedUser;
            // Redirect to welcome.php if OTP is valid
            header("Location: ../welcome.php");
            exit();
        } else {
            $statusMsg = 'Invalid OTP, please try again!';
        }
    } else {
        $statusMsg = trim($valErr, '<br/>');
    }

        // Store verification status into the SESSION 
        $sessData['postData'] = $postData;
        $sessData['status']['type'] = $status;
        $sessData['status']['msg'] = $statusMsg;
        $_SESSION['sessData'] = $sessData;
        // Redirect to welcome.php if OTP is valid
        header("Location: ". $redirectURL . '?userID=' . $user_id);

    
}
    
    
?>






