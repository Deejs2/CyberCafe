<?php
global $order, $orders;

if (isset($_GET['action']) && isset($_GET['order_id'])) {
    $action = $_GET['action'];
    $order_id = $_GET['order_id'];
    if ($action == "served") {
        echo $order_id, $action;
        $order->updateOrderStatus($order_id, "Served");
        header("Location: ?page=order");
        exit();
    } else if ($action == "cancel") {
        $order->updateOrderStatus($order_id, "Cancelled");
        header("Location: ?page=order");
        exit();
    }
}

$orders = $order->getOrders();
?>
<style>
    .active > .page-link {
        z-index: 3 !important;;
        color: var(--bs-pagination-active-color) !important;;
        background-color: rgb(226, 144, 20) !important;
        border-color: rgb(226, 144, 20) !important;
    }
</style>
<div class="container mt-4">
    <div class="card recent-sales overflow-auto">
        <h5 class="card-title ps-3">Order Details</h5>
        <div class="card-body">
            <table class="table table-responsive table-bordered table-striped align-middle" id="orderTable">
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
                </tbody>
            </table>

            <nav>
                <ul class="pagination justify-content-center" id="orderTablePagination"></ul>
            </nav>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const orders = <?php echo json_encode($orders); ?>;
    if (orders.length === 0) {
        document.getElementById('orderTable').innerHTML = '<tr><td colspan="8">No recent orders found</td></tr>';
    } else {
        const renderOrderTable = (data, start) => {
            return data.map((order, index) => `
                <tr>
                    <th>${start + index + 1}</th>
                    <td>${order.table_number}</td>
                    <td>${order.order_message}</td>
                    <td>${order.order_code}</td>
                    <td>${order.order_date}</td>
                    <td>NRS ${order.grand_total}</td>
                    <td>${order.order_status}</td>
                    <td>
                        ${order.order_status !== "Served" && order.order_status !== "Cancelled" ? `
                            <a href="?page=order&&action=served&&order_id=${order.order_id}" class="btn btn-success">Served</a>
                            <a href="?page=order&&action=cancel&&order_id=${order.order_id}" class="btn btn-danger">Cancel</a>
                        ` : ''}
                    </td>
                </tr>
            `).join('');
        };

        initializePagination(orders, 10, 'orderTable', 'orderTablePagination', renderOrderTable);
    }
});
</script>

<script src="design/js/pagination.js"></script>


