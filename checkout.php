<?php

global $order, $cart, $foodItem, $customer, $checkout;

if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
if(isset($_SESSION['transaction_msg'])){
    echo $_SESSION['transaction_msg'];
    unset($_SESSION['transaction_msg']);
}

if(isset($_POST['checkout'])){
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $paymentMethod = $_POST['options-base'];

    if(empty($fullName) || empty($email) || empty($phone) || empty($address)){
        header("Location: ?page=checkout&&msg=error");
    }else{
        $customer->addCustomer($fullName, $email, $phone, $address);
        $_SESSION['customer_id'] = $customer->getLatestCustomer()['customer_id'];
        $orders = $order->getOrdersByTable($_SESSION['table']);
        if ($orders && array_key_exists('order_code', $orders)) {
            $checkout->saveCheckout($orders['order_code'], $paymentMethod);
        }
    }

    if($paymentMethod == "esewa"){
        header("Location: payment/esewa-pay.php");
        exit();
    }elseif ($paymentMethod == "khalti"){
        header("Location: payment/khalti/request.php");
        exit();
    }else{
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Please provide cash to counter.',
                showConfirmButton: false,
                timer: 1500
            }).then(function(){
                window.location.href = '?page=menu';
            });
        </script>";
    }
}
?>

<div class="container p-5">
    <div class="row border p-4 shadow rounded-3">
        <div class="col-lg-8">
            <h3 class="fs-4">Billing Info</h3>
            <span>this is small text.</span>

            <form method="post" class="row py-3 g-3">
                <div class="col-md-4">
                    <label for="fullName" class="form-label">FullName <span class="text-danger">*</span></label>
                    <input type="text" name="fullName" class="form-control" id="fullName">
                    <span class="text-danger"><?php if(isset($_GET['msg'])){echo "Please enter a valid name!";} ?></span>
                </div>
                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email">
                    <span class="text-danger"><?php if(isset($_GET['msg'])){echo "Please enter a valid email!";} ?></span>
                </div>
                <div class="col-md-4">
                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="text" name="phone" class="form-control" id="phone">
                    <span class="text-danger"><?php if(isset($_GET['msg'])){echo "Please enter a valid phone!";} ?></span>
                </div>
                <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="Boudha, Kathmandu">
                </div>
                <div class="col w-auto">
                    <h3 class="fs-4">Payment Method :</h3>
                    <div class="container text-center">
                        <div class="row">
                            <div class="col">
                                <input type="radio" value="hand-cash" class="btn-check" name="options-base" id="option5" autocomplete="off" checked>
                                <label class="btn p-3 fs-2" for="option5">
                                    <img src="image/hand-cash.jpg" class="w-100" alt="">
                                </label>
                            </div>
                            <div class="col">
                                <input type="radio" value="esewa" class="btn-check" name="options-base" id="option6" autocomplete="off">
                                <label class="btn p-3 fs-2" for="option6">
                                    <img src="image/esewa-logo.jpg" class="w-100" alt="">
                                </label>
                            </div>
                            <div class="col">
                                <input type="radio" value="khalti" class="btn-check" name="options-base" id="option8" autocomplete="off">
                                <label class="btn p-3 fs-2" for="option8">
                                    <img src="image/khalti-logo.jpg" class="w-100" alt="">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" name="checkout" class="btn bg-primary text-white">Proceed</button>
                </div>
            </form>

        </div>
        <div class="col-lg-4">
           <div class="d-flex m-auto fs-4 justify-content-between bg-body-tertiary p-2">
               <span>Order Summary</span>
               <?php $orders = $order->getOrdersByTable($_SESSION['table']);
               if ($orders && array_key_exists('order_code', $orders)) {
                    echo "<span>" . htmlspecialchars($orders['order_code']) . "</span>";
                 } else {
                   echo "<span>No order code available</span>";
                 }
               ?>
           </div>
            <div class="table-responsive-sm">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Foods</th>
                        <th scope="col">Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $foods = $cart ->getCartItems($_SESSION['table']);
                    foreach ($foods as $food){
                        $foodItems = $foodItem->getItemById($food['food_item_id']);
                        if($foodItems){
                            ?>
                            <tr>
                                <td>
                                    <img src="admin/product/uploads/<?php echo $foodItems['food_item_image']; ?>" class="w-50" alt="...">
                                </td>
                                <td>
                                    <div><?php echo $foodItems['food_item_name'];?></div>
                                    <small style="font-size: small">NRS.
                                        <?php
                                        echo "$foodItems[food_item_price]"." x "."$food[food_item_quantity]"."=".$foodItems['food_item_price']*$food['food_item_quantity'];
                                        ?>
                                    </small>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <ul class="list-group list-group-flush mt-2">
                <li class="list-group-item d-flex justify-content-between align-items-center ps-2 bg-body-tertiary">
                    Grand Total
                    <span>NRS. <?php
                        $orders = $order->getOrdersByTable($_SESSION['table']);
                        if($orders && array_key_exists('grand_total', $orders)) {
                            echo $orders['grand_total'];
                        }else{
                            echo "0";
                        }
                        ?></span>
                </li>
            </ul>
        </div>
    </div>
</div>