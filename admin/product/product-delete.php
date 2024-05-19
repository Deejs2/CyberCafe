<?php
// Check if category ID is provided and delete
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['productId'])) {
    $categoryId = $_GET['productId'];
    if ($product->deleteItem($categoryId)) {
        echo "Category deleted successfully.";
        // Redirect to a page or reload the current page using javascript
        echo "<script>window.location = '?page=product';</script>";
    } else {
        echo "Failed to delete category.";
    }
}