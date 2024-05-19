
<div class="container-fluid d-flex justify-content-center">

    <form id="forgot-password" action="" method="post">
        <h2 class="bg-primary p-2 text-white text-center my-3">Find your account</h2>
        <p>Please enter your email to search for your account. We’ll send a verification code to this email if it matches an existing CyberCafe account.</p>
        <div class="mt-3">
            <input type="text" name="email" class="form-control form-control-lg" id="formGroupExampleInput" placeholder="Enter your email">
            <span class="text-danger"><?php if(isset($error)){echo $error;} ?></span>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-primary mx-2" name="send-otp" type="submit">Send OTP</button>
            <a class="btn btn-outline-danger" href="?page=auth">Cancel</a>
        </div>
    </form>

</div>
