<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$data = [
    'amount' => "100",
    'failure_url' => "https://google.com",
    'product_delivery_charge' => "0",
    'product_service_charge' => "0",
    'product_code' => "EPAYTEST",
    'signed_field_names' => "total_amount,transaction_uuid,product_code",
    'success_url' => "https://esewa.com.np",
    'tax_amount' => "10",
    'total_amount' => "110",
    'transaction_uuid' => "ab14a8f2b02c3",
];

$message = $data['total_amount'] . $data['transaction_uuid'] . $data['product_code'];
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
    <input type="submit" value="Submit">
</form>
