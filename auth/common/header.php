<?php global$cart; ?>
<header class="d-flex flex-wrap justify-content-between py-3">
    <a href="../index.php"
       class="d-flex align-items-center mb-3 ms-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <img class="brand-logo" src="../image/CyberCafe-white.png" alt="CyberCafe">
    </a>

    <ul class="nav nav-pills pe-4">
        <?php
        if(isset($_SESSION["customer_id"])){
            echo '<li class="nav-item"><a href="../?page=billing" class="nav-link"><i class="fa-solid fa-receipt text-white"></i>
        <span class="text-white">Billing Info</span></a></li>';
        }
        ?>
        <a href="../?page=cart" type="button" class="position-relative nav-link">
            <i class="fa-solid fa-cart-plus text-white"></i><span
                    class="text-white"> Cart</span>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white text-primary">
                <?php echo $cart->countCartItems($_SESSION["table"])["total"];?>
                <span class="visually-hidden">unread messages</span>
                </span>
        </a>
    </ul>
</header>