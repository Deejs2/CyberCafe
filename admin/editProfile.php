

<?php
session_start();
$email = $_SESSION['email'];
// Database connection
include '../database/DatabaseConnection.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $email['user_id'];

    // Retrieve form data
    $fullName = $_POST['fullName'];
    $about = $_POST['about'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $profilePicTemp = $_FILES['fileInput']['tmp_name'];
    //move the image to the images folder
    move_uploaded_file($profilePicTemp, "picture/$fileInput");
    $fileName = basename($_FILES["profileImage"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileType, $allowTypes)) {
        // Upload file to server
        if (move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFilePath)) {
            // Insert or update data in database
            $updateQuery = "UPDATE tbl_users SET fullname = ?, bio = ?, email = ?, address = ?, phone = ?, profile_pic = ? WHERE id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param('ssssssi', $fullName, $about, $email, $address, $phone, $targetFilePath, $userId); // $userId should be defined based on the logged-in user
            $stmt->execute();
            $stmt->close();

            echo "Profile updated successfully.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
    }
}
?>
