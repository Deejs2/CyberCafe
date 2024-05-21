<?php
class eSewa
{
private $secretKey;

public function __construct($secretKey)
{
$this->secretKey = $secretKey;
}

public function generateSignature($total_amount, $transaction_uuid, $product_code): string
{
$message = "total_amount={$total_amount},transaction_uuid={$transaction_uuid},product_code={$product_code}";
$s = hash_hmac('sha256', $message, $this->secretKey, true);
return base64_encode($s);
}
}
