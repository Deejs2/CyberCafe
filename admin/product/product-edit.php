
  <?php
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['productId'])) {
    $productId = $_GET['productId'];
    $foodItem = $product->getItemById($productId);
}

if(isset($_POST['update-product'])){
    $productName = $_POST['food-name'];
    $productDescription = $_POST['food-description'];
    $productPrice = $_POST['food-price'];
    $productCategory = $_POST['food-category'];
    $productImage = $_POST['food-image'];

    $product->updateItem($productId, $productName, $productDescription, $productPrice, $productCategory, $productImage, 1);
    if($product){
        echo "Product updated successfully.";
        echo "<script>window.location = '?page=product';</script>";
    } else {
        echo "Failed to update product.";
    }
}
?>


    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Food Item Details</h5>

            <!-- Multi Columns Form -->
            <form method="post" class="row g-3">
                <div class="col-md-12">
                    <label for="inputName5" class="form-label">FoodItem Name</label>
                    <input type="text" name="food-name" class="form-control" value="<?php echo $foodItem['food_item_name'];?>" id="inputName5">
                </div>
                <div class="col-md-12">
                    <label for="inputEmail5" class="form-label">Description</label>
                    <input type="text" name="food-description" class="form-control" value="<?php echo $foodItem['food_item_description'];?>" id="inputEmail5">
                </div>
                <div class="col-md-6">
                    <label for="inputPassword5" class="form-label">Price</label>
                    <input type="text" name="food-price" class="form-control" value="<?php echo $foodItem['food_item_price'];?>" id="inputPassword5">
                </div>
                <div class="col-md-6">
                    <label for="inputAddress5" class="form-label">Food Category</label>
                    <select id="inputState" name="food-category" class="form-select">
                        <?php
                        $categoryById = $category->getCategoryById($foodItem['food_category_id']);
                        ?>
                        <option value="<?php echo $categoryById['food_category_id'];?>"><?php echo $categoryById['food_category_name'];?></option>
                        <?php
                        foreach ($categories as $cat){
                            echo "<option value='".$cat['food_category_id']."'>".$cat['food_category_name']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="col-12">
                    <label for="inputNumber" class="col-sm-2 col-form-label">Food Item Image</label>
                    <div class="col-sm-12">
                        <input class="form-control" name="food-image" value="<?php echo $foodItem['food_item_image']?>" type="file" id="formFile">
                    </div>
                </div>
                <div class="text-start">
                    <button type="submit" name="update-product" class="btn btn-primary"><i class="fas fa-edit fa-md"></i> Update</button>
                </div>
            </form><!-- End Multi Columns Form -->

        </div>
    </div>


