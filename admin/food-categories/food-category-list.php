<div class="table-responsive">
    <table class="table shadow-sm p-4 mb-5 align-middle bg-body-tertiary text-center rounded">
        <thead>
        <tr>
            <th scope='col'>#</th>
            <th scope='col'>Food Category Name</th>
            <th scope='col'>Food Category Status</th>
            <th scope='col'>Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
             if($categories){
                 $count = 1;
                 foreach ($categories as $cat) {
                    ?>
        <tr>
            <th scope='row'><?php echo $count;?></th>
            <td><?php echo $cat['food_category_name']; ?></td>
            <td><?php if($cat['food_category_status']==1){echo "Active";}else{echo "Not Active";} ?></td>
            <td>
                <a href='?page=food-categories&action=edit&id=<?php echo $cat['food_category_id']; ?>' class='btn btn-outline-warning'><i class='fa-regular fa-pen-to-square'></i></a>
                <a href='?page=food-categories&action=delete&id=<?php echo $cat['food_category_id']; ?>' class='btn btn-outline-danger'><i class='fa-solid fa-trash-arrow-up'></i></a>
            </td>
        </tr>
        <?php
                     $count++;
                 }
             }else {
                 echo "No categories found.";
             }
        ?>
        </tbody>
    </table>
</div>