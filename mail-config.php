<?php
ini_set('SMTP', 'smtp.zoho.com');
ini_set('smtp_port', 465);
ini_set('sendmail_from', 'jireldhiraj123@gmail.com');
//$to = 'learner.letslearn00@gmail.com';
//$subject = 'Test for title';
//$message = 'Message to send';
//$headers = 'From: jireldhiraj123@gmail.com\r\nReply-To: learner.letslearn00@gmail.com';
//$mail_sent = mail($to, $subject, $message, $headers);
//
//echo $mail_sent ? "Mail sent" : "Mail failed";

function sendRegistrationMail($to, $subject, $message): string
{
    $headers = "From: jireldhiraj123@gmail.com\r\nReply-To: $to";
    $mail_sent = mail($to, $subject, $message, $headers);
    if ($mail_sent) {
        return "Registration successfully sent!";
    } else {
        return "Registration failed. Please try again later.";
    }
}

function sendOtpMail($to, $subject, $message): string
{
    $headers = "From: jireldhiraj123@gmail.com\r\nReply-To: $to";
    $mail_sent = mail($to, $subject, $message, $headers);
    if ($mail_sent) {
        return "Otp sent to $to.";
    } else {
        return "Otp failed to send. Please try again later.";
    }
}