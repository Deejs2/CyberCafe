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
    <table class="table" style="border: 3px solid black;">
    <thead>
        <tr>
            <th scope="col">S.No</th>
            <th scope="col">Full Name</th>
            <th scope="col">Email</th>
            <th scope="col">Address</th>
            <th scope="col">Bio</th>
            <th scope="col">Profile Pic</th>
            <th scope="col">Phone</th>
            <th scope="col">Password</th>
            <th scope="col">Role</th>
            <th scope="col">Status</th>
            <th scope="col">Request Status</th>
            <th scope="col">Created Date</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
       <?php
       include '../database/DatabaseConnection.php';
// Deletion operation
if (isset($_GET['id'])) {
    $statement = $connection->prepare("UPDATE user SET status = false WHERE user_id = ?");
    $statement->bind_param("i", $_GET['id']);
    $statement->execute();
}

       $statement = $connection->prepare("SELECT * FROM user where status=1");
       $statement->execute();
       $result = $statement->get_result();
       while ($row= $result->fetch_assoc()):
       ?>
       <tr>
        <td><?= $row['user_id']; ?></td>
        <td><?= $row['full_name']; ?></td>
        <td><?= $row['email']; ?></td>
        <td><?= $row['address']; ?></td>
        <td><?= $row['bio']; ?></td>
        <td>
        <style>
        @media (max-width: 768px) {
            .product-image {
                width: 100%;
                height: auto;
            }
        }
        @media (min-width: 769px) {
            .product-image {
                width: 200px;
                height: auto;
            }
        }
    </style>
    <img class="profile-pic" src="<?= $row['profile_pic']; ?>" alt="Profile Picture">  
        </td>
        <td><?= $row['phone']; ?></td>
        <td><?= password_hash($row['password'], PASSWORD_DEFAULT); ?></td>
        <td><?= $row['role']; ?></td>
        <td><?= $row['status']; ?></td>
        <td><?= $row['request_status']; ?></td>
        <td><?= $row['created_at']; ?></td>
        <td>
        <a href="userUpdate.php?id=<?= $row['user_id']; ?>"><i class="fas fa-edit fa-md"></i></a>&nbsp;&nbsp
                <a href="#" onclick="confirmDeactivation(<?= $row['user_id']; ?>)"><i class="fas fa-trash fa-md" style="color: red;">
                </i></a>
                </td>
       </tr>
    </tbody>
    <?php
    endwhile;
    $connection->close();
    ?>

    </table>

    <script>
function confirmDeactivation(id) {
    if (confirm('Are you sure you want to Delete this User?')) {
        window.location.href = 'userView.php?id=' + id + '&confirm=true';
    }
}
</script>
</body>
</html>