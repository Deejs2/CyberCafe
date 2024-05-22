<?php

use model\User;

session_start();
require "../database/DatabaseConnection.php";
include "../model/User.php";
include "../mail-config.php";

$page = $_GET["page"] ?? "";
$action = $_GET["action"] ?? "Login";
$GLOBALS["menuLink"] = "../?page=menu";

// This is for Login
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

//create an instance of the user class
    $user = new User($connection);
    $authenticatedUser = $user->authenticateUser($email, $password);

    if ($authenticatedUser) {
        // User authenticated successfully
        //here store the user email in a session
        $_SESSION["email"] = $email;
        header("Location: ../admin/?page=dashboard");
        exit();
    } else {
        // Authentication failed
        $error = "Invalid username or password.";
    }
}

//This is for Sending OTP
if (isset($_POST["send-otp"])) {
    $email = $_POST["email"];
    $user = new User($connection);
    $userExists = $user->checkUserExists($email);

    if ($userExists) {
        // User exists
        // Generate OTP
        $otp = rand(100000, 999999);
        $subject = "CyberCafe | OTP Verification";
        $message = "Your OTP is $otp";

        // Send OTP
        echo sendOtpMail($email, $subject, $message);
        header("Location: ?page=auth&&action=otp-confirmation");
        exit();

    } else {
        // User doesn't exist
        $error = "User doesn't exist. Please enter a valid email.";
    }
}

//This is for Register
if (isset($_POST["register"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $contact_number = $_POST["contact-number"];

    $user = new User($connection);
    $userExists = $user->checkUserExists($email);
    if($userExists){
        $error = "User already exists. Please login.";
    }else{
        $user->userRequest($firstname, $lastname, $email, $address, $contact_number);
        $subject = "CyberCafe | Registration Complete";
        $message = "You have successfully registered with CyberCafe. Please wait for the approval.";
        echo sendRegistrationMail($email, $subject, $message);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberCafe | <?php echo ucfirst($action)?></title>
    <link rel="stylesheet" href="../design/bootstrap/css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../design/css/style.css">
    <style>
        /* This footer design is for forgot-password and otp-confirmation */
        .footer{
            position: absolute;
            bottom: 0;
        }
    </style>
</head>
<body>

<?php include "common/header.php"?>

<?php
switch ($page){
    case "auth":
        if($action=="register"){
            include "register.php";
            break;
        }elseif($action=="forgot-password"){
            include "forgot-password.php";
            include "common/footer.php";
            break;
        }elseif($action=="otp-confirmation"){
            include "otp-confirmation.php";
            include "common/footer.php";
            break;
        }else{
            // Check if the requested page file exists
            $pageFilePath = $action . ".php";
            if (file_exists($pageFilePath)) {
                include $pageFilePath;
            } else {
                // If the page doesn't exist, display a 404 error page
                include "../404.php";
            }
            break;
        }
    default:
        // Check if the requested page file exists
        $pageFilePath = $page . ".php";
        if (file_exists($pageFilePath)) {
            include $pageFilePath;
        } else {
            // If the page doesn't exist, display a 404 error page
            include "../404.php";
        }
}
?>

</body>
<script src="https://kit.fontawesome.com/cbeb993ef9.js" crossorigin="anonymous"></script>
<script src="../design/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.7/dist/sweetalert2.all.min.js"></script>
</html>
