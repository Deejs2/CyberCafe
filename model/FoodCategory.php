<?php

namespace model;

class FoodCategory
{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    // Function to create a new category
    public function createCategory($categoryName, $categoryStatus) {
        // Prepare the SQL statement
        $sql = "INSERT INTO tbl_food_category (food_category_name, food_category_status) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("si", $categoryName, $categoryStatus);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Category created successfully
        } else {
            return false; // Category creation failed
        }
    }

    // Function to retrieve all categories
    public function getAllCategories() {
        $sql = "SELECT * FROM tbl_food_category ORDER BY food_category_id DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Function to delete a category by ID
    public function deleteCategory($categoryId) {
        // Prepare the SQL statement
        $sql = "DELETE FROM tbl_food_category WHERE food_category_id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameter
        $stmt->bind_param("i", $categoryId);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }
    }

    // Function to update a category by ID
    public function updateCategory($categoryId, $categoryName, $categoryStatus) {
        // Prepare the SQL statement
        $sql = "UPDATE tbl_food_category SET food_category_name = ?, food_category_status = ? WHERE food_category_id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("sii", $categoryName,$categoryStatus, $categoryId);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Update successful
        } else {
            return false; // Update failed
        }
    }

    // Function to retrieve a category by ID
    public function getCategoryById($categoryId) {
        // Prepare the SQL statement
        $sql = "SELECT * FROM tbl_food_category WHERE food_category_id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameter
        $stmt->bind_param("i", $categoryId);

        // Execute the statement
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the category
        $category = $result->fetch_assoc();

        return $category;
    }

    // Function to retrieve a category by status true
    public function getActiveCategories() {
        // Prepare the SQL statement
        $sql = "SELECT * FROM tbl_food_category WHERE food_category_status = 1";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}