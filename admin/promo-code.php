<?php
global $promo;
if(isset($_POST['create_promo_code'])){
    $promoCode = $_POST['promoCode'];
    $discountAmount = $_POST['discountAmount'];

    if(empty($promoCode)){
        header("Location: ?page=promo-code&&msg=promoCodeError");
    }
    if(empty($discountAmount)){
        header("Location: ?page=promo-code&&msg=discountAmountError");
    }

    if($promoCode && $discountAmount){
        if($promo->addPromoCode($promoCode, $discountAmount)){
            echo "<script>Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Promo code created successfully!',
                showConfirmButton: false,
                timer: 1500
            });</script>";
        }
    }
}

// Delete promo code
if(isset($_GET['id'])){
    $promoId = $_GET['id'];
    if($promo->deletePromoCode($promoId)){
        echo "<script>Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Promo code deleted successfully!',
            showConfirmButton: false,
            timer: 1500
        });
        </script>";
    }
}

//set promo code active
if(isset($_GET['setActive'])){
    $promoId = $_GET['setActive'];
    if($promo->setPromoCodeActive($promoId)){
        echo "<script>Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Promo code activated successfully!',
            showConfirmButton: false,
            timer: 1500
        });</script>";
    }
}

//set promo code inactive
if(isset($_GET['setInActive'])){
    $promoId = $_GET['setInActive'];
    if($promo->setPromoCodeInactive($promoId)){
        echo "<script>Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Promo code inactivated successfully!',
            showConfirmButton: false,
            timer: 1500
        });</script>";
    }
}
?>
<form method="post">
    <div class="row g-3">
        <div class="col">
            <label>
                <input type="text" name="promoCode" class="form-control" placeholder="Promo Code">
                <?php if(isset($_GET["msg"]) && $_GET["msg"]=="promoCodeError") {echo "<span class='alert-danger'>Please enter a promo code!</span>";}?>
            </label>
        </div>
        <div class="col">
            <label>
                <input type="text" name="discountAmount" class="form-control" placeholder="Discount Amount">
                <?php if(isset($_GET["msg"]) && $_GET["msg"]=="discountAmountError") {echo "<span class='alert-danger'>Please enter a promo code discount!</span>";}?>
            </label>
        </div>
        <div class="col">
            <button type="submit" name="create_promo_code" class="btn btn-warning text-white">Create</button>
        </div>
    </div>
</form>

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">PromoCode</th>
        <th scope="col">Discount</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 1;
    foreach($promo->getPromoCodes() as $promoCode){
        ?>
        <tr>
            <th scope="row"><?php echo $i++; ?></th>
            <td><?php echo $promoCode['promo_code']; ?></td>
            <td><?php echo $promoCode['promo_code_discount']; ?></td>
            <td><?php if($promoCode['promo_code_status']){echo "Active";}else{echo "InActive";} ?></td>
            <td>
                <?php if($promoCode['promo_code_status']){
                    echo "<a href='?page=promo-code&&setInActive=$promoCode[promo_code_id]' class='btn btn-secondary'>InActive</a>";
                }else{
                    echo "<a href='?page=promo-code&&setActive=$promoCode[promo_code_id]' class='btn btn-success'>Active</a>";
                }
                ?>
                <a href="javascript:void(0);" onclick="function confirmDelete(promoId) {
                            Swal.fire({
                            title: 'Are you sure?',
                            text: 'You will not be able to recover this promo code!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes, delete it!',
                            cancelButtonText: 'No, keep it'
                            }).then((result) => {
                            if (result.isConfirmed) {
                            // User confirmed, redirect to the delete page
                            window.location.href = '?page=promo-code&&id=' + promoId;
                            }
                            });
                        }
                        confirmDelete(<?php echo $promoCode['promo_code_id']?>)" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php
    }

    ?>
    </tbody>
</table>

