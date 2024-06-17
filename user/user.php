<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  </head>
  <body>
    <form action="" method="POST" enctype="multipart/form-data">
    <div class="container justify-content-center">
  <div class="row mb-3 mt-3">
    <label for="fullName" class="col-sm-2 col-form-label">Full Name </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter full name" required>
    </div>
  </div>

  <div class="row mb-3">
  <label for="email" class="col-sm-2 col-form-label">Email </label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter the email" required autocomplete="off">
    </div>
  </div>

  <div class="row mb-3">
  <label for="address" class="col-sm-2 col-form-label">Address </label>
    <div class="col-sm-10">
      <input type="address" class="form-control" id="address" name="address" placeholder="Enter the  address" required autocomplete="off">
    </div>
  </div>

  <div class="row mb-3">
  <label for="bio" class="col-sm-2 col-form-label">Bio </label>
    <div class="col-sm-10">
    <textarea class="form-control" id="bio" name="bio" placeholder="Enter the bio" required></textarea>
    </div>
  </div>
  
<div class="row mb-3">
  <label for="profilePic" class="col-sm-2 col-form-label">Profile Picture </label>
  <div class="col-sm-10">
    <input type="file" class="form-control" id="profilePic" name="profilePic" placeholder="Upload profile picture" accept=".png, .jpg, .jpeg, .svg" required>
  </div>
</div>

<div class="row mb-3">
  <label for="phone" class="col-sm-2 col-form-label">Phone </label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required autocomplete="off">
  </div>
</div>

<div class="row mb-3">
  <label for="password" class="col-sm-2 col-form-label">Password </label>
  <div class="col-sm-10">
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter the password" required autocomplete="new-password">
  </div>
</div>

<div class="row mb-3">
<span class="col-sm-2 col-form-label">Role</span>
  <div class="col-sm-10">
  <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="role" id="role1" value="admin">
      <label class="form-check-label" for="role1">
        Admin
      </label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="role" id="role2" value="superAdmin">
      <label class="form-check-label" for="role2">
        Super Admin
      </label>
    </div>
  </div>
</div>

<!-- <div class="row mb-3">
  <label for="requestStatus" class="col-sm-2 col-form-label"> Request Status</label>
  <div class="col-sm-10">

  </div>
</div> -->

<div class="row mb-3">
  <label for="createdAt" class="col-sm-2 col-form-label">Created Date</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" id="createdAt" name="createdAt" placeholder="Date of creation" required>
  </div>
</div>

<button type="submit" class="btn btn-primary mt-4">Create</button>

</div>
    </form>
</body>
</html>

<?php
if($_SERVER['REQUEST_METHOD'] == "POST"){
include '../database/DatabaseConnection.php';
$fullName = $_POST['fullName'] ?? '';
$email = $_POST['email'] ?? '';
$address = $_POST['address'] ?? '';
$bio = $_POST['bio'] ?? '';

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["profilePic"]["name"] ?? '');
move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file);

$phone = $_POST['phone'] ?? '';
$password = $_POST['password'] ?? '';
$role = $_POST['role'] ?? '';
$createdAt = $_POST['createdAt'] ?? '';


$statement = $connection->prepare("INSERT INTO user (full_name, email, address, bio, profile_pic, phone, password, role, created_at, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)");
$statement->bind_param("sssssssss", $fullName, $email, $address, $bio, $target_file, $phone, $password, $role, $createdAt);
$statement->execute();

echo "<script>
alert('User created successfully');
window.location.href='user.php';
</script>";
$connection->close();

}
?>