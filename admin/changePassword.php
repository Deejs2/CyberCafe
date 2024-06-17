<?php
session_start();
$email = $_SESSION['email'];
include '../database/DatabaseConnection.php';
if($_SERVER["REQUEST_METHOD"]== "POST"){
    $currentPassword = $_POST['password'];
    $newPassword = $_POST['newpassword'];
    $renewPassword = $_POST['renewpassword'];

       // Check if new password and re-entered password match
       if ($newPassword != $renewPassword) {
        echo "New passwords do not match.";
        exit;
    }
    $email = mysqli_real_escape_string($connection, $_SESSION['email']);
    $sql = "SELECT password FROM tbl_users WHERE email = '$email'";
    $result = $connection->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $password = $row['password'];

        // Verify the current password
        if (password_verify($currentPassword, $password)) {
            // Passwords match, change the password
            $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);

            $sql = "UPDATE tbl_users SET password = '$newPasswordHash' WHERE email = '$email'";

            if ($connection->query($sql) === TRUE) {
                echo "Password changed successfully.";
            } else {
                echo "Error changing password: " . $connection->error;
            }
        } else {
            echo "Current password is incorrect.";
        }
    } else {
        echo "No user found with that username.";
    }

    // $conn->close();
}
?>