<?php

global $connection;

use model\Cart;
use model\Otp;
use model\User;

session_start();
require "../database/DatabaseConnection.php";
include "../model/User.php";
include "../mail-config.php";
include "../model/Otp.php";

include "../model/Cart.php";
$cart = new Cart($connection);
$otpModel = new Otp($connection);

$page = $_GET["page"] ?? "";
$action = $_GET["action"] ?? "Login";
$GLOBALS["menuLink"] = "../?page=menu";

// This is for Login
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $emailErr = $passwordErr = "";

    // Validate form
    if (empty($email)) {
        $emailErr = "Email is required!";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $emailErr = "Invalid email format!";
    }
    if (empty($password)) {
        $passwordErr = "Password is required!";
    }

    if (empty($emailErr) && empty($passwordErr)) {
        $user = new User($connection);
        $authenticatedUser = $user->authenticateUser($email, $password);

        if ($authenticatedUser) {
            $_SESSION["email"] = $email;
            header("Location: ../admin/?page=dashboard");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    }
}

//This is for Sending OTP
if (isset($_POST["send-otp"])) {
    $email = $_POST["email"];

    $emailErr = "";
    if (empty($email)) {
        $emailErr = "Email is required!";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $emailErr = "Invalid email format!";
    }else{
        $user = new User($connection);
        $userExists = $user->checkUserExists($email);

        if ($userExists) {
            // User exists
            // Generate OTP
            $otp = rand(100000, 999999);

            //saving email to localstorage use js
            $_SESSION["forgot_password_email"] = $email;

            // Save OTP to the database
            if($otpModel->saveOtp($email, $otp)){
                $subject = "Your One-Time Password (OTP)";
                $message = "
                            <html>
                            <head>
                                <title>OTP Verification</title>
                            </head>
                            <body>
                                <p>Hello,</p>
                                <p>Your OTP is: <strong>$otp</strong></p>
                                <p>Please use this code to complete your verification. The code is valid for 2 minutes.</p>
                                <p>Thank you!</p>
                                <p>CyberCafe</p>
                            </body>
                            </html>
                        ";

                // Send OTP
                sendOtpMail($email, $subject, $message);
                header("Location: ?page=auth&&action=otp-confirmation");
                exit();
                // Send OTP
                sendOtpMail($email, $subject, $message);
                header("Location: ?page=auth&&action=otp-confirmation");
                exit();
            }else{
                $error = "Failed to send OTP. Please try again.";
            }

        } else {
            // User doesn't exist
            $error = "User doesn't exist. Please enter a valid email.";
        }
    }

}

// validate otp
if(isset($_POST["validate-otp"])){
    $otp = $_POST["otp"];
    if(!isset($_SESSION["forgot_password_email"])){
        header("Location: ?page=auth&&action=forgot-password");
        exit();
    }
    $email = $_SESSION["forgot_password_email"];

    $otpErr = "";
    if (empty($otp)) {
        $otpErr = "OTP is required!";
    } elseif (!preg_match("/^[0-9]{6}$/", $otp)) {
        $otpErr = "Invalid OTP format!";
    }

    if (empty($otpErr)) {
        $otpDetails = $otpModel->validateOtp($email, $otp);
        if ($otpDetails) {
            //unset session
            unset($_SESSION["forgot_password_email"]);
            $_SESSION["email"] = $email;
            header("Location: ../admin/?page=user-profile");
            exit();
        } else {
            $otpErr = "Otp Expired or Invalid! Please try again.";
        }
    }
}

if(isset($_POST["resend-otp"])){
    if(!isset($_SESSION["forgot_password_email"])){
        header("Location: ?page=auth&&action=forgot-password");
        exit();
    }
    $email = $_SESSION["forgot_password_email"];

    // Generate OTP
    $otp = rand(100000, 999999);

    // Save OTP to the database
    if($otpModel->saveOtp($email, $otp)){
        $subject = "Your One-Time Password (OTP)";
        $message = "
        <html>
        <head>
            <title>OTP Verification</title>
        </head>
        <body>
            <p>Hello,</p>
            <p>Your OTP is: <strong>$otp</strong></p>
            <p>Please use this code to complete your verification. The code is valid for 2 minutes.</p>
            <p>Thank you!</p>
        </body>
        </html>
    ";


        // Send OTP
        sendOtpMail($email, $subject, $message);
        header("Location: ?page=auth&&action=otp-confirmation");
        exit();
    }else{
        $error = "Failed to send OTP. Please try again.";
    }
}

//This is for Register
if (isset($_POST["register"])) {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $contact_number = $_POST["contact-number"];

    $fnameErr = $lnameErr = $emailErr = $addressErr = $contactErr = $error = "";

    // Validate form
    if (empty($firstname)) {
        $fnameErr = "First name is required!";
    }
    if (empty($lastname)) {
        $lnameErr = "Last name is required!";
    }
    if (empty($email)) {
        $emailErr = "Email is required!";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $emailErr = "Invalid email format!";
    }
    if (empty($address)) {
        $addressErr = "Address is required!";
    }
    if (empty($contact_number)) {
        $contactErr = "Contact number is required!";
    } elseif (!preg_match("/^(98|97)\d{8}$/", $contact_number)) {
        $contactErr = "Invalid contact number! Must be 10 digits starting with 98 or 97.";
    }

    if (empty($fnameErr) && empty($lnameErr) && empty($emailErr) && empty($addressErr) && empty($contactErr)) {
        $user = new User($connection);
        $userExists = $user->checkUserExists($email);
        if ($userExists) {
            $error = "User already exists. Please login.";
        } else {
            $user->userRequest($firstname, $lastname, $email, $address, $contact_number);
            $subject = "CyberCafe | Registration Complete";
            $message = "You have successfully registered with CyberCafe. Please wait for the approval. we will notify via email. Thank you!";
            echo sendRegistrationMail($email, $subject, $message);
            header("Location: ?page=auth&&action=login");
            exit();
        }
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
        body {
            min-height: 75rem;
            padding-top: 4.5rem;
        }
    </style>
</head>
<body>
<div class="fixed-top bg-primary">
    <?php include "common/header.php"?>
</div>
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
