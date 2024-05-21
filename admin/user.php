<?php global$user; ?>
<div class="table-responsive">
    <table class="table shadow-sm p-3 mb-5 bg-body-tertiary rounded">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Profile</th>
            <th scope="col">FullName</th>
            <th scope="col">Email</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Request Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $users = $user->getAllApprovedUser();
        $i = 1;
        foreach ($users as $user){
            echo "<tr>
        <td>$i</td>
        <td><img src='../image/$user[profile_pic]' alt=''></td>
        <td>$user[fullname]</td>
        <td>$user[email]</td>
        <td>$user[address]</td>
        <td>$user[phone]</td>
        <td>$user[request_status]</td>
        </tr>";
            $i++;
        }
        ?>

        </tbody>
    </table>
</div>