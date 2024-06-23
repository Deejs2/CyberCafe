<?php
global $payment;

$payments = $payment->getPaymentDetails();
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
        <h5 class="card-title ps-3">Payment Details</h5>
        <div class="card-body">
            <table class="table table-responsive table-bordered table-striped align-middle" id="paymentTable">
                <thead>
                <tr>
                    <th scope="col">SN</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Customer Email</th>
                    <th scope="col">Table Number</th>
                    <th scope="col">Order Code</th>
                    <th scope="col">Grand Total</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Payment Status</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <nav>
                <ul class="pagination justify-content-center" id="paymentTablePagination"></ul>
            </nav>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const payments = <?php echo json_encode($payments); ?>;
        const renderPaymentTable = (data, start) => {
            return data.map((payment, index) => `
                <tr>
                    <th>${start + index + 1}</th>
                    <td>${payment.customer_name}</td>
                    <td>${payment.customer_email}</td>
                    <td>${payment.table_number}</td>
                    <td>${payment.order_code}</td>
                    <td>NPR ${payment.grand_total}</td>
                    <td>${payment.payment_method}</td>
                    <td>${payment.payment_status === "Completed" ? "<span class='badge bg-success'>Completed</span>" :
                payment.payment_status === "Failed" ? "<span class='badge bg-danger'>Failed</span>" :
                    "<span class='badge bg-warning'>Not Paid</span>"}</td>
                </tr>
            `).join('');
        };

        initializePagination(payments, 10, 'paymentTable', 'paymentTablePagination', renderPaymentTable);
    });
</script>

<script src="design/js/pagination.js"></script>