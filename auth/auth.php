<?php
require "../database/DatabaseConnection.php";

$page = $_GET["page"] ?? "";
$action = $_GET["action"] ?? "Login";
$GLOBALS["menuLink"] = "../?page=menu";

if(isset($_POST["login"])){
    header("Location: ../admin/dashboard.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberCafe | <?php echo ucfirst($action)?></title>
    <link rel="stylesheet" href="../design/bootstrap/css/bootstrap.css">
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
</html>
