<?php

namespace model;

class Payment
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    //perform a join operation to get the customer details and checkout details
    public function getPaymentDetails()
    {
        $sql = "select
        c.customer_name, c.customer_email, cc.table_number, o.order_code, o.grand_total, cc.payment_method, cc.payment_status
        from tbl_customers as c
        inner join tbl_checkout as cc on c.customer_id = cc.customer_id
        inner join tbl_orders as o on cc.order_code = o.order_code";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    //perform a join operation to get the customer details and checkout details view top 7
    public function getTopPaymentDetails()
    {
        $sql = "select
        c.customer_name, c.customer_email, cc.table_number, cc.payment_date, o.order_code, o.grand_total, cc.payment_method, cc.payment_status
        from tbl_customers as c
        inner join tbl_checkout as cc on c.customer_id = cc.customer_id
        inner join tbl_orders as o on cc.order_code = o.order_code
        order by cc.checkout_id desc limit 7";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}