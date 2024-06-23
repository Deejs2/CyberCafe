<?php
if(isset($_POST['create-product'])){
    //get the values from the form
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $category = $_POST['category'];
    $productImage = $_FILES['productImage']['name'];
    $productImageTemp = $_FILES['productImage']['tmp_name'];
    //move the image to the images folder
    move_uploaded_file($productImageTemp, "product/uploads/$productImage");

    $productCreate = $product->createItem($productName, $productDescription, $productPrice, $category, $productImage, 1);
    //redirect to the product page
    header("Location: ?page=product");
}
?>

<div class="card overflow-auto">
    <h5 class="card-title ps-3">Create Product</h5>
    <div class="card-body">

    <form action="" method="POST"  enctype="multipart/form-data">
        <div class="container justify-content-center">
      <div class="row mb-3 mt-3">
        <label for="productName" class="col-sm-2 col-form-label">Product Name </label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name" required>
        </div>
      </div>

      <div class="row mb-3">
        <label for="productDescription" class="col-sm-2 col-form-label">Product Description</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="productDescription" name="productDescription" placeholder="Enter product description" required>
        </div>
      </div>

      <div class="row mb-3">
        <label for="productImage" class="col-sm-2 col-form-label">Product Image</label>
        <div class="col-sm-10">
          <input type="file" class="form-control" id="productImage" name="productImage" accept=".png, .jpg, .jpeg, .svg" required>
          </div>
      </div>

      <div class="row mb-3">
        <label for="productPrice" class="col-sm-2 col-form-label" >Product Price</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Enter product price" step="0.01" required>
        </div>
      </div>

      <div class="row mb-3">
        <label for="categoryDropdown" class="col-sm-2 col-form-label">Categories</label>
        <div class="col-sm-10 dropdown">
    <select class="form-control" id="categoryDropdown" name="category" required>
    <option selected disabled>Select a category</option>

        <?php
        $category = $category->getAllCategories();
        foreach($category as $cat):
        ?>
        <option value="<?= $cat['food_category_id'] ?>"><?= $cat['food_category_name'] ?></option>
        <?php endforeach; ?>
    </select>
    </div>
      </div>


      <button type="submit" name="create-product" class="btn btn-primary mt-4">Create</button>
    </form>
    </div>
</div>