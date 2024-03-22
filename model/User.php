<?php

namespace model;

class User
{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    function authenticateUser($email, $password) {
        // Retrieve hashed password from the database based on the provided email
        $sql = "SELECT password FROM tbl_users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();
        $stmt->close();

        // Verify hashed password against the password submitted in the form
        if ($hashed_password && password_verify($password, $hashed_password)) {
            // Passwords match, user is authenticated
            return true;
        } else {
            // Passwords don't match, authentication failed
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