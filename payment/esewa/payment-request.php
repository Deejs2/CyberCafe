<?php
session_start();
global $customer, $connection, $order;

use model\Customer;
use model\Order;

include "../../database/DatabaseConnection.php";
include "../../model/Customer.php";
include "../../model/Order.php";

$customer = new Customer($connection);
$order = new Order($connection);

$customerData = $customer->getCustomerInfo($_SESSION["customer_id"]);
$orderData = $order->getOrdersByTable($_SESSION["table"]);

$customerName = $customerData["customer_name"];
$customerEmail = $customerData["customer_email"];
$customerPhone = $customerData["customer_phone"];

$orderId = $orderData["order_id"];
$orderCode = $orderData["order_code"];
$orderTotal = $orderData["grand_total"];
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
$amount = $orderTotal;
$tax_amount = 10;


$data = [
    'amount' => $amount,
    'tax_amount' => $tax_amount,
    'total_amount' => $amount + $tax_amount,
    'failure_url' => "http://cybercafe.com/payment/esewa/failure.php",
    'product_delivery_charge' => "0",
    'product_service_charge' => "0",
    'product_code' => "EPAYTEST",
    'signed_field_names' => "total_amount,transaction_uuid,product_code",
];
$data['transaction_uuid'] = bin2hex(random_bytes(16));
$data['success_url'] = "http://cybercafe.com/payment/esewa/success.php";


$message = "total_amount=" . $data['total_amount'] . ",transaction_uuid=" . $data['transaction_uuid'] . ",product_code=" . $data['product_code'];
$secret = "8gBm/:&EnhH.1/q";
$signature = hash_hmac('sha256', $message, $secret, true);
$s = base64_encode($signature);
$data['signature'] = $s;


?>
<form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
    <input type="hidden" name="amount" value="<?php echo $data['amount']; ?>">
    <input type="hidden" name="tax_amount" value="<?php echo $data['tax_amount']; ?>">
    <input type="hidden" name="product_service_charge" value="<?php echo $data['product_service_charge']; ?>">
    <input type="hidden" name="product_delivery_charge" value="<?php echo $data['product_delivery_charge']; ?>">
    <input type="hidden" name="product_code" value="<?php echo $data['product_code']; ?>">
    <input type="hidden" name="total_amount" value="<?php echo $data['total_amount']; ?>">
    <input type="hidden" name="transaction_uuid" value="<?php echo $data['transaction_uuid']; ?>">
    <input type="hidden" name="success_url" value="<?php echo $data['success_url']; ?>">
    <input type="hidden" name="failure_url" value="<?php echo $data['failure_url']; ?>">
    <input type="hidden" name="signed_field_names" value="<?php echo $data['signed_field_names']; ?>">
    <input type="hidden" name="signature" value="<?php echo $data['signature']; ?>">
    <!-- <input type="submit" value="Submit"> -->
</form>
<script>
function submitForm() {
    document.forms[0].submit();
}

window.onload = submitForm;
</script>
