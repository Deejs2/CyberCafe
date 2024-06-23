<?php global $category, $foodItem, $cart;
include "common/menu-header.php";

if(isset($_POST['addToCart']) && isset($_SESSION['table'])){
    $foodItemId = $_POST['foodItemId'];
    $quantity = $_POST['quantity'];
    $tableNumber = $_SESSION['table'];
    $foodItemTotal = $quantity * $foodItem->getItemById($foodItemId)['food_item_price'];

    if($cart->addItemToCart($foodItemId, $quantity, $tableNumber, $foodItemTotal)){
        echo "<script>Swal.fire({
            title: 'Success!',
            text: 'Item added to cart successfully',
            icon: 'success'
        });</script>";
        header("Refresh:2");
        exit();
    } else {
        echo "<script>Swal.fire({
            title: 'Error!',
            text: 'Failed to add item to cart',
            icon: 'error'
        });</script>";
    }
}
?>

<!-- Card Display -->
<div class="container pb-5">
        <h3 class="mt-5">
            <?php
            $cat = $category->getCategoryById($_GET['categoryId']);
            echo $cat['food_category_name']; ?>
        </h3>
        <div class="row row-cols-1 row-cols-md-3 g-4 my-2">
            <?php
            $foodItems = $foodItem->getItemsByCategory($_GET['categoryId']);
            if ($foodItems != null) {
                foreach ($foodItems as $food) {
                    ?>
                    <div class="col">
                        <form method="post" class="card h-100">
                            <img src="admin/product/uploads/<?php echo $food['food_item_image']?>" class="card-img-top h-50" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title"><b><?php echo $food['food_item_name']; ?></b></h5>
                                <p class="card-text"><?php echo $food['food_item_description']; ?></p>
                                <div hidden="hidden">
                                    <input type="text" name="foodItemId" value="<?php echo $food['food_item_id'];?>">
                                </div>
                                <div class="input-group px-4">
                                    <span class="input-group-text">Quantity</span>
                                    <input type="number" name="quantity" min="1" max="20" class="form-control quantity-input" data-price="<?php echo $food['food_item_price']; ?>" value="1">
                                </div>
                                <div class="p-2">
                                    <p class="card-text" id="card-text">Price: NPR <?php echo $food['food_item_price']; ?></p>
                                </div>
                                <div class="mt-2 d-grid gap-2 d-md">
                                    <button type="submit" name="addToCart" class="btn bg-primary text-white order">Add To Cart</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                }
            } else {
                echo "<p class='text-center'>No items found in this category</p>";
            }
            ?>
        </div>
</div>

<script>
    document.querySelectorAll('.quantity-input').forEach(function (input) {
        input.addEventListener('input', function () {
            let quantity = parseInt(this.value) || 1;
            let price = parseFloat(this.getAttribute('data-price'));
            let totalPrice = quantity * price;
            this.closest('.card-body').querySelector('#card-text').textContent = "Price: NPR" + totalPrice.toFixed(2);
        });
    });
</script>