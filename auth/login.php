
<?php include "../common/breadcrumb.php"?>

<div class="container-fluid d-flex justify-content-center">

    <form id="login" class="mt-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?page=auth" method="post">
        <h2 class="bg-primary mt-2 p-2 text-white text-center">CyberCafe</h2>
        <div class="mt-5">
            <label for="formGroupExampleInput" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" id="formGroupExampleInput">
            <span class="text-danger"><?php if(isset($error)){echo "Please enter a valid email!";} ?></span>
        </div>
        <div class="mt-4">
            <label for="formGroupExampleInput" class="form-label">Password</label>
            <div class="input-group">
                <input type="password" name="password" class="form-control" id="passwordInput">
                <button class="input-group-text eye-icon" type="button" id="togglePassword">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>
            <span class="text-danger"><?php if(isset($error)){echo "Please enter a valid password!";} ?></span>
        </div>
        <div class="d-flex justify-content-between mt-2">
            <p class="text-start"><a class="" href="?page=auth&&action=register">Request for an account?</a></p>
            <p class="text-end"><a class="" href="?page=auth&&action=forgot-password">Forgot password?</a></p>
        </div>
        <button type="submit" name="login" class="btn bg-primary text-white mt-4 w-100 p-3">Login</button>
    </form>

</div>

<div class="mt-5">
    <?php include "../common/footer.php" ?>
</div>

<!-- JavaScript to toggle password visibility -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('passwordInput');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-solid fa-eye-low-vision');
    });
</script>
