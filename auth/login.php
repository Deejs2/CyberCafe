
<?php include "../common/breadcrumb.php"?>

<div class="container-fluid d-flex justify-content-center">

    <form id="login" action="" method="post">
        <h2 class="bg-primary p-2 text-white text-center">CyberCafe</h2>
        <div class="mt-5">
            <label for="formGroupExampleInput" class="form-label">Email</label>
            <input type="text" class="form-control" id="formGroupExampleInput">
            <span class="text-danger">Please enter a valid email!</span>
        </div>
        <div class="mt-4">
            <label for="formGroupExampleInput2" class="form-label">Password</label>
            <input type="text" class="form-control" id="formGroupExampleInput2">
            <span class="text-danger">Please enter a valid password!</span>
        </div>
        <div class="d-flex justify-content-between mt-2">
            <p class="text-start"><a class="" href="?page=auth&&action=register">Request for an account?</a></p>
            <p class="text-end"><a class="" href="?page=auth&&action=forgot-password">Forgot password?</a></p>
        </div>
        <button type="submit" name="login" class="btn btn-outline-primary mt-4 w-100 p-3">Login</button>
    </form>

</div>

<?php include "../common/footer.php" ?>
