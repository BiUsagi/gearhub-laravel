<!-- Top Header-->
<header class="top-header">
    <!-- Header Left -->
    <div class="header-left">
        <!-- Sidebar Toggle Button -->
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>

        <!-- Search Box -->
        <div class="search-box">
            <i class="bi bi-search search-icon"></i>
            <input type="text" class="search-input" placeholder="Tìm kiếm sản phẩm, đơn hàng, khách hàng...">
        </div>
    </div>

    <!-- Header Right -->
    <div class="header-right">
        <!-- Theme Toggle Button -->
        <button class="theme-toggle" id="themeToggle">
            <i class="bi bi-sun-fill"></i>
        </button>

        <!-- Notifications Dropdown -->
        <div class="dropdown">
            <button class="notification-btn" id="notificationBtn">
                <i class="bi bi-bell"></i>
                <div class="notification-badge"></div>
            </button>
            <div class="dropdown-menu" id="notificationDropdown">
                <div class="dropdown-header">
                    <span>Thông báo</span>
                    <span class="badge bg-primary ms-auto">5</span>
                </div>
                <a href="#" class="dropdown-item">
                    <div class="dropdown-item-icon" style="background: var(--gradient-success);">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="dropdown-item-content">
                        <h6>Đơn hàng mới</h6>
                        <p>Đơn hàng #12345 đã được đặt</p>
                    </div>
                    <div class="dropdown-item-time">2 phút trước</div>
                </a>
                <a href="#" class="dropdown-item">
                    <div class="dropdown-item-icon" style="background: var(--gradient-warning);">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div class="dropdown-item-content">
                        <h6>Cảnh báo tồn kho</h6>
                        <p>MacBook Air M2 sắp hết hàng</p>
                    </div>
                    <div class="dropdown-item-time">15 phút trước</div>
                </a>
                <div class="dropdown-footer">
                    <a href="#">Xem tất cả thông báo</a>
                </div>
            </div>
        </div>

        <!-- User Profile Dropdown -->
        <div class="dropdown">
            <div class="user-profile" id="userProfileBtn">
                <div class="user-avatar">AD</div>
                <div class="user-info">
                    <h6>Admin User</h6>
                    <small>Super Admin</small>
                </div>
                <i class="bi bi-chevron-down"></i>
            </div>
            <div class="dropdown-menu user-dropdown" id="userDropdown">
                <div class="dropdown-header">
                    <div class="user-avatar-large">AD</div>
                    <div class="user-details">
                        <h6>Admin User</h6>
                        <small>admin@gearhub.com</small>
                    </div>
                </div>
                <a href="#" class="dropdown-item">
                    <i class="bi bi-person"></i>
                    <span>Thông tin cá nhân</span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="bi bi-gear"></i>
                    <span>Cài đặt tài khoản</span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="bi bi-bell"></i>
                    <span>Cài đặt thông báo</span>
                </a>
                <a href="#" class="dropdown-item">
                    <i class="bi bi-question-circle"></i>
                    <span>Trợ giúp & Hỗ trợ</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item theme-toggle-menu" id="themeToggleMenu">
                    <i class="bi bi-moon"></i>
                    <span>Chế độ tối</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item logout-item">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Đăng xuất</span>
                </a>
            </div>
        </div>
    </div>
</header>
