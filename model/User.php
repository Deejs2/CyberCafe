<?php

namespace model;

class User
{
    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    function userRequest($firstname, $lastname, $email, $address, $contact_number)
    {
        $fullName = $firstname . " " . $lastname;
        $request_status = "Pending";
        $role = "Staff";

        // Save the user to the database
        $sql = "INSERT INTO tbl_users (fullname, email, address, phone, request_status, role, status, created_at) VALUES (?, ?, ?, ?, ?, ?, true, now())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssss", $fullName, $email, $address, $contact_number, $request_status, $role);
        $stmt->execute();
        $stmt->close();
    }

    function userRequestApproval($user_id, $hashed_password)
    {
        // Update the user's status to approved
        $sql = "UPDATE tbl_users SET request_status = 'Approved', password = ? WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $hashed_password, $user_id);
        $stmt->execute();
        $stmt->close();
    }

    function authenticateUser($email, $password): bool
    {
        // Retrieve hashed password from the database based on the provided email
        $sql = "SELECT password FROM tbl_users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $hashed_password = "";
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
        $sql = "SELECT * FROM tbl_users where status=1 order by user_id desc";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM tbl_users WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM tbl_users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function checkUserExists($email): bool
    {
        $sql = "SELECT * FROM tbl_users WHERE email = ? AND request_status = 'Approved'";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function approveUser($id)
    {
        $sql = "UPDATE tbl_users SET request_status = 'Approved' WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function rejectUser($id)
    {
        $sql = "UPDATE tbl_users SET request_status = 'Rejected' WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function removeUser($id)
    {
        $sql = "UPDATE tbl_users SET status = false, request_status = 'Removed' WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function getAllApprovedUser()
    {
        $sql = "SELECT * FROM tbl_users WHERE request_status = 'Approved' AND role = 'Staff' ORDER BY created_at desc";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function insertCafe($cafe_name, $cafe_address, $cafe_contact, $cafe_email, $cafe_password)
    {
        $hashed_password = password_hash($cafe_password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO tbl_users (
            fullname, 
            email, 
            address, 
            phone, 
            password, 
            role, 
            status,
            request_status,
            created_at
        ) VALUES (?, ?, ?, ?, ?, 'Administrator', true, 'Approved', now())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $cafe_name, $cafe_email, $cafe_address, $cafe_contact, $hashed_password);
        $stmt->execute();
        $stmt->close();
    }

}