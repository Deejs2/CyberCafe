<?php

namespace model;

class Cart
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Function to add an item to the cart
    public function addItemToCart($foodItemId, $quantity, $tableNumber, $foodItemTotal): bool
    {
        // Prepare the SQL statement
        $sql = "INSERT INTO tbl_carts (food_item_id, food_item_quantity, table_number, food_item_total) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("iiii", $foodItemId, $quantity, $tableNumber, $foodItemTotal);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Item added to cart successfully
        } else {
            return false; // Item addition to cart failed
        }
    }

    // Function to retrieve all items in the cart
    public function getCartItems($tableNumber)
    {
        $sql = "SELECT * FROM tbl_carts WHERE table_number = ? order by cart_id desc";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $tableNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Function to delete an item from the cart
    public function deleteCartItem($cartId): bool
    {
        // Prepare the SQL statement
        $sql = "DELETE FROM tbl_carts WHERE cart_id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameter
        $stmt->bind_param("i", $cartId);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }
    }

    // Function to sum the food_item_total using table_number
    public function sumTotal($tableNumber)
    {
        $sql = "SELECT SUM(food_item_total) as total FROM tbl_carts WHERE table_number = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $tableNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}