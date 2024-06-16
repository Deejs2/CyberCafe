<?php

namespace model;

class Otp
{
    private $connection;
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    // save otp to database
    public function saveOtp($email, $otp)
    {
        $sql = "INSERT INTO tbl_otp (email, otp_code, created_at) VALUES ('$email', '$otp', now())";
        return $this->connection->query($sql);
    }

    //validate otp code also check if it is expired or not
    public function validateOtp($email, $otp)
    {
        $sql = "SELECT * FROM tbl_otp WHERE email = '$email' AND otp_code = '$otp' AND created_at >= now() - INTERVAL 2 MINUTE order by otp_id desc limit 1";
        $result = $this->connection->query($sql);
        return $result->fetch_assoc();
    }

}