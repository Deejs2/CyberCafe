
<div class="card overflow-auto">
    <h5 class="card-title ps-3">Product Details</h5>
    <div class="card-body">
        <div class="table-responsive" style="max-height: 430px; overflow-y: scroll">
            <table class="table table-responsive table-bordered table-striped align-middle">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              <?php
              $foodItems = $product->getAllItems();
              ?>
                <?php if ($foodItems){
                    foreach ($foodItems as $food){
                    ?>
                  <tr>
            <th scope="row"><?= $food['food_item_id']; ?></th>
            <td><?= $food['food_item_name']; ?></td>
            <td><?= $food['food_item_description']; ?></td>

            <td><img class="image-fluid" src="product/uploads/<?= $food['food_item_image']; ?>" height="50px" alt="Product Image"></td>


            <td><?= $food['food_item_status']; ?></td>
            <td>NRS <?= $food['food_item_price']; ?></td>
            <td>
                <?php
                $categories = $category->getCategoryById($food['food_category_id']);
                echo $categories['food_category_name'];
                ?>
            </td>
            <td>
                <a href="?page=product&&action=edit&&productId=<?=$food['food_item_id']; ?>"><i class="fas fa-edit fa-md"></i></a>&nbsp;&nbsp
                <a href="?page=product&&action=delete&&productId=<?=$food['food_item_id']; ?>"><i class="fas fa-trash fa-md" style="color: red;">
                </i></a>
            </td>
        </tr>
        <?php }}else{
                    echo "<tr><td colspan='8' class='text-center'>No data found</td></tr>";
                }?>
            </tbody>
        </table>
    </div>
</div>
</div>

