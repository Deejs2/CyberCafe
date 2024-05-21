<?php

namespace model;

class Checkout
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function saveCheckout($orderCode, $paymentMethod): bool
    {
        $customer_id = $_SESSION["customer_id"];
        $table_number = $_SESSION["table"];
        $order_code = $orderCode;
        $payment_method = $paymentMethod;
        $status = "Pending";

        $sql = "INSERT INTO tbl_checkout (customer_id, table_number, order_code, payment_method, payment_status) VALUES ('$customer_id', '$table_number', '$order_code', '$payment_method', '$status')";
        $result = $this->connection->query($sql);

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    //get checkout info from customer_id
    public function getCheckoutInfo($customer_id)
    {
        $sql = "SELECT * FROM tbl_checkout WHERE customer_id = '$customer_id'";
        $result = $this->connection->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //set payment status to completed
    public function setPaymentStatus($customer_id)
    {
        $sql = "UPDATE tbl_checkout SET payment_status = 'Completed' WHERE customer_id = '$customer_id'";
        return $this->connection->query($sql);
    }

    // set payment status to failed
    public function setPaymentFailed($customer_id)
    {
        $sql = "UPDATE tbl_checkout SET payment_status = 'Failed' WHERE customer_id = '$customer_id'";
        return $this->connection->query($sql);
    }

    //set unknown status
    public function setUnknownStatus($customer_id)
    {
        $sql = "UPDATE tbl_checkout SET payment_status = 'Unknown' WHERE customer_id = '$customer_id'";
        return $this->connection->query($sql);
    }

}