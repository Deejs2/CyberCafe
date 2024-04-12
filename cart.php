<?php include "common/breadcrumb.php"?>
<div class="container my-3 border shadow rounded-3 p-3">
    <div class="table-responsive text-center">
        <h2 class="my-3 p-3 bg-primary text-white">Your Cart</h2>
        <table class="table align-middle">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Action</th>
                <th scope="col">Photo</th>
                <th scope="col">Items</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">1</th>
                <td><button class="btn btn-danger" type="button"><i class="fa-solid fa-trash-can"></i></button>
                </td>
                <td><img class="img-fluid" src="" alt="shamosa"></td>
                <td>Shamosa</td>
                <td><input type="text" value="2" name="" class="form-control" id=""></td>
                <td>NRS. 25</td>
                <td>NRS. 50</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td><button class="btn btn-danger" type="button"><i class="fa-solid fa-trash-can"></i></button>
                </td>
                <td><img class="img-fluid" src="" alt="shamosa"></td>
                <td>Shamosa</td>
                <td><input type="text" value="2" name="" class="form-control" id=""></td>
                <td>NRS. 25</td>
                <td>NRS. 50</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td><button class="btn btn-danger" type="button"><i class="fa-solid fa-trash-can"></i></button>
                </td>
                <td><img class="img-fluid" src="" alt="shamosa"></td>
                <td>Shamosa</td>
                <td><input type="text" value="2" name="" class="form-control" id=""></td>
                <td>NRS. 25</td>
                <td>NRS. 50</td>
            </tr>
            <tr>
                <th scope="row">4</th>
                <td><button class="btn btn-danger" type="button"><i class="fa-solid fa-trash-can"></i></button>
                </td>
                <td><img class="img-fluid" src="" alt="shamosa"></td>
                <td>Shamosa</td>
                <td><input type="text" value="2" name="" class="form-control" id=""></td>
                <td>NRS. 25</td>
                <td>NRS. 50</td>
            </tr>
            <tr>
                <th scope="row">5</th>
                <td><button class="btn btn-danger" type="button"><i class="fa-solid fa-trash-can"></i></button>
                </td>
                <td><img class="img-fluid" src="" alt="shamosa"></td>
                <td>Shamosa</td>
                <td><input type="text" value="2" name="" class="form-control" id=""></td>
                <td>NRS. 25</td>
                <td>NRS. 50</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="m-3">
        <hr>

        <div class="row row-cols-1 row-cols-sm-2 text-start">
            <div class="col">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Coupon Code">
                    <button class="input-group-text bg-primary"><span class="text-white">Apply</span></button>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
                    <textarea class="form-control" placeholder="Message here" rows="3"></textarea>
                </div>
            </div>
            <div class="col">
                <ol class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Sub Total</div>
                            Total without discount & promo code
                        </div>
                        <span class="badge text-bg-primary rounded-pill">NRS. 250</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Discount</div>
                            Special Discount
                        </div>
                        <span class="badge text-bg-primary rounded-pill">NRS. 10</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Promo code</div>
                            EXAMPLECODE
                        </div>
                        <span class="badge text-bg-primary rounded-pill">NRS. 50</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">Amount</div>
                        </div>
                        <span>NRS. 190</span>
                    </li>
                </ol>
            </div>
        </div>
        <div class="button-group text-end mt-3">
            <a class="btn bg-primary text-white" href=""><i class="fa-solid fa-pen-to-square"></i> Update Cart</a>
            <a class="btn bg-success text-white" href="?page=checkout">Proceed to Checkout <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</div>

