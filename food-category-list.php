<?php include "common/menu-header.php"?>

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
                        <div class="card h-100">
                            <img src="admin/product/uploads/<?php echo $food['food_item_image']?>" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title"><b><?php echo $food['food_item_name']; ?></b></h5>
                                <p class="card-text"><?php echo $food['food_item_description']; ?></p>
                                <div class="input-group px-4">
                                    <span class="input-group-text">Quantity</span>
                                    <input type="number" placeholder="1" min="1" max="20" class="form-control quantity-input" data-price="<?php echo $food['food_item_price']; ?>">
                                </div>
                                <div class="p-2">
                                    <p class="card-text" id="card-text">Price: NRS<?php echo $food['food_item_price']; ?></p>
                                </div>
                                <div class="mt-2 d-grid gap-2 d-md">
                                    <button class="btn btn-primary order">Order</button>
                                </div>
                            </div>
                        </div>
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
            this.closest('.card-body').querySelector('#card-text').textContent = "Price: NRS" + totalPrice.toFixed(2);
        });
    });
</script>