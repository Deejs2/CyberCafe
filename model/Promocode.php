<?php

namespace model;

class Promocode
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Function to add a promo code
    public function addPromoCode($promoCode, $discountAmount): bool
    {
        // Prepare the SQL statement
        $sql = "INSERT INTO tbl_promo_codes (promo_code, promo_code_discount, promo_code_status) VALUES (?, ?, true)";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameters
        $stmt->bind_param("si", $promoCode, $discountAmount);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Promo code added successfully
        } else {
            return false; // Promo code addition failed
        }
    }

    // Function to retrieve all promo codes
    public function getPromoCodes()
    {
        $sql = "SELECT * FROM tbl_promo_codes order by promo_code_id desc";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Function to delete a promo code
    public function deletePromoCode($promoId): bool
    {
        // Prepare the SQL statement
        $sql = "DELETE FROM tbl_promo_codes WHERE promo_code_id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameter
        $stmt->bind_param("i", $promoId);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }
    }

    // check if promo code exists

    public function getPromoCode($promoCode)
    {
        $sql = "SELECT * FROM tbl_promo_codes WHERE promo_code = ? AND promo_code_status = true";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $promoCode);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // set promo code active
    public function setPromoCodeActive($promoId): bool
    {
        // Prepare the SQL statement
        $sql = "UPDATE tbl_promo_codes SET promo_code_status = true WHERE promo_code_id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameter
        $stmt->bind_param("i", $promoId);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Promo code activated successfully
        } else {
            return false; // Promo code activation failed
        }
    }

    // set promo code inactive
    public function setPromoCodeInactive($promoId): bool
    {
        // Prepare the SQL statement
        $sql = "UPDATE tbl_promo_codes SET promo_code_status = false WHERE promo_code_id = ?";
        $stmt = $this->conn->prepare($sql);

        // Bind the parameter
        $stmt->bind_param("i", $promoId);

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Promo code deactivated successfully
        } else {
            return false; // Promo code deactivation failed
        }
    }

}