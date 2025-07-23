{{-- Sidebar --}}
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        {{-- Menu Dashboard --}}
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                href="{{ route('admin.dashboard') }}">
                <i class="mdi mdi-grid-large menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        {{-- Phân nhóm E-Commerce --}}
        <li class="nav-item nav-category">E-Commerce</li>

        {{-- Menu Products với submenu --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#products" aria-expanded="false"
                aria-controls="products">
                <i class="menu-icon mdi mdi-package-variant"></i>
                <span class="menu-title">Products</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="products">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">All Products</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Add Product</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Categories</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Brands</a></li>
                </ul>
            </div>
        </li>

        {{-- Menu Orders với submenu --}}
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#orders" aria-expanded="false" aria-controls="orders">
                <i class="menu-icon mdi mdi-cart"></i>
                <span class="menu-title">Orders</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="orders">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">All Orders</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Pending Orders</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Completed Orders</a></li>
                </ul>
            </div>
        </li>

        {{-- Menu Customers --}}
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="menu-icon mdi mdi-account-multiple"></i>
                <span class="menu-title">Customers</span>
            </a>
        </li>

        {{-- Menu Coupons --}}
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="menu-icon mdi mdi-percent"></i>
                <span class="menu-title">Coupons</span>
            </a>
        </li>

        {{-- Phân nhóm Settings --}}
        <li class="nav-item nav-category">Settings</li>

        {{-- Menu General Settings --}}
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="menu-icon mdi mdi-settings"></i>
                <span class="menu-title">General Settings</span>
            </a>
        </li>

        {{-- Menu Reports --}}
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="menu-icon mdi mdi-file-document"></i>
                <span class="menu-title">Reports</span>
            </a>
        </li>
    </ul>
</nav>
