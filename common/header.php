<?php global$cart; ?>
<header class="d-flex flex-wrap justify-content-between py-3 bg-primary">
    <a href="?page=menu"
       class="d-flex align-items-center mb-3 ms-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <img class="brand-logo" src="image/CyberCafe-white.png" alt="CyberCafe">
    </a>

    <ul class="nav nav-pills">
        <li class="nav-item">
            <a href="?page=cart" type="button" class="position-relative nav-link">
                <i class="fa-solid fa-cart-plus text-white"></i><span
                        class="text-white"> Cart</span>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white text-primary">
                <?php echo $cart->countCartItems($_SESSION["table"])["total"];?>
                <span class="visually-hidden">unread messages</span>
                </span>
            </a>
        <li class="nav-item"><a href="auth/auth.php?page=auth" class="nav-link"><i class="fa-solid fa-user text-white"></i> <span
                    class="text-white">Account</span></a></li>
    </ul>
</header>