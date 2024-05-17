<?php
// Set the required parameters
$amount = 100;
$tax_amount = 10;
$total_amount = $amount + $tax_amount;
$transaction_uuid = 11-201-13; // Generate a unique transaction ID
$product_code = "EPAYTEST";
$product_service_charge = 0;
$product_delivery_charge = 0;
$success_url = "https://esewa.com.np";
$failure_url = "https://google.com";
$signed_field_names = "total_amount,transaction_uuid,product_code";

// Generate the HMAC/SHA256 signature
$secret_key = "8gBm/:&EnhH.1/q"; // Replace with the secret key provided by eSewa
$raw_signature = $total_amount . "," . $transaction_uuid . "," . $product_code;
$signature = base64_encode(hash_hmac('sha256', $raw_signature, $secret_key, true));

// Prepare the form data
$form_data = array(
    "amount" => $amount,
    "tax_amount" => $tax_amount,
    "total_amount" => $total_amount,
    "transaction_uuid" => $transaction_uuid,
    "product_code" => $product_code,
    "product_service_charge" => $product_service_charge,
    "product_delivery_charge" => $product_delivery_charge,
    "success_url" => $success_url,
    "failure_url" => $failure_url,
    "signed_field_names" => $signed_field_names,
    "signature" => $signature
);

// Render the payment form
?>
<form action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">
    <?php foreach ($form_data as $key => $value): ?>
        <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
    <?php endforeach; ?>
    <input type="submit" value="Pay with eSewa">
</form>