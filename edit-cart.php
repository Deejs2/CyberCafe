<?php global$cart, $foodItem;
include "common/breadcrumb.php";


?>

<div class="container my-3 border shadow rounded-3 p-3">
    <h2 class="my-3 p-3 bg-primary text-white text-center">Update Cart Item</h2>
    <?php
    if(isset($_GET["action"])&& $_GET["action"]=="edit"){
        $cartId = $_GET["cartId"];
        $cartItem = $cart->getCartById($cartId);
        $foodItems = $foodItem->getItemById($cartItem['food_item_id']);
        ?>
        <div class="card mb-3">
            <div class="row g-0">
                <?php
                $foodItems = $foodItem->getItemById($cartItem['food_item_id']);
                ?>
                <div class="col-md-4">
                    <img src="admin/product/uploads/<?php echo $foodItems['food_item_image']; ?>" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $foodItems['food_item_name'];?></h5>
                        <p class="card-text"><?php echo $foodItems['food_item_description'];?></p>
                        <form method="post">
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $cartItem['food_item_quantity']; ?>">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="?page=cart" class="btn btn-primary">Back</a>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</div>


