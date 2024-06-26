<?php

namespace model;

class FoodItem
{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    // Function to create a new item
    public function createItem($itemName, $itemPrice, $itemCategory) {
        // Prepare the SQL statement
        $sql = "INSERT INTO tbl_food_items (food_item_name, food_item_price, food_category_id) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("sdi", $itemName, $itemPrice, $itemCategory);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Item created successfully
        } else {
            return false; // Item creation failed
        }
    }

    // Function to retrieve all items
    public function getAllItems() {
        $sql = "SELECT * FROM tbl_food_items ORDER BY food_item_id DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Function to delete an item by ID
    public function deleteItem($itemId) {
        // Prepare the SQL statement
        $sql = "DELETE FROM tbl_food_items WHERE food_item_id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameter
        $stmt->bind_param("i", $itemId);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }
    }

    // Function to update an item by ID
    public function updateItem($itemId, $itemName, $itemPrice, $itemCategory) {
        // Prepare the SQL statement
        $sql = "UPDATE tbl_food_items SET food_item_name = ?, food_item_price = ?, food_category_id = ? WHERE food_item_id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("sdi", $itemName, $itemPrice, $itemCategory, $itemId);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }
    }

    // Function to retrieve all items by category id
    public function getItemsByCategory($categoryId) {
        $sql = "SELECT * FROM tbl_food_items WHERE food_category_id = $categoryId";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}