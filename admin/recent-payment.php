<?php
global $payment;
$payments = $payment->getTopPaymentDetails();
?>
<!-- Recent Payment -->
<div class="card">

    <div class="card-body">
        <h5 class="card-title">Recent Payment</h5>

        <div class="activity">

            <?php
            if(count($payments) > 0){
            foreach ($payments as $payment) {
                ?>
                <div class="activity-item d-flex">
                    <div class="activite-label w-25"><?php echo $payment['payment_date']; ?></div>
                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                    <div class="activity-content">
                        <p class="ps-2">
                            Customer <?= $payment['customer_name']; ?> paid NRS. <?= $payment['grand_total']; ?> for table <?= $payment['table_number']; ?> (Order: <?= $payment['order_code']; ?>) using <?= $payment['payment_method']; ?>.
                            Status: <?php
                            if ($payment['payment_status']=="Completed"){
                                echo "<span class='badge bg-success'>Completed</span>";
                            }elseif ($payment['payment_status']=="Failed") {
                                echo "<span class='badge bg-danger'>Failed</span>";
                            }else {
                                echo "<span class='badge bg-warning'>Pending</span>";
                            }
                            ?>.
                        </p>

                    </div>
                </div>
                <?php
            }
            }else{
                echo "<p>No recent payment found.</p>";
            }
            ?>
        </div>

    </div>
</div>