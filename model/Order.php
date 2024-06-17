<?php

namespace model;

class Order
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Function to add an order
    public function addOrder($tableNumber, $total, $message): bool
{
    // Generate a 6 digit random alphanumeric order code
    $orderCode = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6);

    // Prepare the SQL statement
    $sql = "INSERT INTO tbl_orders (table_number, grand_total, order_message, order_code, order_date, order_status) VALUES (?, ?, ?, ?, now(), 'Pending')";
    $stmt = $this->conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param("idss", $tableNumber, $total, $message, $orderCode);

    // Execute the statement
    if ($stmt->execute()) {
        return true; // Order added successfully
    } else {
        return false; // Order addition failed
    }
}

    // Function to retrieve all orders
    public function getOrders()
    {
        $sql = "SELECT * FROM tbl_orders order by order_id desc";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Function to retrieve a single order
    public function getOrder($orderId)
    {
        $sql = "SELECT * FROM tbl_orders WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Function to delete an order
    public function deleteOrder($orderId): bool
    {
        // Prepare the SQL statement
        $sql = "DELETE FROM tbl_orders WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameter
        $stmt->bind_param("i", $orderId);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }
    }

    //get all orders by table number
    public function getOrdersByTable($tableNumber)
    {
        $sql = "SELECT * FROM tbl_orders WHERE table_number = $tableNumber order by order_id desc limit 1";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();

    }
    //sum all orders of this month
    public function sumOrdersThisMonth()
    {
        $sql = "SELECT SUM(grand_total) as total FROM tbl_orders WHERE MONTH(order_date) = MONTH(CURRENT_DATE())";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
    public function countOrders()
    {
        $sql = "SELECT SUM(grand_total) as total FROM tbl_orders";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

   // Function to update the status of an order
    public function updateOrderStatus($orderId, $status): bool
    {
        // Prepare the SQL statement
        $sql = "UPDATE tbl_orders SET order_status = ? WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("si", $status, $orderId);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }
    }

    // Function to show top 7 orders
    public function getTopOrders()
    {
        $sql = "SELECT * FROM tbl_orders order by order_id desc limit 7";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}