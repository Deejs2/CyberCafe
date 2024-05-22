<?php
session_start();
global $checkout, $connection;

use model\Cart;
use model\Checkout;
use model\Customer;
use model\Order;

include "../../database/DatabaseConnection.php";
include "../../model/Checkout.php";
include "../../mail-config.php";
include "../../model/Customer.php";
include "../../model/Order.php";
include "../../model/Cart.php";

$checkout = new Checkout($connection);
$customerData = new Customer($connection);
$order = new Order($connection);
$cart = new Cart($connection);

$checkoutData = $checkout->getCheckoutInfo($_SESSION["customer_id"]);
$orderData = $order->getOrdersByTable($_SESSION["table"]);
$customerDetails = $customerData->getCustomerInfo($_SESSION["customer_id"]);
// Get the pidx from the callback URL
$pidx = $_GET['pidx'] ?? null;

if ($pidx) {
    // Prepare the lookup request
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/lookup/',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode(['pidx' => $pidx]),
        CURLOPT_HTTPHEADER => array(
            'Authorization: key 925f55a57c284937bcd05cdfbc11f4c5',
            'Content-Type: application/json',
        ),
    ));

    // Send the lookup request
    $response = curl_exec($curl);
    curl_close($curl);

    if ($response) {
        $responseArray = json_decode($response, true);
        // Check the status of the transaction
        switch ($responseArray['status']) {
            case 'Completed':
                // Handle successful transaction
                // Update the order status in your database
                // Send a confirmation email to the customer
                // Redirect to a success page
                $checkout->setPaymentStatus($_SESSION["customer_id"]);
                $cart->emptyCart($_SESSION["table"]);
                sendPaymentDetailMail(
                    $customerDetails['customer_email'],
                    "Payment Confirmation",
                    "
                    Dear ". $customerDetails['customer_name'] ."
                    Your payment was successful. Thank you for choosing us.
                    Order Details:
                    Order Code : " . $checkoutData['order_code'] . "
                    Payment Method : ". $checkoutData['payment_method'] ."
                    Grand Total : ".$orderData['grand_total']."
                    
                    Thank you for choosing us.
                    Regards,
                    CyberCafe Team
                    "
                );
                $_SESSION['transaction_msg'] = '<script>
                        Swal.fire({
                            icon: "success",
                            title: "Transaction successful.",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>';


                header("Location: ../../?page=menu");
                exit();
                // Replace with your actual business logic
                break;
            case 'Expired':
            case 'User canceled':
                // Handle failed transaction
                // Update the order status in your database
                // Send an email to the customer about the failed transaction
                // Redirect to a failure page
                $checkout->setPaymentFailed($_SESSION["customer_id"]);
                sendPaymentDetailMail(
                    $customerDetails['customer_email'],
                    "Payment Failed",
                    "
                        Dear ". $customerDetails['customer_name'] ."
                        Your payment for the order was failed. Please try again.
                        Order Details:
                        Order Code : " . $checkoutData['order_code'] . "
                        Payment Method : ". $checkoutData['payment_method'] ."
                        Grand Total : ".$orderData['grand_total']."
                        
                        Thank you for choosing us.
                        Regards,
                        CyberCafe Team
                        "
                );
                $_SESSION['transaction_msg'] = '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Transaction failed.",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>';
                header("Location: ../../?page=checkout");
                exit();
                // Replace with your actual business logic
                break;
            default:
                // Handle unknown status
                // Log the response for further investigation
                $checkout->setUnknownStatus($_SESSION["customer_id"]);
                $_SESSION['transaction_msg'] = '<script>
                        Swal.fire({
                            icon: "error",
                            title: "Transaction failed.",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function(){
                            window.location.href = "?page=checkout";
                        });
                    </script>';
                // Replace with your actual business logic
                break;
        }
    }
}