<?php global $foodItem, $cart, $promo, $order;
include "common/breadcrumb.php"?>


<?php
$cartItems = $cart->getCartItems($_SESSION['table']);

if(isset($_GET["action"]) && $_GET["action"]=="delete") {
    $id = $_GET["cartId"];
    if ($cart->deleteCartItem($id)) {
        // Store the success message in a session variable
        $_SESSION['message'] = "<script>Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Cart with id: " . $id . " Deleted Successfully!',
            showConfirmButton: false,
            timer: 1500
        });</script>";
    } else {
        // Store the error message in a session variable
        $_SESSION['message'] = "<script>Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Failed to delete cart with id: " . $id . "',
            showConfirmButton: false,
            timer: 1500
        });</script>";
    }

    header("Location: ?page=cart");
    exit();
}

// Display the message and then unset the session variable
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}

if(isset($_POST['checkout'])){
    $message = $_POST["message"];
    $grandTotal = $_POST["grand-total"];
    $orders = $order->addOrder($_SESSION['table'],$grandTotal, $message);
    if($orders){
        $_SESSION['msg']= "<script>Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Order placed successfully!',
            showConfirmButton: false,
            timer: 1500
        });</script>";

        header("Location: ?page=checkout");
        exit();
    }else{
        $_SESSION['msg']= "<script>Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Failed to place order!',
            showConfirmButton: false,
            timer: 1500
        });</script>";

    }
}

?>

<div class="container my-3 border shadow rounded-3 p-3">
    <div class="table-responsive text-center">
        <h2 class="my-3 p-3 bg-primary text-white">Your Cart</h2>
        <table class="table align-middle">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Action</th>
                <th scope="col">Photo</th>
                <th scope="col">Items</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            foreach ($cartItems as $item) {
                $foodItems = $foodItem->getItemById($item['food_item_id']);
                ?>
                <tr>
                    <th scope="row"><?php echo $i++; ?></th>
                    <td>
                        <a href="?page=cart&action=delete&cartId=<?php echo $item['cart_id']; ?>" class="text-danger me-2"><i class="fa-solid fa-trash"></i></a>
                        <!-- Modal trigger -->
                        <a href ="?page=cart&action=edit&cartId=<?php echo $item['cart_id']; ?>" class="text-primary"><i class="fa-solid fa-edit"></i></a>
                    </td>
                    <td><img src="admin/product/uploads/<?php echo $foodItems['food_item_image']; ?>" class="img-fluid" style="height: 100px; width: 130px" alt=""></td>
                    <td><?php echo $foodItems['food_item_name']; ?></td>
                    <td><?php echo $item['food_item_quantity']; ?></td>
                    <td>NRS. <?php echo $foodItems['food_item_price']; ?></td>
                    <td>NRS. <?php echo $item['food_item_total']; ?></td>
                </tr>
                <?php
            }
            if(!$cartItems){
                echo "<tr><td colspan='7' class='text-danger text-center fs-4 py-4'>No items in the cart</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <form method="post" class="m-3">
        <hr>

        <div class="row row-cols-1 row-cols-sm-2 text-start">
            <form method="post">
            <div class="col">
                <div class="mb-3">
                    <div class="input-group">
                        <label>
                            <input class="form-control" name="promoCode" type="text" placeholder="Coupon Code">
                        </label>
                        <button type="submit" name="apply-promo-code" class="input-group-text bg-primary"><span class="text-white">Apply</span></button>
                    </div>
                    <?php
                    if(isset($_POST['apply-promo-code'])){
                        $promoCode = $_POST['promoCode'];
                        $promoCodeDetails = $promo->getPromoCode($promoCode);
                        if(!$promoCodeDetails){echo "<span class='text-danger'>Invalid Promo Code</span>";}
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Order Message</label>
                    <label class="input-group">
                        <textarea name="message" class="form-control" placeholder="Message here" rows="3"></textarea>
                    </label>
                </div>
            </div>
            <div class="col">
                <ol class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Sub Total</div>
                            Total without discount & promo code
                        </div>
                        <span class="badge text-bg-primary rounded-pill">NRS. <?php if($cart->sumTotal($_SESSION['table'])['total']){echo $cart->sumTotal($_SESSION['table'])['total'];}else{echo 0;}?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Discount</div>
                            Spent above NRS. 800 and get 2% discount
                        </div>
                        <span class="badge text-bg-primary rounded-pill">NRS. <?php if($cart->sumTotal($_SESSION['table'])['total']>800){echo $cart->sumTotal($_SESSION['table'])['total']*0.02;}else{echo 0;} ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Promo code</div>
                            <?php if(isset($_POST['apply-promo-code'])){echo "Promo code applied";}else{echo "Apply promo code";} ?>
                        </div>
                        <span class="badge text-bg-primary rounded-pill">
                            NRS. <?php
                            if(isset($_POST['apply-promo-code'])){
                                $promoCode = $_POST['promoCode'];
                                $promoCodeDetails = $promo->getPromoCode($promoCode);
                                if($promoCodeDetails){
                                    $discount = $promoCodeDetails['promo_code_discount'];
                                    echo $discount;
                                } else {
                                    echo 0;
                                }
                            }else{
                                echo 0;
                            }
                            ?>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Amount</div>
                        </div>
                        <span>NRS.
                            <?php
                                $grandTotal = $cart->sumTotal($_SESSION['table'])['total'];
                                if($cart->sumTotal($_SESSION['table'])['total']>800) {
                                    $grandTotal -= $cart->sumTotal($_SESSION['table'])['total'] * 0.02;
                                }
                                if(isset($_POST['apply-promo-code'])){
                                $promoCode = $_POST['promoCode'];
                                $promoCodeDetails = $promo->getPromoCode($promoCode);
                                    if($promoCodeDetails){
                                        $discount = $promoCodeDetails['promo_code_discount'];
                                        $grandTotal -= $discount;
                                    }
                                }
                                echo $grandTotal;
                            ?>
                        </span>
                        <label>
                            <input name="grand-total" type="hidden" value="<?php echo $grandTotal;?>">
                        </label>
                    </li>
                </ol>
            </div>
        </div>
        <div class="button-group text-end mt-3">
            <button name="checkout" class="btn bg-success text-white" type="submit">Proceed to Checkout <i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </form>
</div>

