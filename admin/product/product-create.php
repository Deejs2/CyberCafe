<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  </head>
  <body>
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

  <?php
//database connection
include '../database/DatabaseConnection.php';
//select category id and name from category table
$statement = $connection->prepare("SELECT category_id, category_name FROM category");
$statement->execute();
$result = $statement->get_result();
$category = $result->fetch_all(MYSQLI_ASSOC);
?>



  <div class="row mb-3">
    <label for="categoryDropdown" class="col-sm-2 col-form-label">Categories</label>
    <div class="col-sm-10 dropdown">
<select class="form-control" id="categoryDropdown" name="category" required>
<option selected disabled>Select a category</option>

    <?php
    //run loop to display category options in the drop down menu
    foreach($category as $cat):
    ?>
    <option value="<?= $cat['category_id'] ?>"><?= $cat['category_name'] ?></option>
    <?php endforeach; ?>
</select>
</div>
  </div>
  <?php
  $connection->close();
  ?>

  <button type="submit" class="btn btn-primary mt-4">Upload</button>
</form>
</div>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../database/DatabaseConnection.php';

    $productName = $_POST['productName'] ?? '';
    $productDescription = $_POST['productDescription'] ?? '';
    $productPrice = $_POST['productPrice'] ?? '';
    $category = $_POST['category'] ?? '';

    //store the image in the uploads folder and only save the file name in the database
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["productImage"]["name"] ?? '');
    move_uploaded_file($_FILES["productImage"]["tmp_name"] ?? '', $target_file);

   //Insert Query for product
    $statement = $connection->prepare("INSERT INTO product (product_name, product_description, product_price, category_id, product_image, product_status) VALUES (?, ?, ?, ?, ?, 1)");
    $statement->bind_param("ssiss", $productName, $productDescription, $productPrice, $category, $target_file);
    $statement->execute();
    
    //Show a message when the Product is inserted
    echo "<script>alert('Data inserted successfully');</script>";





    $connection->close();

     // Redirect to the same page or another page
     header("Location: product-create.php");
     exit;
}
?>