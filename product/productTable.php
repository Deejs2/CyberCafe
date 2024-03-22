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
              include '../database/DatabaseConnection.php';
              $statement = $connection->prepare("SELECT product.*, category.category_name FROM product INNER JOIN category ON product.category_id = category.category_id where product_status=1");
              $statement->execute();
              $result = $statement->get_result();
              ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                  <tr>
            <th scope="row"><?= $row['product_id']; ?></th>
            <td><?= $row['product_name']; ?></td>
            <td><?= $row['product_description']; ?></td>

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
    <img class="product-image" src="<?= $row['product_image']; ?>" alt="Product Image">
</td>
           
           
            <td><?= $row['product_status']; ?></td>
            <td><?= $row['product_price']; ?></td>
            <td><?= $row['category_name']; ?></td>
            <td>
                <a href="productUpdate.php?id=<?= $row['product_id']; ?>"><i class="fas fa-edit fa-md"></i></a>&nbsp;&nbsp
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
    
  </body>
  </html>