<?php

namespace model;

class Billing
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Function to get order details with payment details with customer details
    public function getOrderDetails($customer_id)
    {
        $sql = "
        select c.customer_name, cc.table_number, cc.payment_status, cc.payment_method,o.order_code, o.order_message, o.grand_total, o.order_status from tbl_customers as c
        inner join tbl_checkout as cc on c.customer_id = cc.customer_id
        inner join tbl_orders as o on cc.order_code = o.order_code
        where c.customer_id = ? order by cc.checkout_id desc;";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Function to getProductDetails
//    public function getPaidProductDetails($tableNumber)
//    {
//        $sql = "
//        select fi.food_item_name, fi.food_item_description, fi.food_item_image, ct.cart_status from tbl_carts as ct
//        inner join tbl_food_items as fi on ct.food_item_id = fi.food_item_id
//        where ct.table_number = ? and ct.cart_status = false;";
//        $stmt = $this->conn->prepare($sql);
//        $stmt->bind_param("i", $tableNumber);
//        $stmt->execute();
//        $result = $stmt->get_result();
//        return $result->fetch_all(MYSQLI_ASSOC);
//    }

}