<?php global$user; ?>
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="" class="logo d-flex align-items-center">
            <img src="../image/CyberCafe-white.png" alt="CyberCafe">
        </a>
        <i class="fa-solid fa-bars toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

<!--            <li class="nav-item dropdown">-->
<!---->
<!--                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">-->
<!--                    <i class="fa-regular fa-bell"></i>-->
<!--                    <span class="badge bg-primary badge-number">4</span>-->
<!--                </a>-->
<!---->
<!--                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">-->
<!--                    <li class="dropdown-header">-->
<!--                        You have 4 new notifications-->
<!--                        <a href="?page=notification"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>-->
<!--                    </li>-->
<!--                    <li>-->
<!--                        <hr class="dropdown-divider">-->
<!--                    </li>-->
<!---->
<!--                    <li class="notification-item">-->
<!--                        <i class="bi bi-exclamation-circle text-warning"></i>-->
<!--                        <div>-->
<!--                            <h4>Lorem Ipsum</h4>-->
<!--                            <p>Quae dolorem earum veritatis oditseno</p>-->
<!--                            <p>30 min. ago</p>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                    <li class="dropdown-footer">-->
<!--                        <a href="?page=notification">Show all notifications</a>-->
<!--                    </li>-->
<!---->
<!--                </ul>-->
<!---->
<!--            </li>-->

            <li class="nav-item dropdown pe-3">

                <?php $users = $user->getUserByEmail($_SESSION['email']); ?>
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="loads/<?= $users["profile_pic"] ?>" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?= $users["fullname"] ?></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?php if(isset($_SESSION["email"])){echo $_SESSION["email"];} ?></h6>
                        <span><?php echo $users['role']; ?></span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="?page=user-profile">
                            <i class="fa-solid fa-user"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="?page=logout">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->
