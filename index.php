<?php
ob_start();
global $connection;
session_start();
if(isset($_GET["table"])){
    $_SESSION["table"] = $_GET["table"];
}
if(!isset($_SESSION["table"])){
    header("Location: select-table.php");
    exit();
}
include "database/DatabaseConnection.php";
$page = $_GET["page"] ?? "menu";
$action = $_GET["action"] ?? "";
$GLOBALS["menuLink"] = "?page=menu";

use model\Checkout;
use model\Customer;
use model\FoodCategory;
use model\FoodItem;
use model\Cart;
use model\Order;
use model\Promocode;

include "model/FoodCategory.php";
$category = new FoodCategory($connection);
include "model/FoodItem.php";
$foodItem = new FoodItem($connection);

include "model/Cart.php";
$cart = new Cart($connection);

include "model/PromoCode.php";
$promo = new PromoCode($connection);

include "model/Order.php";
$order = new Order($connection);

include "model/Customer.php";
$customer = new Customer($connection);

include "model/Checkout.php";
$checkout = new Checkout($connection);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberCafe | <?php echo ucfirst($page)?></title>
    <link rel="stylesheet" href="design/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="design/css/style.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<body>

<?php include "common/header.php"?>

<?php
switch($page){
    case "menu":
        if($action == "filter"){
            include "food-category-list.php";
        } else {
            include "menu.php";
        }
        break;

    case "cart":
        if($action == "edit"){
            include "edit-cart.php";
            break;
        }
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