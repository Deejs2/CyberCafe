<?php global$user; ?>
<div class="card overflow-auto">
    <h5 class="card-title ps-3">User Details</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-responsive table-bordered table-striped align-middle">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Profile</th>
            <th scope="col">FullName</th>
            <th scope="col">Email</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Account Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $users = $user->getAllApprovedUser();
        $i = 1;
        foreach ($users as $user){
            echo "<tr>
        <td>$i</td>
        <td><img src='loads/$user[profile_pic]' alt='' class='img-fluid' width='60px'></td>
        <td>$user[fullname]</td>
        <td>$user[email]</td>
        <td>$user[address]</td>
        <td>$user[phone]</td>
        <td><span class='badge bg-success'>Active</span></td>
        </tr>";
            $i++;
        }
        ?>

        </tbody>
    </table>
</div>
</div>
</div>