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
$orderTotal = $orderData["grand_total"]*100;

// Define the payload data dynamically
$payload = array(
    "return_url" => "http://cybercafe.com/payment/khalti/payment_callback.php",
    "website_url" => "http://cybercafe.com",
    "amount" => $orderTotal,
    "purchase_order_id" => $orderId,
    "purchase_order_name" => $orderCode,
    "customer_info" => array(
        "name" => $customerName,
        "email" => $customerEmail,
        "phone" => $customerPhone
    )
);

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($payload), // Convert the payload array to a JSON string
    CURLOPT_HTTPHEADER => array(
        'Authorization: key 925f55a57c284937bcd05cdfbc11f4c5',
        'Content-Type: application/json',
    ),
));

$response = curl_exec($curl);

if (curl_errno($curl)) {
    echo 'Error:' . curl_error($curl);
} else {
    $responseArray = json_decode($response, true);

    if (isset($responseArray['error'])) {
        echo 'Error: ' . $responseArray['error'];
    } elseif (isset($responseArray['payment_url'])) {
        // Redirect the user to the payment page
        header('Location: ' . $responseArray['payment_url']);
    } else {
        echo 'Unexpected response: ' . $response;
    }
}

curl_close($curl);