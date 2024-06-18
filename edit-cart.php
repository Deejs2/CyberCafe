<?php global$cart, $foodItem;
include "common/breadcrumb.php";

if(isset($_POST["update-cart"])){
    $cartId = $_GET["cartId"];
    $quantity = $_POST["quantity"];
    $updateCart = $cart->updateCart($cartId, $quantity);
    if($updateCart){
        $_SESSION["cart_msg"] = "Cart item updated successfully";
        header("Location: ?page=cart");
        exit();
    }
}

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
            <form method="post" class="row g-0 mb-0">
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
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" max="15" value="<?php echo $cartItem['food_item_quantity']; ?>">
                        </div>
                    </div>
                </div>
                <div class="card-footer pt-3 d-flex justify-content-between">
                    <a href="?page=cart" class="btn btn-primary">Back</a>
                    <button type="submit" name="update-cart" class="btn btn-success">Update</button>
                </div>
            </form>
        </div>
        <?php
    }
    ?>
</div>


