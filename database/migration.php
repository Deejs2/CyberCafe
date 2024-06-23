<?php
global $user;

$users = $user->getAllUsers();
if(count($users) == 0) {
    $user->insertCafe(
        "CyberCafe",
        "Boudha, Kathmandu",
        "9801234567",
        "cybercafe@yopmail.com",
        "cafe123");
    echo "<script>console.log('Cafe Details inserted successfully')</script>";
}