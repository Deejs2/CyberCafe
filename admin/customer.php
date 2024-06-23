<?php global$customer;?>
<div class="card overflow-auto">
    <h5 class="card-title ps-3">Customer Details</h5>
    <div class="card-body">
        <div class="table-responsive" style="max-height: 430px; overflow-y: scroll">
        <table class="table table-responsive table-bordered table-striped align-middle">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">FullName</th>
                <th scope="col">Email</th>
                <th scope="col">Phone</th>
                <th scope="col">Address</th>
                <th scope="col">Visit Date</th>
            </tr>
            </thead>
            <tbody>
                <?php

            $results = $customer->getCustomers();

            if ($results) {
                // Output data of each row
                $counter = 1;
                foreach ($results as $result) {
                    ?>
            <tr>
                <th scope="row"><?php echo $counter++ ?></th>
                <td><?php echo $result['customer_name']; ?></td>
                <td><?php echo $result['customer_email']; ?></td>
                <td><?php echo $result['customer_phone']; ?></td>
                <td><?php echo $result['customer_address']; ?></td>
                <td><?php echo $result['visit_date']; ?></td>
            </tr>
            <?php
                }
            } else {
                echo "0 results";
            }

                ?>

            </tbody>
        </table>
    </div>
    </div>
</div>
