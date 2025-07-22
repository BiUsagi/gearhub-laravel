<div class="modern-sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <div class="brand-container">
            <div class="brand-icon">
                <i class="bi bi-gear-fill"></i>
            </div>
            <div class="brand-info">
                <h5 class="brand-name">GearHub</h5>
                <small class="brand-subtitle">Admin Panel</small>
            </div>
        </div>
        <button class="collapse-btn" id="sidebarToggle">
            <i class="bi bi-chevron-left"></i>
        </button>
    </div>

    <!-- Quick Stats -->
    <div class="quick-stats">
        <div class="stat-item">
            <div class="stat-icon bg-primary">
                <i class="bi bi-cart3"></i>
            </div>
            <div class="stat-details">
                <span class="stat-number">24</span>
                <span class="stat-label">Đơn hàng mới</span>
            </div>
        </div>
        <div class="stat-item">
            <div class="stat-icon bg-success">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-details">
                <span class="stat-number">156</span>
                <span class="stat-label">Khách hàng</span>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="sidebar-nav">
        <div class="nav-section">
            <span class="section-title">TỔNG QUAN</span>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link active">
                        <div class="nav-icon">
                            <i class="bi bi-grid-1x2"></i>
                        </div>
                        <span class="nav-text">Dashboard</span>
                        <div class="nav-indicator"></div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <div class="nav-icon">
                            <i class="bi bi-bar-chart"></i>
                        </div>
                        <span class="nav-text">Analytics</span>
                        <span class="nav-badge">Pro</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="nav-section">
            <span class="section-title">QUẢN LÝ</span>
            <ul class="nav-menu">
                <li class="nav-item has-submenu">
                    <a href="#" class="nav-link" data-submenu="products">
                        <div class="nav-icon">
                            <i class="bi bi-box"></i>
                        </div>
                        <span class="nav-text">Sản phẩm</span>
                        <i class="bi bi-chevron-right nav-arrow"></i>
                    </a>
                    <ul class="submenu" data-submenu-target="products">
                        <li><a href="{{ route('admin.products.index') }}">Danh sách</a></li>
                        <li><a href="#">Thêm mới</a></li>
                        <li><a href="#">Danh mục</a></li>
                        <li><a href="#">Thương hiệu</a></li>
                    </ul>
                </li>
                
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <div class="nav-icon">
                            <i class="bi bi-receipt"></i>
                        </div>
                        <span class="nav-text">Đơn hàng</span>
                        <span class="nav-counter">12</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <div class="nav-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <span class="nav-text">Khách hàng</span>
                    </a>
                </li>

                <li class="nav-item has-submenu">
                    <a href="#" class="nav-link" data-submenu="marketing">
                        <div class="nav-icon">
                            <i class="bi bi-megaphone"></i>
                        </div>
                        <span class="nav-text">Marketing</span>
                        <i class="bi bi-chevron-right nav-arrow"></i>
                    </a>
                    <ul class="submenu" data-submenu-target="marketing">
                        <li><a href="#">Mã giảm giá</a></li>
                        <li><a href="#">Flash Sale</a></li>
                        <li><a href="#">Email Marketing</a></li>
                        <li><a href="#">Bannner</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <div class="nav-icon">
                            <i class="bi bi-star"></i>
                        </div>
                        <span class="nav-text">Đánh giá</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="nav-section">
            <span class="section-title">HỆ THỐNG</span>
            <ul class="nav-menu">
                <li class="nav-item has-submenu">
                    <a href="#" class="nav-link" data-submenu="settings">
                        <div class="nav-icon">
                            <i class="bi bi-gear"></i>
                        </div>
                        <span class="nav-text">Cài đặt</span>
                        <i class="bi bi-chevron-right nav-arrow"></i>
                    </a>
                    <ul class="submenu" data-submenu-target="settings">
                        <li><a href="#">Tổng quan</a></li>
                        <li><a href="#">Thanh toán</a></li>
                        <li><a href="#">Vận chuyển</a></li>
                        <li><a href="#">Thông báo</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <div class="nav-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <span class="nav-text">Bảo mật</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar Footer -->
    <div class="sidebar-footer">
        <div class="user-profile">
            <div class="user-avatar">
                <img src="{{ asset('storage/user/default.jpg') }}" alt="Avatar">
                <div class="status-dot"></div>
            </div>
            <div class="user-info">
                <span class="user-name">Sơn</span>
                <span class="user-role">Administrator</span>
            </div>
            <div class="user-actions">
                <button class="action-btn" data-bs-toggle="dropdown">
                    <i class="bi bi-three-dots"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-person me-2"></i>Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="bi bi-gear me-2"></i>Settings
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="#">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </a>
                </div>
            </div>
        </div>
        
        <div class="upgrade-card">
            <div class="upgrade-icon">
                <i class="bi bi-rocket"></i>
            </div>
            <div class="upgrade-content">
                <h6>Upgrade to Pro</h6>
                <p>Unlock advanced features</p>
            </div>
            <button class="upgrade-btn">Upgrade</button>
        </div>
    </div>
</div>

<!-- Sidebar Overlay for Mobile -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>
