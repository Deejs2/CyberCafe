<?php global$order; ?>
<table class="table table-responsive table-striped">
    <thead>
    <tr>
        <th scope="col">SN</th>
        <th scope="col">Table Number</th>
        <th scope="col">Order Message</th>
        <th scope="col">Order Code</th>
        <th scope="col">Order Date</th>
        <th scope="col">Grand Total</th>
        <th scope="col">Order Status</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $orders = $order->getOrders();
        foreach ($orders as $order){
            $counter = 1;
    ?>
    <tr>
        <th><?php echo $counter++; ?></th>
        <td><?php echo $order['table_number'];?></td>
        <td><?php echo $order['order_message'];?></td>
        <td><?php echo $order['order_code'];?></td>
        <td><?php echo $order['order_date'];?></td>
        <td><?php echo $order['grand_total'];?></td>
        <td><?php echo $order['order_status'];?></td>
        <td>
            <a href="order.php?action=approve&order_id=<?php echo $order['order_id'];?>" class="btn btn-success">Approve</a>
            <a href="order.php?action=cancel&order_id=<?php echo $order['order_id'];?>" class="btn btn-danger">Cancel</a>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>