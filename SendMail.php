<?php 
ini_set('display_errors', 1);

ini_set('display_startup_errors', 1);

error_reporting(E_ALL);?>

<?php
// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    //Configure SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'opudosharon6@gmail.com'; // Replace with your Gmail username
    $mail->Password = 'zcpg zvqj sfww pqne'; // Replace with your Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Sender information
    $mail->setFrom('opudosharon6@gmail.com', 'Sharon'); 

    // Receiver email address and name
    $mail->addAddress('cit2220442021@mmu.ac.ke', 'Opudo'); 

    // Add cc or bcc
    // $mail->addCC('email@mail.com');
    // $mail->addBCC('user@mail.com');

    $mail->isHTML(true); 

    $mail->Subject = 'PHPMailer SMTP test';
    $mail->Body = "<h1>PHPMailer the awesome Package</h1>
                  <p>PHPMailer is working fine for sending mail.</p>
                  <p>This is a test email for PHPMailer integration.</p>";

    // Attempt to send the email
    $mail->send();
    echo 'Message has been sent.';
} catch (Exception $e) {
    echo 'Email not sent. An error was encountered: ' . $mail->ErrorInfo;
}
