<?php global$product, $order, $customer;
?>
<section class="section dashboard">
    <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-8">
            <div class="row">

                <!-- Product Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">

                        <div class="card-body">
                            <h5 class="card-title">Product <span>| All Products</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-brands fa-product-hunt"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>
                                        <?php
                                        $products = $product->countItems();
                                        echo $products['total'];
                                        ?>
                                    </h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Product Card -->

                <!-- Order Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">

                        <div class="card-body">
                            <h5 class="card-title">Order <span>| This Month</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-file-signature"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>NPR.
                                        <?php
                                        $orders = $order->sumOrdersThisMonth();
                                        echo $orders['total'];
                                        ?>
                                    </h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><!-- End Order Card -->

                <!-- Customers Card -->
                <div class="col-xxl-4 col-xl-12">

                    <div class="card info-card customers-card">

                        <div class="card-body">
                            <h5 class="card-title">Customers <span>| This Month</span></h5>

                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-people-group"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>
                                        <?php
                                        $customers = $customer->countCustomersThisMonth();
                                        echo $customers['total'];
                                        ?>
                                    </h6>
                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- End Customers Card -->

                <!-- Recent Orders -->
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-body">
                            <h5 class="card-title">Recent Orders</h5>

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped align-middle">
                                    <thead>
                                    <tr>
                                        <th scope="col">Table Number</th>
                                        <th scope="col">Order Message</th>
                                        <th scope="col">Order Code</th>
                                        <th scope="col">Order Date</th>
                                        <th scope="col">Grand Total</th>
                                        <th scope="col">Order Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $orders = $order->getTopOrders();
                                    if(count($orders) > 0){
                                        foreach ($orders as $order) {
                                            ?>
                                            <tr>
                                                <td><?php echo $order['table_number']; ?></td>
                                                <td><?php echo $order['order_message']; ?></td>
                                                <td><?php echo $order['order_code']; ?></td>
                                                <td><?php echo $order['order_date']; ?></td>
                                                <td>NPR. <?php echo $order['grand_total']; ?></td>
                                                <td><?php
                                                    if($order['order_status']=="Served"){
                                                        echo "<span class='badge bg-success'>Served</span>";
                                                    }elseif($order['order_status']=="Cancelled"){
                                                        echo "<span class='badge bg-danger'>Cancelled</span>";
                                                    }else{
                                                        echo "<span class='badge bg-warning'>Pending</span>";
                                                    }
                                                    ?></td>
                                            </tr>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                        <tr>
                                            <td colspan="6">No recent orders found</td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div><!-- End Recent Orders -->

            </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->
        <div class="col-lg-4">

            <?php include "recent-payment.php" ?>

        </div><!-- End Right side columns -->

    </div>
</section>