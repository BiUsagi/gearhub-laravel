<header class="main-header">
    <div class="header-left">
        <button class="mobile-sidebar-toggle d-lg-none" id="mobileSidebarToggle">
            <i class="bi bi-list"></i>
        </button>

        <div class="breadcrumb-wrapper">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @yield('breadcrumbs')
                </ol>
            </nav>
        </div>
    </div>

    <div class="header-right">
        <!-- Search -->
        <div class="search-box">
            <div class="search-input-wrapper">
                <i class="bi bi-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Tìm kiếm...">
                <button class="search-clear" style="display: none;">
                    <i class="bi bi-x"></i>
                </button>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <!-- Notifications -->
            <div class="dropdown">
                <button class="quick-action-btn" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="notification-badge">3</span>
                </button>
                <div class="dropdown-menu notification-dropdown">
                    <div class="dropdown-header">
                        <h6 class="mb-0">Thông báo</h6>
                        <button class="btn-clear-all">Xóa tất cả</button>
                    </div>
                    <div class="notification-list">
                        <div class="notification-item unread">
                            <div class="notification-icon">
                                <i class="bi bi-cart text-success"></i>
                            </div>
                            <div class="notification-content">
                                <p class="notification-title">Đơn hàng mới #12345</p>
                                <p class="notification-time">2 phút trước</p>
                            </div>
                        </div>
                        <div class="notification-item unread">
                            <div class="notification-icon">
                                <i class="bi bi-star text-warning"></i>
                            </div>
                            <div class="notification-content">
                                <p class="notification-title">Đánh giá mới 5 sao</p>
                                <p class="notification-time">5 phút trước</p>
                            </div>
                        </div>
                        <div class="notification-item">
                            <div class="notification-icon">
                                <i class="bi bi-exclamation-triangle text-danger"></i>
                            </div>
                            <div class="notification-content">
                                <p class="notification-title">Sản phẩm hết hàng</p>
                                <p class="notification-time">10 phút trước</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-footer">
                        <a href="{{ route('admin.notifications') }}" class="view-all">Xem tất cả</a>
                    </div>
                </div>
            </div>

            <!-- Messages -->
            <div class="dropdown">
                <button class="quick-action-btn" data-bs-toggle="dropdown">
                    <i class="bi bi-chat-dots"></i>
                    <span class="notification-badge">2</span>
                </button>
                <div class="dropdown-menu message-dropdown">
                    <div class="dropdown-header">
                        <h6 class="mb-0">Tin nhắn</h6>
                    </div>
                    <div class="message-list">
                        <div class="message-item">
                            <img src="{{ asset('storage/user/default.jpg') }}" alt="Avatar" class="message-avatar">
                            <div class="message-content">
                                <p class="message-sender">Nguyễn Văn A</p>
                                <p class="message-text">Khi nào có hàng Macbook Pro M3?</p>
                                <p class="message-time">5 phút trước</p>
                            </div>
                        </div>
                        <div class="message-item">
                            <img src="{{ asset('storage/user/default.jpg') }}" alt="Avatar" class="message-avatar">
                            <div class="message-content">
                                <p class="message-sender">Trần Thị B</p>
                                <p class="message-text">Sản phẩm có bảo hành không?</p>
                                <p class="message-time">10 phút trước</p>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-footer">
                        <a href="{{ route('admin.messages') }}" class="view-all">Xem tất cả</a>
                    </div>
                </div>
            </div>

            <!-- Full Screen -->
            <button class="quick-action-btn" id="fullscreenToggle">
                <i class="bi bi-arrows-fullscreen"></i>
            </button>

            <!-- Theme Toggle -->
            <button class="quick-action-btn" id="themeToggle">
                <i class="bi bi-sun"></i>
            </button>
        </div>

        <!-- User Profile -->
        <div class="dropdown user-dropdown">
            <button class="user-profile-btn" data-bs-toggle="dropdown">
                <img src="{{ asset('storage/user/' . (auth()->user()->avatar ?? 'default.jpg')) }}" alt="Avatar"
                    class="profile-avatar">
                <div class="profile-info d-none d-md-block">
                    {{-- <span class="profile-name">{{ auth()->user()->name }}</span> --}}
                    <span class="profile-name">Sơn</span>
                    <span class="profile-role">Admin</span>
                </div>
                <i class="bi bi-chevron-down profile-arrow"></i>
            </button>
            <div class="dropdown-menu user-menu">
                <div class="user-menu-header">
                    <img src="{{ asset('storage/user/' . (auth()->user()->avatar ?? 'default.jpg')) }}" alt="Avatar">
                    <div>
                        {{-- <h6>{{ auth()->user()->name }}</h6>
                        <p>{{ auth()->user()->email }}</p> --}}
                        <h6>Sơn</h6>
                        <p>sontr.dev@gmail.com</p>
                    </div>
                </div>
                <div class="user-menu-body">
                    <a href="{{ route('admin.profile') }}" class="dropdown-item">
                        <i class="bi bi-person me-2"></i>
                        Hồ sơ của tôi
                    </a>
                    <a href="{{ route('admin.settings.account') }}" class="dropdown-item">
                        <i class="bi bi-gear me-2"></i>
                        Cài đặt tài khoản
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Đăng xuất
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
