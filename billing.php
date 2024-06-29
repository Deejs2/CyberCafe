<?php
global $billing;
$billingDetails = $billing->getOrderDetails($_SESSION["customer_id"]);

if(isset($_SESSION['transaction_msg'])){
    echo $_SESSION['transaction_msg'];
    unset($_SESSION['transaction_msg']);
}
?>

<div class="my-5 vh-100">
    <div class="container py-5">
        <h2 class="mb-3">Order Details</h2>
        <p>Here's your latest order details, another copy is sent to your mail. This details will not available to you after making another order or closing application. You can also download it clicking download below:</p>

        <div class="table-responsive">
            <button id="download" class="btn btn-outline-success float-end my-3">Download as PDF</button>
            <table id="billing-details" class="table table-bordered">
                <thead>
                <tr>
                    <th>Customer Name</th>
                    <th>Table Number</th>
                    <th>Payment Method</th>
                    <th>Payment Status</th>
                    <th>Order Message</th>
                    <th>Order Code</th>
                    <th>Grand Total</th>
                    <th>Order Status</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($billingDetails as $billingDetail) : ?>
                    <tr>
                        <td><?php echo $billingDetail["customer_name"]; ?></td>
                        <td><?php echo $billingDetail["table_number"]; ?></td>
                        <td><?php echo $billingDetail["payment_method"]; ?></td>
                        <td><span  class="badge text-bg-success"><?php echo $billingDetail["payment_status"]; ?></span></td>
                        <td><?php echo $billingDetail["order_message"]; ?></td>
                        <td><?php echo $billingDetail["order_code"]; ?></td>
                        <td><?php echo $billingDetail["grand_total"]; ?></td>
                        <td><?php if($billingDetail["order_status"]=="Pending"){
                                echo "<span class='badge text-bg-warning text-white'>$billingDetail[order_status]</span>";
                            }else{
                                echo "<span class='badge text-bg-success'>$billingDetail[order_status]</span>";
                            } ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

<!--    <div class="container py-5">-->
<!--        <h2 class="mb-3">Product Details</h2>-->
<!--        <div class="table-responsive">-->
<!--            <table class="table table-bordered">-->
<!--                <thead>-->
<!--                <tr>-->
<!--                    <th>Food Item Name</th>-->
<!--                    <th>Food Item Description</th>-->
<!--                    <th>Food Item Image</th>-->
<!--                </tr>-->
<!--                </thead>-->
<!--                <tbody>-->
<!--                --><?php //foreach ($productDetails as $productDetail) : ?>
<!--                    <tr>-->
<!--                        <td>--><?php //echo $productDetail["food_item_name"]; ?><!--</td>-->
<!--                        <td>--><?php //echo $productDetail["food_item_description"]; ?><!--</td>-->
<!--                        <td><img src="admin/product/uploads/--><?php //echo $productDetail["food_item_image"]; ?><!--" alt="Food Item Image" width="100" height="100"></td>-->
<!--                    </tr>-->
<!--                --><?php //endforeach; ?>
<!--                </tbody>-->
<!--            </table>-->
<!--        </div>-->
<!--    </div>-->

</div>

