<?php
ob_start(); // Start output buffering
session_start();

use model\FoodCategory;
use model\FoodItem;

if(!isset($_SESSION["email"])){
    header("Location: ../auth/auth.php?page=auth");
    exit();
}

include "../database/DatabaseConnection.php";
include "../model/FoodCategory.php";
include "../model/FoodItem.php";

$GLOBALS["page"] = $page = $_GET["page"] ?? "dashboard";
$action = $_GET["action"] ?? "";
$GLOBALS["menuLink"] = "?page=dashboard";

$category = new FoodCategory($connection);
$product = new FoodItem($connection);
$categories = $category->getAllCategories();
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
                if($action == "create"){
                    include "product/product-create.php";
                } else if($action == "edit"){
                    include "product/product-edit.php";
                }else if($action == "delete"){
                    include "product/product-delete.php";
                }
                else {
                    include "product/product-list.php";
                }
                break;

            case "recent-activity":
                include "recent-activity.php";
                break;

            case "food-categories":
                if($action == "create"){
                    include "food-categories/food-category-create.php";
                } else if($action == "edit"){
                    include "food-categories/food-category-edit.php";
                }else if($action == "delete"){
                    include "food-categories/food-category-delete.php";
                }
                else {
                    include "food-categories/food-category-list.php";
                }
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

</body>
<!-- Vendor JS Files -->
<script src="../design/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/cbeb993ef9.js" crossorigin="anonymous"></script>
<script>

    /**
     * Template Name: NiceAdmin
     * Updated: Jan 29 2024 with Bootstrap v5.3.2
     * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
     * Author: BootstrapMade.com
     * License: https://bootstrapmade.com/license/
     */
    (function() {
        "use strict";

        /**
         * Easy selector helper function
         */
        const select = (el, all = false) => {
            el = el.trim()
            if (all) {
                return [...document.querySelectorAll(el)]
            } else {
                return document.querySelector(el)
            }
        }

        /**
         * Easy event listener function
         */
        const on = (type, el, listener, all = false) => {
            if (all) {
                select(el, all).forEach(e => e.addEventListener(type, listener))
            } else {
                select(el, all).addEventListener(type, listener)
            }
        }

        /**
         * Sidebar toggle
         */
        if (select('.toggle-sidebar-btn')) {
            on('click', '.toggle-sidebar-btn', function(e) {
                select('body').classList.toggle('toggle-sidebar')
            })
        }

        /**
         * Search bar toggle
         */
        if (select('.search-bar-toggle')) {
            on('click', '.search-bar-toggle', function(e) {
                select('.search-bar').classList.toggle('search-bar-show')
            })
        }

        /**
         * Autoresize echart charts
         */
        const mainContainer = select('#main');
        if (mainContainer) {
            setTimeout(() => {
                new ResizeObserver(function() {
                    select('.echart', true).forEach(getEchart => {
                        echarts.getInstanceByDom(getEchart).resize();
                    })
                }).observe(mainContainer);
            }, 200);
        }

    })();
</script>
</html>