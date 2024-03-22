
  <div class="container mt-3">
    <div class="table-responsive">
        <table class="table" style="border: 3px solid black;">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              <?php
              $foodItems = $foodItem->getAllFoodItems();
              ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                  <tr>
            <th scope="row"><?= $row['product_id']; ?></th>
            <td><?= $row['product_name']; ?></td>
            <td><?= $row['product_description']; ?></td>

            <td><img class="product-image" src="<?= $row['product_image']; ?>" alt="Product Image"></td>
           
           
            <td><?= $row['product_status']; ?></td>
            <td><?= $row['product_price']; ?></td>
            <td><?= $row['category_name']; ?></td>
            <td>
                <a href="product-edit.php?id=<?= $row['product_id']; ?>"><i class="fas fa-edit fa-md"></i></a>&nbsp;&nbsp
                <a href="#" onclick="confirmDeactivation(<?= $row['product_id']; ?>)"><i class="fas fa-trash fa-md" style="color: red;">
                <?php
if (isset($_GET['id'])) {
   
    $statement = $connection->prepare("UPDATE product SET product_status = false WHERE product_id = ?");
    $statement->bind_param("i", $_GET['id']);
    $statement->execute();
}
?>
                </i></a>
            </td>
        </tr>
        <?php endwhile;
    $connection->close(); ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmDeactivation(id) {
    if (confirm('Are you sure you want to deactivate this product?')) {
        window.location.href = 'productTable.php?id=' + id + '&confirm=true';
    }
}
</script>
