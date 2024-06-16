<?php include "../common/breadcrumb.php" ?>

<div class="container-fluid d-flex justify-content-center">

    <form id="signup" method="post">
        <p class="text-danger"><?= (isset($error))? $error : ''; ?></p>
        <h2 class="bg-primary p-2 text-white text-center">CyberCafe</h2>
        <div class="row g-3 my-2">
            <div class="col-md-6">
                <label for="firstname" class="form-label">FirstName</label>
                <input type="text" name="firstname" class="form-control" id="firstname">
                <span class="text-danger"><?= (isset($fnameErr))? $fnameErr : ''; ?></span>
            </div>
            <div class="col-md-6">
                <label for="lastname" class="form-label">LastName</label>
                <input type="text" name="lastname" class="form-control" id="lastname">
                <span class="text-danger"><?= (isset($lnameErr))? $lnameErr : ''; ?></span>
            </div>
            <div class="col-md-12">
                <label for="formGroupExampleInput" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="formGroupExampleInput">
                <span class="text-danger"><?= (isset($emailErr))? $emailErr : ''; ?></span>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Address</label>
                <input type="text" name="address" class="form-control" id="address">
                <span class="text-danger"><?= (isset($addressErr))? $addressErr : ''; ?></span>
            </div>
            <div class="col-md-6">
                <label for="confirmPassword" class="form-label">Contact Number</label>
                <input type="text" name="contact-number" class="form-control" id="contact-number">
                <span class="text-danger"><?= (isset($contactErr))? $contactErr : ''; ?></span>
            </div>
        </div>

        <p class="text-end mt-2"><a class="" href="?page=auth&&action=login">Already have an account?</a></p>
        <button type="submit" name="register" class="btn bg-primary text-white mt-4 w-100 p-3">Register</button>
    </form>

</div>

<?php include "../common/footer.php" ?>