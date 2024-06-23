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
<div class="container-fluid d-flex justify-content-center mt-5">

    <form id="forgot-password" method="post">
        <h2 class="bg-primary p-2 text-white text-center my-3">CyberCafe</h2>
        <p>Please enter a verification code for your account. We sent a verification code to your email, that will be expired in 2 minutes.</p>
        <div class="mt-3">
            <input type="text" name="otp" class="form-control form-control-lg w-50" placeholder="XXXXXX">
            <span class="text-danger"><?= $otpErr ?? '' ?></span>
        </div>
        <div class="mt-3">
            <button class="btn btn-primary mx-2" name="validate-otp" type="submit">Proceed</button>
            <button class="btn btn-danger float-end" name="resend-otp" type="submit">Resend OTP</button>
        </div>
    </form>

</div>
