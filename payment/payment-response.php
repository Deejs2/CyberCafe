<?php
// Success page

// Decode the Base64-encoded response
$response = json_decode(base64_decode($_REQUEST['response']), true);

// Verify the signature
$secret_key = "8gBm/:&EnhH.1/q("; // Replace with the secret key provided by eSewa
$raw_signature = $response['transaction_code'] . "," . $response['status'] . "," . $response['total_amount'] . "," . $response['transaction_uuid'] . "," . $response['product_code'] . "," . $response['signed_field_names'];
$expected_signature = base64_encode(hash_hmac('sha256', $raw_signature, $secret_key, true));

if ($response['signature'] === $expected_signature) {
    // Signature is valid, process the payment
    if ($response['status'] === 'COMPLETE') {
        // Payment was successful
        echo "Payment successful! Transaction Code: " . $response['transaction_code'];
        // Here, you can update your database or perform any other necessary actions
    } else {
        // Payment failed or was not completed
        echo "Payment failed or was not completed.";
    }
} else {
    // Signature is invalid, payment cannot be trusted
    echo "Invalid signature detected. Payment cannot be trusted.";
}