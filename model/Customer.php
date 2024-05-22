<?php

namespace model;

class Customer
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Function to add a customer
    public function addCustomer($customerName, $customerEmail, $customerPhone, $customerAddress): bool
    {
        // Prepare the SQL statement
        $sql = "INSERT INTO tbl_customers (customer_name, customer_email, customer_phone, customer_address) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("ssss", $customerName, $customerEmail, $customerPhone, $customerAddress);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Customer added successfully
        } else {
            return false; // Customer addition failed
        }
    }

    // Function to retrieve all customers
    public function getCustomers()
    {
        $sql = "SELECT * FROM tbl_customers order by customer_id desc";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Function to delete a customer
    public function deleteCustomer($customerId): bool
    {
        // Prepare the SQL statement
        $sql = "DELETE FROM tbl_customers WHERE customer_id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameter
        $stmt->bind_param("i", $customerId);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }
    }

    // Function to update a customer
    public function updateCustomer($customerId, $customerName, $customerEmail, $customerPhone, $customerAddress): bool
    {
        // Prepare the SQL statement
        $sql = "UPDATE tbl_customers SET customer_name = ?, customer_email = ?, customer_phone = ?, customer_address = ? WHERE customer_id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("ssssi", $customerName, $customerEmail, $customerPhone, $customerAddress, $customerId);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Update successful
        } else{
            return false; // Update failed
        }
    }

    // Function to count the number of customers
    public function countCustomers()
    {
        $sql = "SELECT COUNT(customer_id) as total FROM tbl_customers";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    //get customer info from customer_id
    public function getCustomerInfo($customer_id)
    {
        $sql = "SELECT * FROM tbl_customers WHERE customer_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    //get latest inserted customer
    public function getLatestCustomer()
    {
        $sql = "SELECT * FROM tbl_customers order by customer_id desc limit 1";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

}