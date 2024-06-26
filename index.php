<?php
include "database/DatabaseConnection.php";
$page = $_GET["page"] ?? "menu";
$action = $_GET["action"] ?? "";
$GLOBALS["menuLink"] = "?page=menu";

use model\FoodCategory;
use model\FoodItem;

include "model/FoodCategory.php";
$category = new FoodCategory($connection);
include "model/FoodItem.php";
$foodItem = new FoodItem($connection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberCafe | <?php echo ucfirst($page)?></title>
    <link rel="stylesheet" href="design/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="design/css/style.css">
    <link rel="stylesheet" href="design/css/landing.css">
</head>
<body>

<?php include "common/header.php"?>

<?php
switch($page){
    case "menu":
        if($action == "filter"){
            include "food-category-list.php";
            break;
        } else {
            include "menu.php";
            break;
        }

    case "cart":
        include "cart.php";
        break;

    case "checkout":
        include "checkout.php";
        break;

    default:
        // Check if the requested page file exists
        $pageFilePath = $page . ".php";
        if (file_exists($pageFilePath)) {
            include $pageFilePath;
        } else {
            // If the page doesn't exist, display a 404 error page
            include "404.php";
        }
}
?>

<?php include "common/footer.php"?>

</body>
<script src="https://kit.fontawesome.com/cbeb993ef9.js" crossorigin="anonymous"></script>
<script src="design/bootstrap/js/bootstrap.bundle.min.js"></script>
</html>