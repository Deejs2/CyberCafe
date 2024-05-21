<?php
// Step 1: Setup variables
$amount = 100; // Replace with dynamic amount from your application
$tax_amount = 10; // Replace with dynamic tax amount from your application
$total_amount = $amount + $tax_amount;
$transaction_uuid = "11-201-13"; // Generate a unique transaction ID
$product_code = 'EPAYTEST';
$success_url = 'https://cybercafe.com/project/cybercafe/?page=menu'; // Replace with your success URL
$failure_url = 'https://yourwebsite.com/failure'; // Replace with your failure URL
$signed_field_names = 'total_amount,transaction_uuid,product_code';
$secret_key = '8gBm/:&EnhH.1/q('; // Secret Key provided by eSewa

// Step 2: Create data string to sign
$data_string = "total_amount,transaction_uuid,product_code";

// Step 3: Generate HMAC SHA256 signature
$s = hash_hmac('sha256', 'Message', 'secret', true);
$signature = base64_encode($s);
?>
<!DOCTYPE html>
<html>
<head>
    <title>eSewa Payment</title>
</head>
<body>
<form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
    <input type="hidden" name="amount" value="<?php echo $amount; ?>">
    <input type="hidden" name="tax_amount" value="<?php echo $tax_amount; ?>">
    <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
    <input type="hidden" name="transaction_uuid" value="<?php echo $transaction_uuid; ?>">
    <input type="hidden" name="product_code" value="<?php echo $product_code; ?>">
    <input type="hidden" name="product_service_charge" value="0">
    <input type="hidden" name="product_delivery_charge" value="0">
    <input type="hidden" name="success_url" value="<?php echo $success_url; ?>">
    <input type="hidden" name="failure_url" value="<?php echo $failure_url; ?>">
    <input type="hidden" name="signed_field_names" value="<?php echo $signed_field_names; ?>">
    <input type="hidden" name="signature" value="<?php echo $signature; ?>">
    <input type="submit" value="Pay with eSewa">
</form>

</body>
</html>
