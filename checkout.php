<?php
if(isset($_POST['submit'])){
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    if(empty($fullName) || empty($email) || empty($phone) || empty($address)){
        header("Location: ?page=checkout&&msg=error");
    }else{
        $msg = "Your order has been placed successfully!";
    }
    header("Location: payment/payment-request.php");
}
?>

<div class="container p-5">
    <div class="row border p-4 shadow rounded-3">
        <div class="col-lg-8">
            <h3 class="fs-4">Billing Info</h3>
            <span>this is small text.</span>

            <form method="post" class="row py-3 g-3">
                <div class="col-md-4">
                    <label for="fullName" class="form-label">FullName <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="fullName">
                    <span class="text-danger"><?php if(isset($_GET['msg'])){echo "Please enter a valid name!";} ?></span>
                </div>
                <div class="col-md-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email">
                    <span class="text-danger"><?php if(isset($_GET['msg'])){echo "Please enter a valid email!";} ?></span>
                </div>
                <div class="col-md-4">
                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="phone">
                    <span class="text-danger"><?php if(isset($_GET['msg'])){echo "Please enter a valid phone!";} ?></span>
                </div>
                <div class="col-12">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Boudha, Kathmandu">
                </div>
                <div class="col w-auto">
                    <h3 class="fs-4">Payment Method :</h3>
                    <div class="d-flex g-2">
                        <div class="border rounded-2 p-3 fs-2 me-2">
                            <i class="fa-solid fa-money-bill-wave"></i>
                            <span class="ms-2">Cash</span>
                        </div>
                        <div class="border rounded-2 p-3 fs-2">
                            <i class="fa-solid fa-money-bill"></i>
                            <span class="ms-2">Esewa</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" name="submit" class="btn bg-primary text-white">Proceed</button>
                </div>
            </form>

        </div>
        <div class="col-lg-4">
           <div class="d-flex m-auto fs-4 justify-content-between bg-body-tertiary p-2">
               <span>Order Summary</span>
               <span>#PY232Z</span>
           </div>
            <div class="table-responsive-sm">
                <table class="table mb-0 text-start">
                    <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="w-25">
                            <img src="image/auth.jpg" class="w-100" alt="...">
                        </td>
                        <td>
                            <div>Samosa</div>
                            <small>NRS. 25 x 2</small>
                        </td>
                        <td>NRS. 50</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="image/auth.jpg" class="w-100" alt="...">
                        </td>
                        <td>
                            <div>Samosa</div>
                            <small>NRS. 25 x 2</small>
                        </td>
                        <td>NRS. 50</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="image/auth.jpg" class="w-100" alt="...">
                        </td>
                        <td>
                            <div>Samosa</div>
                            <small>NRS. 25 x 2</small>
                        </td>
                        <td>NRS. 50</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center ps-2">
                    Sub Total
                    <span class="badge text-bg-primary rounded-pill">NRS. 250</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center ps-2">
                    Discount
                    <span class="badge text-bg-primary rounded-pill">-NRS. 10</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center ps-2">
                    Promo code
                    <span class="badge text-bg-primary rounded-pill">-NRS. 50</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center ps-2 bg-body-tertiary">
                    Amount
                    <span>NRS. 190</span>
                </li>
            </ul>
        </div>
    </div>
</div>