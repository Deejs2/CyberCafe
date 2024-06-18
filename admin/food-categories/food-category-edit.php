<?php
// Check if category ID is provided and delete
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $categoryId = $_GET['id'];
    $categories = $category->getCategoryById($categoryId);
    if(isset($_POST["update-category"])){
        $categoryName = $_POST["category-name"];
        $categoryStatus = $_POST["category-status"];
        echo $categoryName;
        echo $categoryStatus;
        if ($category->updateCategory($categoryId, $categoryName, $categoryStatus)) {
            echo "Category updated successfully.";

            // Redirect to a page or reload the current page
         header("Location: ?page=food-categories&&action=create");
         exit();
        } else {
            echo "Failed to update category.";
        }
    }
}
?>

<div class="card overflow-auto">
    <h5 class="card-title ps-3">Edit Food Category</h5>
    <div class="card-body">
    <div class="row">
        <div class="col-md-8">
            <form method="post">
                <div class="input-group mb-3">
                    <div class="col-6 px-1">
                        <input type="text" name="category-name" value="<?php echo $categories['food_category_name']?>" class="form-control">
                    </div>
                    <div class="col-2">
                        <label class="visually-hidden" for="inlineFormSelectPref">Preference</label>
                        <select class="form-select" name="category-status" id="inlineFormSelectPref">
                            <?php
                                if($categories['food_category_status']){
                                    echo '<option value="1" selected disabled>Active</option>';
                                }else{
                                    echo '<option value="0" selected disabled>InActive</option>';
                                }
                            ?>
                            <option value="0">InActive</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                    <div class="col-2 px-1">
                        <button class="btn btn-outline-secondary" name="update-category" type="submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>