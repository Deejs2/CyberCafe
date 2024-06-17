
<div class="table-responsive">
    <table class="table shadow-sm p-3 mb-5 bg-body-tertiary rounded">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">FullName</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">Payment Method</th>
            <th scope="col">Payment Status</th>
        </tr>
        </thead>
        <tbody>
            <?php
            include "../database/DatabaseConnection.php";
            // Select data from the customer table
$sql = "SELECT tbl_customers.*, tbl_checkout.payment_method, tbl_checkout.payment_status 
        FROM tbl_customers 
        INNER JOIN tbl_checkout ON tbl_customers.customer_id = tbl_checkout.customer_id";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["customer_id"] . "</td>";
        echo "<td>" . $row["customer_name"] . "</td>";
        echo "<td>" . $row["customer_email"] . "</td>";
        echo "<td>" . $row["customer_phone"] . "</td>";
        echo "<td>" . $row["customer_address"] . "</td>";
        echo "<td>" . $row["payment_method"] . "</td>";
        echo "<td>" . $row["payment_status"] . "</td>";
        echo "</tr>";
    }
} else {
    echo "0 results";
}
$connection->close();

            ?>

        </tbody>
    </table>
</div>
