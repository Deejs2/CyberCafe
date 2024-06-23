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
    $paymentMethod = $_POST['options-base'] ?? null;

    $fullNameErr = $emailErr = $phoneErr = $paymentErr = "";

    // Check if the name is empty
    if (empty($fullName)) {
        $fullNameErr = "Name is required";
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $fullName)) {
            $fullNameErr = "Only letters and white space allowed";
        }
    }

    // Check if the email is empty
    if (empty($email)) {
        $emailErr = "Email is required!";
    } elseif (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
        $emailErr = "Invalid email format!";
    }

    // Check phone format
    if (!preg_match("/^(98|97)\d{8}$/", $phone) && !empty($phone)) {
        $phoneErr = "Invalid contact number! Must be 10 digits starting with 98 or 97.";
    }

    // Check if the payment method is empty
    if (empty($paymentMethod)) {
        $paymentErr = "Please select a payment method!";
    }

    // Check if there are no errors
    if (empty($fullNameErr) && empty($emailErr) && empty($phoneErr) && empty($paymentErr)) {
        $customer->addCustomer($fullName, $email, $phone, $address);
        $_SESSION['customer_id'] = $customer->getLatestCustomer()['customer_id'];
        $orders = $order->getOrdersByTable($_SESSION['table']);
        if ($orders && array_key_exists('order_code', $orders)) {
            $checkout->saveCheckout($orders['order_code'], $paymentMethod);
        }

        if($paymentMethod == "esewa"){
            header("Location: payment/esewa/payment-request.php");
            exit();
        }
        if ($paymentMethod == "khalti"){
            header("Location: payment/khalti/request.php");
            exit();
        }
    }
}
?>

<div class="container p-5">
    <div class="row border p-4 shadow rounded-3">
        <div class="col-lg-8 d-flex justify-content-center py-3">
            <div class="w-100 px-3">
                <h3 class="fs-4">Billing Info</h3>
                <span class="my-2">Please provide your billing information below. Ensure your billing details are accurate.</span>

                <form method="post" class="row py-3 g-3">
                    <div class="col-md-4">
                        <label for="fullName" class="form-label">Full Name <span class="text-danger">*</span></label>
                        <input type="text" name="fullName" class="form-control" id="fullName">
                        <span class="text-danger"><?= (isset($fullNameErr))? $fullNameErr : ''; ?></span>
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" id="email">
                        <span class="text-danger"><?= (isset($emailErr))? $emailErr : ''; ?></span>
                    </div>
                    <div class="col-md-4">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone">
                        <span class="text-danger"><?= (isset($phoneErr))? $phoneErr : ''; ?></span>
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="Boudha, Kathmandu">
                    </div>
                    <div class="col-12">
                        <h3 class="fs-4">Payment Method <span class="text-danger">*</span></h3>
                        <div class="row">
                            <div class="col text-center">
                                <input type="radio" value="esewa" class="btn-check" name="options-base" id="option6">
                                <label class="btn fs-2" for="option6">
                                    <img src="image/esewa-logo.png" class="w-100 h-50" alt="">
                                </label>
                            </div>
                            <div class="col text-center">
                                <input type="radio" value="khalti" class="btn-check" name="options-base" id="option8" autocomplete="off">
                                <label class="btn fs-2" for="option8">
                                    <img src="image/khalti-logo.jpg" class="w-100 h-50" alt="">
                                </label>
                            </div>
                        </div>
                        <span class="text-danger"><?= (isset($paymentErr))? $paymentErr : ''; ?></span>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="checkout" class="btn bg-primary text-white">Proceed</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-4 px-3">
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
            <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Foods</th>
                        <th scope="col">Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $foods = $cart->getCartItems($_SESSION['table']);
                    foreach ($foods as $food) {
                        $foodItems = $foodItem->getItemById($food['food_item_id']);
                        if ($foodItems) {
                            ?>
                            <tr>
                                <td>
                                    <img src="admin/product/uploads/<?php echo $foodItems['food_item_image']; ?>" class="w-50" alt="...">
                                </td>
                                <td>
                                    <div><?php echo $foodItems['food_item_name']; ?></div>
                                    <small style="font-size: small">NPR.
                                        <?php
                                        echo "$foodItems[food_item_price]" . " x " . "$food[food_item_quantity]" . "=" . $foodItems['food_item_price'] * $food['food_item_quantity'];
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
                    <span>NPR. <?php
                        $orders = $order->getOrdersByTable($_SESSION['table']);
                        if ($orders && array_key_exists('grand_total', $orders)) {
                            echo $orders['grand_total'];
                        } else {
                            echo "0";
                        }
                        ?></span>
                </li>
            </ul>
        </div>
    </div>
</div>
