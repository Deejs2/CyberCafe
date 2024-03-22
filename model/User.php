<?php

namespace model;

class User
{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function authenticateUser($email, $password){
        $sql = "SELECT * FROM tbl_users WHERE email = ? AND password = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            // Authentication failed
            return false;
        }
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM tbl_users";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM tbl_users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

}