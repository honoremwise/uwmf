<?php
use PHPMailer\PHPMailer\PHPMailer;
require_once(APPPATH.'views/mails/vendor/autoload.php');
function sendMail($to,$subj, $message){
    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'tsl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // or 587
    $mail->IsHTML(true);
    $mail->Username = "hmwiseneza@gmail.com";
    $mail->Password = "0781549903";
    $mail->SetFrom($to);
    $mail->Subject = $subj;
    $mail->Body = $message;
    $mail->AddAddress($to);

    if (!$mail->send()) {
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        if ($_SESSION['adminuserlogin']) {
          header('Location:../Adminuser/account');
        }
        if ($_SESSION['resetuserid']){
          header('Location:../ResetPassword/reset');
          unset($_SESSION['resetuserid']);
        }if ($_SESSION['resetuserexistingid']) {
          header('Location:../ResetPassword/backaUserccount');
        }
    }
}
?>
