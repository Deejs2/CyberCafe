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
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= "From: jireldhiraj123@gmail.com\r\nReply-To: $to";

    $mail_sent = mail($to, $subject, $message, $headers);
    if ($mail_sent) {
        return "Otp sent to $to.";
    } else {
        return "Otp failed to send. Please try again later.";
    }
}

function sendPaymentDetailMail($to, $subject, $message): string
{
    $headers = "From: jireldhiraj123@gmail.com\r\nReply-To: $to";
    $mail_sent = mail($to, $subject, $message, $headers);
    if ($mail_sent) {
        return "Payment details sent to $to.";
    } else {
        return "Payment details failed to send. Please try again later.";
    }
}

function userRequestMail($to, $subject, $message): string
{
    $headers = "From: jireldhiraj123@gmail.com\r\nReply-To: $to";
    $mail_sent = mail($to, $subject, $message, $headers);
    if ($mail_sent) {
        return "Request sent to $to.";
    } else {
        return "Request failed to send. Please try again later.";
    }

}