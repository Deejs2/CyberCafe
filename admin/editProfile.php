

<?php
session_start();
$email = $_SESSION['email'];
// Database connection
include '../database/DatabaseConnection.php';
$userId = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $connection->prepare("SELECT user_id FROM tbl_users WHERE email = ?");
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $userId = $user['user_id'];

    // Retrieve form data
    $fullName = $_POST['fullName'];
    $about = $_POST['about'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
// Check if file was uploaded
if (isset($_FILES['fileInput'])) {
    if ($_FILES['fileInput']['error'] > 0) {
        die('An error occurred when uploading.');
    }
    $profileImage = $_FILES['fileInput']['name'];
    $profileImageTemp = $_FILES['fileInput']['tmp_name'];
    $targetPath = "loads/$profileImage";
    if (!move_uploaded_file($profileImageTemp, $targetPath)) {
        die('Failed to move uploaded file.');
    }
} else {
    die('No file uploaded.');
}

    // Update data in database
    $updateQuery = "UPDATE tbl_users SET fullname = ?, bio = ?, email = ?, address = ?, phone = ?, profile_pic = ? WHERE user_id = ?";
    $stmt = $connection->prepare($updateQuery);
    $stmt->bind_param('ssssssi', $fullName, $about, $email, $address, $phone, $profileImage, $userId);
    $stmt->execute();
    $stmt->close();
}
$connection->close();

header('Location: user-profile.php');


  ?>