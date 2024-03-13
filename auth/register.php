<?php include "../common/breadcrumb.php" ?>

<div class="container-fluid d-flex justify-content-center">

    <form id="signup" action="" method="post">
        <h2 class="bg-primary p-2 text-white text-center">CyberCafe</h2>
        <div class="row g-3 my-2">
            <div class="col-md-6">
                <label for="firstname" class="form-label">FirstName</label>
                <input type="text" class="form-control" id="firstname">
                <span class="text-danger">Please enter a valid password!</span>
            </div>
            <div class="col-md-6">
                <label for="lastname" class="form-label">LastName</label>
                <input type="text" class="form-control" id="lastname">
                <span class="text-danger">Please enter a valid password!</span>
            </div>
            <div class="col-md-12">
                <label for="formGroupExampleInput" class="form-label">Email</label>
                <input type="text" class="form-control" id="formGroupExampleInput">
                <span class="text-danger">Please enter a valid email!</span>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="text" class="form-control" id="password">
                <span class="text-danger">Please enter a valid password!</span>
            </div>
            <div class="col-md-6">
                <label for="confirmPassword" class="form-label">Confirm Password</label>
                <input type="text" class="form-control" id="confirmPassword">
                <span class="text-danger">Please enter a valid password!</span>
            </div>
        </div>


        <p class="text-end mt-2"><a class="" href="?page=auth&&action=login">Already have an account?</a></p>
        <button type="submit" class="btn btn-outline-primary mt-4 w-100 p-3">Sign Up</button>
    </form>

</div>

<?php include "../common/footer.php" ?>