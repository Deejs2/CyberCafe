<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  </head>
  <body>
  <?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    include '../database/DatabaseConnection.php';
    $statement = $connection->prepare("SELECT * FROM user WHERE user_id = ?");
    $statement->bind_param("i", $_GET['id']);
    $statement->execute();
    $result = $statement->get_result();
    $user = $result->fetch_assoc();
}
?>

<form action="" method="POST" enctype="multipart/form-data">
    <div class="container justify-content-center">
  <div class="row mb-3 mt-3">
  <input type="hidden" name="userId" value="<?= $user['user_id'] ?? ''; ?>">
    <label for="fullName" class="col-sm-2 col-form-label">Full Name </label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter full name" value="<?= $user['full_name'] ?? ''; ?>" required>
    </div>
  </div>

  <div class="row mb-3">
  <input type="hidden" name="userId" value="<?= $user['user_id'] ?? ''; ?>">
  <label for="email" class="col-sm-2 col-form-label">Email </label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter the email" required value="<?= $user['email'] ?? ''; ?>" autocomplete="off">
    </div>
  </div>

  <div class="row mb-3">
  <input type="hidden" name="userId" value="<?= $user['user_id'] ?? ''; ?>">
  <label for="address" class="col-sm-2 col-form-label">Address </label>
    <div class="col-sm-10">
      <input type="address" class="form-control" id="address" name="address" placeholder="Enter the  address" required value="<?= $user['address'] ?? ''; ?>" autocomplete="off">
    </div>
  </div>

  <div class="row mb-3">
  <input type="hidden" name="userId" value="<?= $user['user_id'] ?? ''; ?>">
  <label for="bio" class="col-sm-2 col-form-label">Bio </label>
    <div class="col-sm-10">
    <textarea class="form-control" id="bio" name="bio" placeholder="Enter the bio" required value="<?= $user['bio'] ?? ''; ?>"></textarea>
    </div>
  </div>
  
<div class="row mb-3">
<input type="hidden" name="userId" value="<?= $user['user_id'] ?? ''; ?>">
  <label for="profilePic" class="col-sm-2 col-form-label">Profile Picture </label>
  <div class="col-sm-10">
  <img id="productImagePreview" src="<?= $user['profile_pic'] ?>" alt="Current Product Image" style="max-width: 100%; height: auto;">
    <input type="file" class="form-control" id="profilePic" name="profilePic" placeholder="Upload profile picture" accept=".png, .jpg, .jpeg, .svg" required>
  </div>
</div>

<div class="row mb-3">
<input type="hidden" name="userId" value="<?= $user['user_id'] ?? ''; ?>">
  <label for="phone" class="col-sm-2 col-form-label">Phone </label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" required value="<?= $user['phone'] ?? ''; ?>" autocomplete="off">
  </div>
</div>

<!-- <div class="row mb-3">
  <label for="password" class="col-sm-2 col-form-label">Password </label>
  <div class="col-sm-10">
    <input type="password" class="form-control" id="password" name="password" placeholder="Enter the password" required autocomplete="new-password">
  </div>
</div> -->

<!-- <div class="row mb-3">
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
</div> -->

<div class="row mb-3">
  <label for="requestStatus" class="col-sm-2 col-form-label"> Request Status</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="requestStatus" name="requestStatus" placeholder="Enter request status" required value="<?= $user['request_status'] ?? ''; ?>">

  </div>
</div>

<!-- <div class="row mb-3">
  <label for="createdAt" class="col-sm-2 col-form-label">Created Date</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" id="createdAt" name="createdAt" placeholder="Date of creation" required>
  </div>
</div> -->

<button type="submit" class="btn btn-primary mt-4">Update</button>

</div>
    </form>

    <script>
document.getElementById('profilePic').addEventListener('change', function(e) {
  var file = e.target.files[0];
  var reader = new FileReader();

  reader.onloadend = function() {
    document.getElementById('productImagePreview').style.display = 'none';
  }

  if (file) {
    reader.readAsDataURL(file);
  } else {
    document.getElementById('productImagePreview').src = "";
  }
});
</script>
</body>
</html>
<?php
include '../database/DatabaseConnection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['userId'] ?? '';
    $fullName = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $bio = $_POST['bio'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $requestStatus = $_POST['requestStatus'] ?? '';

    //store the image in the uploads folder and only save the file name in the database
    $target_dir = "images/";
    $target_file = $target_dir . basename($_FILES["profilePic"]["name"] ?? '');
    move_uploaded_file($_FILES["profilePic"]["tmp_name"] ?? '', $target_file);

    //Update Query for product
    $statement = $connection->prepare("UPDATE user SET full_name = ?, email = ?, address = ?, bio = ?, profile_pic = ?, phone = ?, request_status = ? WHERE user_id = ?");
    $statement->bind_param("sssssssi", $fullName, $email, $address, $bio, $target_file, $phone, $requestStatus, $userId);
    $statement->execute();
  
        //Show a message when the User is updated
       
        echo "<script>
alert('User updated successfully');
window.location.href='userView.php';
</script>";

    $connection->close();
}
    
    ?>