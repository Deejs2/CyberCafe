<?php
// Check if category ID is provided and delete
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    if ($category->deleteCategory($categoryId)) {
        echo "Category deleted successfully.";
        // Redirect to a page or reload the current page using javascript
        echo "<script>window.location = '?page=food-categories&&action=create';</script>";
    } else {
        echo "Failed to delete category.";
    }
}