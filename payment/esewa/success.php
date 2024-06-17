
<?php
session_start();
global $customer, $connection, $order;
use model\Checkout;
use model\Customer;
use model\Order;
include "../../database/DatabaseConnection.php";
include "../../model/Customer.php"; 
include "../../model/Checkout.php";

$customer = new Customer($connection);
$customerData = $customer->getCustomerInfo($_SESSION["customer_id"]);


// Get the customer_id
$customer_id = $customerData['customer_id'];



// Create a new Checkout object
$checkout = new Checkout($connection);  // Pass the $connection as an argument

//Get the checkout_id
$checkout_info = $checkout->getCheckoutInfo($customer_id);
$table_id = $checkout_info['table_number'];


// Update the status
$checkout->setPaymentStatus($customer_id);




// Store the redirect URL in a variable
$redirectUrl = "http://localhost/cyberCafe/CyberCafe/?table=" . $table_id;

echo '<div id="customAlert" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: #d4edda; padding: 20px; border-radius: 5px; z-index: 9999; display: none; width: 80%; max-width: 400px;">
    Payment with Esewa Successful.
</div>
<style>
@media (max-width: 600px) {
    #customAlert {
        width: 90%;
    }
}
</style>
<script>
// Show the custom alert
document.getElementById("customAlert").style.display = "block";

// Redirect to the menu page after 2 seconds
setTimeout(function() {
    window.location.href = "' . $redirectUrl . '";
}, 2000);
</script>';
?>




 
