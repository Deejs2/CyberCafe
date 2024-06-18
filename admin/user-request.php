<?php
global $user;
if($_GET['action'] == 'approve'&& isset($_GET['id'])){
    $id = $_GET['id'];
    $user->approveUser($id);
    $userDetail = $user->getUserById($id);

    $hashed_password = password_hash($userDetail['fullname'].$userDetail['user_id'], PASSWORD_DEFAULT);
    $user->userRequestApproval($id, $hashed_password);
    userRequestMail(
            $userDetail['email'],
            "Request Approved",
            "
            Your request has been approved by the admin. You can now login to the system.
            Login Credentials:
            Email: ".$userDetail['email']."
            Password: ".$userDetail['fullname'].$userDetail['user_id']."
            "
    );
    header("Location: ?page=user&&action=user-request");
    exit();
}

if($_GET['action'] == 'reject'&& isset($_GET['id'])) {
    $id = $_GET['id'];
    $userDetail = $user->getUserById($id);
    $user->rejectUser($id);
    userRequestMail(
        $userDetail['email'],
        "Request Rejected",
        "
            Your request has been rejected by the admin. Please contact the admin for more information.
            contact info:
            Email: cybercafe@gmail.com
            Phone: 1234567890
            "
    );
    header("Location: ?page=user&&action=user-request");
    exit();
}

if($_GET['action'] == 'remove'&& isset($_GET['id'])) {
    $id = $_GET['id'];
    $userDetail = $user->getUserById($id);
    $user->removeUser($id);
    userRequestMail(
        $userDetail['email'],
        "Account Removed",
        "
            You have been removed from the system. Please contact the admin for more information.
            contact info:
            Email: cybercafe@gmail.com
            Phone: 1234567890
            "
    );
    header("Location: ?page=user&&action=user-request");
    exit();
}
?>

<div class="card">
    <h5 class="card-title ps-3">User Request</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-responsive table-bordered table-striped align-middle">

        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">FullName</th>
            <th scope="col">Email</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Request Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
              //here we are calling the getUserByRequestStatus method from the User class
                $users = $user->getAllUsers();
                $i = 1;
                foreach ($users as $user){
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i; ?></th>
                        <td><?php echo $user['fullname']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['address']; ?></td>
                        <td><?php echo $user['phone']; ?></td>
                        <td>
                        <?php if($user["request_status"]=="Approved"){
                            echo "<span class='badge bg-success'>Approved</span>";
                        }elseif($user["request_status"]=="Rejected"){
                            echo "<span class='badge bg-danger'>Rejected</span>";
                        }else{
                            echo "<span class='badge bg-warning'>Pending</span>";
                        } ?>
                        </td>
                        <?php
                            if($user['request_status'] == "Pending"){
                                ?>
                                <td>
                                    <a href="?page=user-request&&action=approve&&id=<?php echo $user['user_id']; ?>" class="btn btn-success">Approve</a>
                                    <a href="?page=user-request&&action=reject&&id=<?php echo $user['user_id']; ?>" class="btn btn-danger">Reject</a>
                                </td>
                                <?php
                            }else{
                                ?>
                                <td>
                                    <a href="?page=user-request&&action=remove&&id=<?php echo $user['user_id']; ?>" class="btn btn-danger">Remove</a>
                                </td>
                                <?php
                            }
                            ?>
                    </tr>
                    <?php
                    $i++;
                }
        ?>


        </tbody>
    </table>
</div>
    </div>
    </div>