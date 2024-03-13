<?php
$GLOBALS["page"] = $page = $_GET["page"] ?? "dashboard";
$action = $_GET["action"] ?? "";
$GLOBALS["menuLink"] = "?page=dashboard";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - CyberCafe</title>

    <link href="../image/CyberCafe-white.png" rel="icon">
    <link rel="stylesheet" href="../design/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="design/css/style.css">
</head>

<body>
<?php include "common/header.php"?>

<?php include "common/sidebar.php"?>
<main id="main" class="main">

    <?php include "common/page-title.php"?>

    <?php
        switch ($page){
            case "dashboard":
                include "dashboard.php";
                break;

            case "customer":
                include "customer.php";
                break;

            case "user":
                if($action == "user-request"){
                    include "user-request.php";
                } else {
                    include "user.php";
                }
                break;

            case "order":
                include "order.php";
                break;

            case "product":
                include "product.php";
                break;

            case "recent-activity":
                include "recent-activity.php";
                break;

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

</main><!-- End #main -->

<?php include "common/footer.php"?>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="fa-solid fa-arrow-up"></i></a>

<!-- Vendor JS Files -->
<script src="../design/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="design/js/main.js"></script>
<script src="https://kit.fontawesome.com/cbeb993ef9.js" crossorigin="anonymous"></script>

</body>

</html>