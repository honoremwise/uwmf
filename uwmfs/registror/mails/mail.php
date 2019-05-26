<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

function sendMail($to,$subj, $message){
    $mail = new PHPMailer(); 
    $mail->IsSMTP(); 
    $mail->SMTPDebug = 0; 
    $mail->SMTPAuth = true; 
    $mail->SMTPSecure = 'tsl'; 
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; 
    $mail->IsHTML(true);
    $mail->Username = "hmwiseneza@gmail.com";
    $mail->Password = "0781549903";
    $mail->SetFrom($to);
    $mail->Subject = $subj;
    $mail->Body = $message;
    $mail->AddAddress($to);
    
    if (!$mail->send()) {
        
    } else {
        echo "<div class='alert alert-info alert-dismissable'>
                            <center><i class='fa fa-check'></i>The comfirmation message has been sent to the user email!</center> ";
       echo"<script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>";
    }
}

 
?>