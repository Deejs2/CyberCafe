
<?php
session_start();
global$orderData; global$checkoutData; global$customerDetails;
global $customer, $connection, $order;

use model\Cart;
use model\Checkout;
use model\Customer;
use model\Order;

include "../../database/DatabaseConnection.php";
include "../../model/Customer.php"; 
include "../../model/Checkout.php";
include "../../model/Cart.php";
include "../../model/Order.php";
include "../../mail-config.php";

$customer = new Customer($connection);
$cart = new Cart($connection);
$checkout = new Checkout($connection);
$order = new Order($connection);

$customerData = $customer->getCustomerInfo($_SESSION["customer_id"]);
$checkoutData = $checkout->getCheckoutInfo($_SESSION["customer_id"]);
$orderData = $order->getOrdersByTable($_SESSION["table"]);


// Get the customer_id
$customer_id = $customerData['customer_id'];



// Create a new Checkout object
$checkout = new Checkout($connection);  // Pass the $connection as an argument

//Get the checkout_id
$checkout_info = $checkout->getCheckoutInfo($customer_id);
$table_id = $checkout_info['table_number'];


// Update the status
$checkout->setPaymentStatus($customer_id);

$cart->emptyCart($_SESSION["table"]);

sendPaymentDetailMail(
    $customerData['customer_email'],
    "Payment Confirmation",
    "
                    Dear ". $customerData['customer_name'] ."
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

header("Location: ../../?page=billing");
exit();