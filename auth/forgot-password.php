<style>
    .footer{
        position: fixed;
        bottom: 0;
        width: 100%;
    }
    body {
        min-height: 20rem;
        padding-top: 4.5rem;
    }
</style>
<div class="container-fluid mt-5">

    <div class="d-flex justify-content-center">
        <form id="forgot-password" action="" method="post">
            <?php if(isset($error)){echo "<div class='alert alert-danger'>$error</div>";}else{echo '';} ?>
            <h2 class="bg-primary p-2 text-white text-center my-3">Find your account</h2>
            <p>Please enter your email to search for your account. We’ll send a verification code to this email if it matches an existing CyberCafe account.</p>
            <div class="mt-3">
                <input type="text" name="email" class="form-control form-control-lg" id="formGroupExampleInput" placeholder="Enter your email">
                <span class="text-danger"><?= $emailErr ?? ''; ?></span>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-primary mx-2" name="send-otp" type="submit">Send OTP</button>
                <a class="btn btn-outline-danger" href="?page=auth">Cancel</a>
            </div>
        </form>
    </div>

</div>
