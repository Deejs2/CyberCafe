<?php global$customer;?>
<div class="table-responsive">
    <table class="table shadow-sm p-3 mb-5 bg-body-tertiary rounded">
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
