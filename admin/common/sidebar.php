<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link" href="?page=dashboard">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link" href="?page=customer">
                <i class="fa-solid fa-people-group"></i><span>Customer</span>
            </a>
        </li><!-- End Customer Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-brands fa-product-hunt"></i>Product</span><i class="fa-solid fa-caret-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="?page=product&&action=create">
                        <i class="fa-regular fa-square-plus fs-6"></i>Create Products</span>
                    </a>
                </li>
                <li>
                    <a href="?page=product&&action=view">
                        <i class="fa-regular fa-eye fs-6"></i>View All Product</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-file-signature"></i>Order</span><i class="fa-solid fa-caret-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="?page=order&&action=view">
                        <i class="fa-solid fa-bell-concierge fs-6"></i>Recent Orders</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Recent Orders Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
                <i class="fa-solid fa-users"></i><span>User</span><i class="fa-solid fa-caret-down ms-auto"></i>
            </a>
            <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="?page=user&&action=user-request">
                        <i class="fa-solid fa-user-plus fs-6"></i><span>User Request</span>
                    </a>
                </li>
                <li>
                    <a href="?page=user&&action=users">
                        <i class="fa-regular fa-eye fs-6"></i></i><span>Users</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Users Nav -->
    </ul>

</aside><!-- End Sidebar-->
