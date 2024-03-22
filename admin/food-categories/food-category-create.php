<?php
// Check if category ID is provided and delete
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    if ($category->deleteCategory($categoryId)) {
        echo "Category deleted successfully.";
    } else {
        echo "Failed to delete category.";
    }
}

// Check if the form is submitted
if (isset($_GET['action']) && $_GET['action'] == 'create') {
    if(isset($_POST["create-category"])){
        $categoryName = $_POST["category-name"];
        $categoryStatus = 1;
        if ($category->createCategory($categoryName, $categoryStatus)) {
            echo "Category created successfully.";
        } else {
            echo "Failed to create category.";
        }
    }
}
?>
<div class="row">
    <div class="col-md-6">
        <form method="post">
            <h3>Create Food Category</h3>
            <div class="input-group mb-3">
                <input type="text" name="category-name" class="form-control">
                <button class="btn btn-outline-secondary" name="create-category" type="submit">Create</button>
            </div>
        </form>
    </div>
    <div class="col-md-6">
        <?php include "food-categories/food-category-list.php" ?>
    </div>
</div>