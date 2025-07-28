<!-- Sidebar -->
<nav class="sidebar" id="sidebar">
    <!-- Sidebar Header -->
    <div class="sidebar-header">
        <div class="logo">GH</div>
        <div class="brand-text">GearHub</div>
    </div>

    <!-- Sidebar Search -->
    <div class="sidebar-search">
        <div class="sidebar-search-box">
            <i class="bi bi-search sidebar-search-icon"></i>
            <input type="text" class="sidebar-search-input" placeholder="Tìm kiếm menu...">
        </div>
    </div>

    <!-- Sidebar Navigation-->
    <div class="sidebar-nav">
        <!-- Dashboard -->
        <div class="nav-section">
            <div class="nav-section-title">Dashboard</div>
            <div class="nav-item">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link @if (request()->routeIs('admin.dashboard')) active @endif" data-tooltip="Tổng quan">
                    <i class="bi bi-speedometer2"></i>
                    <span>Tổng quan</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="#" class="nav-link" data-tooltip="Phân tích">
                    <i class="bi bi-graph-up"></i>
                    <span>Phân tích</span>
                </a>
            </div>
        </div>

        <!-- E-commerce Section -->
        <div class="nav-section">
            <div class="nav-section-title">Quản lý bán hàng</div>

            <!-- Products -->
            <div class="nav-item">
                <a href="#" class="nav-link has-submenu" data-submenu="products-submenu" data-tooltip="Sản phẩm">
                    <i class="bi bi-box-seam"></i>
                    <span>Sản phẩm</span>
                    <span class="badge bg-primary">1.2k</span>
                    <i class="bi bi-chevron-right dropdown-arrow"></i>
                </a>
                <div class="submenu" id="products-submenu">
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-list-ul"></i>
                            <span>Danh sách sản phẩm</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-plus-circle"></i>
                            <span>Thêm sản phẩm</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-images"></i>
                            <span>Thư viện ảnh</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-star"></i>
                            <span>Sản phẩm nổi bật</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Categories -->
            <div class="nav-item">
                <a href="#" class="nav-link has-submenu" data-submenu="categories-submenu"
                    data-tooltip="Danh mục">
                    <i class="bi bi-tags"></i>
                    <span>Danh mục</span>
                    <i class="bi bi-chevron-right dropdown-arrow"></i>
                </a>
                <div class="submenu" id="categories-submenu">
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-list-ul"></i>
                            <span>Tất cả danh mục</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-plus-circle"></i>
                            <span>Thêm danh mục</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-diagram-3"></i>
                            <span>Cây danh mục</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Orders -->
            <div class="nav-item">
                <a href="#" class="nav-link has-submenu" data-submenu="orders-submenu" data-tooltip="Đơn hàng">
                    <i class="bi bi-receipt"></i>
                    <span>Đơn hàng</span>
                    <span class="badge bg-warning">12</span>
                    <i class="bi bi-chevron-right dropdown-arrow"></i>
                </a>
                <div class="submenu" id="orders-submenu">
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-list-ul"></i>
                            <span>Tất cả đơn hàng</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-clock"></i>
                            <span>Chờ xử lý</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-truck"></i>
                            <span>Đang giao</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-check-circle"></i>
                            <span>Hoàn thành</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-x-circle"></i>
                            <span>Đã hủy</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Customers -->
            <div class="nav-item">
                <a href="#" class="nav-link has-submenu" data-submenu="customers-submenu"
                    data-tooltip="Khách hàng">
                    <i class="bi bi-people"></i>
                    <span>Khách hàng</span>
                    <i class="bi bi-chevron-right dropdown-arrow"></i>
                </a>
                <div class="submenu" id="customers-submenu">
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-list-ul"></i>
                            <span>Tất cả khách hàng</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-person-plus"></i>
                            <span>Khách hàng mới</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-star-fill"></i>
                            <span>Khách VIP</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-envelope"></i>
                            <span>Gửi email</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Promotions - Khuyến mãi -->
            <div class="nav-item">
                <a href="#" class="nav-link has-submenu" data-submenu="promotions-submenu"
                    data-tooltip="Khuyến mãi">
                    <i class="bi bi-percent"></i>
                    <span>Khuyến mãi</span>
                    <i class="bi bi-chevron-right dropdown-arrow"></i>
                </a>
                <div class="submenu" id="promotions-submenu">
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-list-ul"></i>
                            <span>Tất cả khuyến mãi</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-plus-circle"></i>
                            <span>Tạo khuyến mãi</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-ticket"></i>
                            <span>Mã giảm giá</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-calendar-event"></i>
                            <span>Khuyến mãi theo thời gian</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Inventory Section -->
        <div class="nav-section">
            <div class="nav-section-title">Quản lý kho</div>

            <!-- Inventory - Tồn kho -->
            <div class="nav-item">
                <a href="#" class="nav-link has-submenu" data-submenu="inventory-submenu"
                    data-tooltip="Tồn kho">
                    <i class="bi bi-boxes"></i>
                    <span>Tồn kho</span>
                    <i class="bi bi-chevron-right dropdown-arrow"></i>
                </a>
                <div class="submenu" id="inventory-submenu">
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-list-ul"></i>
                            <span>Báo cáo tồn kho</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-exclamation-triangle"></i>
                            <span>Hàng sắp hết</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-arrow-up-right"></i>
                            <span>Xuất kho</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Import - Nhập hàng -->
            <div class="nav-item">
                <a href="#" class="nav-link has-submenu" data-submenu="import-submenu"
                    data-tooltip="Nhập hàng">
                    <i class="bi bi-truck"></i>
                    <span>Nhập hàng</span>
                    <i class="bi bi-chevron-right dropdown-arrow"></i>
                </a>
                <div class="submenu" id="import-submenu">
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-plus-circle"></i>
                            <span>Tạo đơn nhập</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-list-ul"></i>
                            <span>Lịch sử nhập hàng</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-calendar-check"></i>
                            <span>Lịch nhập hàng</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Suppliers - Nhà cung cấp -->
            <div class="nav-item">
                <a href="#" class="nav-link" data-tooltip="Nhà cung cấp">
                    <i class="bi bi-building"></i>
                    <span>Nhà cung cấp</span>
                </a>
            </div>
        </div>

        <!-- Marketing Section -->
        <div class="nav-section">
            <div class="nav-section-title">Marketing</div>

            <!-- Campaigns - Chiến dịch -->
            <div class="nav-item">
                <a href="#" class="nav-link has-submenu" data-submenu="campaigns-submenu"
                    data-tooltip="Chiến dịch">
                    <i class="bi bi-megaphone"></i>
                    <span>Chiến dịch</span>
                    <i class="bi bi-chevron-right dropdown-arrow"></i>
                </a>
                <div class="submenu" id="campaigns-submenu">
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-list-ul"></i>
                            <span>Tất cả chiến dịch</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-plus-circle"></i>
                            <span>Tạo chiến dịch</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-graph-up"></i>
                            <span>Thống kê hiệu suất</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Email Marketing -->
            <div class="nav-item">
                <a href="#" class="nav-link" data-tooltip="Email Marketing">
                    <i class="bi bi-envelope"></i>
                    <span>Email Marketing</span>
                </a>
            </div>

            <!-- Reviews b-->
            <div class="nav-item">
                <a href="#" class="nav-link has-submenu" data-submenu="reviews-submenu"
                    data-tooltip="Đánh giá">
                    <i class="bi bi-star"></i>
                    <span>Đánh giá</span>
                    <i class="bi bi-chevron-right dropdown-arrow"></i>
                </a>
                <div class="submenu" id="reviews-submenu">
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-list-ul"></i>
                            <span>Tất cả đánh giá</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-clock"></i>
                            <span>Chờ duyệt</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-star-fill"></i>
                            <span>Đánh giá 5 sao</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-flag"></i>
                            <span>Báo cáo vi phạm</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Settings Section -->
        <div class="nav-section">
            <div class="nav-section-title">Hệ thống</div>

            <!-- Settings -->
            <div class="nav-item">
                <a href="#" class="nav-link has-submenu" data-submenu="settings-submenu"
                    data-tooltip="Cài đặt">
                    <i class="bi bi-gear"></i>
                    <span>Cài đặt</span>
                    <i class="bi bi-chevron-right dropdown-arrow"></i>
                </a>
                <div class="submenu" id="settings-submenu">
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-shop"></i>
                            <span>Thông tin cửa hàng</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-credit-card"></i>
                            <span>Phương thức thanh toán</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-truck"></i>
                            <span>Vận chuyển</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-globe"></i>
                            <span>SEO & Website</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Security - Bảo mật -->
            <div class="nav-item">
                <a href="#" class="nav-link" data-tooltip="Bảo mật">
                    <i class="bi bi-shield-check"></i>
                    <span>Bảo mật</span>
                </a>
            </div>

            <!-- Reports - Báo cáo -->
            <div class="nav-item">
                <a href="#" class="nav-link has-submenu" data-submenu="reports-submenu"
                    data-tooltip="Báo cáo">
                    <i class="bi bi-file-text"></i>
                    <span>Báo cáo</span>
                    <i class="bi bi-chevron-right dropdown-arrow"></i>
                </a>
                <div class="submenu" id="reports-submenu">
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-graph-up"></i>
                            <span>Báo cáo doanh thu</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-box-seam"></i>
                            <span>Báo cáo sản phẩm</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-people"></i>
                            <span>Báo cáo khách hàng</span>
                        </a>
                    </div>
                    <div class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-download"></i>
                            <span>Xuất báo cáo</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Support - Hỗ trợ -->
            <div class="nav-item">
                <a href="#" class="nav-link" data-tooltip="Hỗ trợ">
                    <i class="bi bi-question-circle"></i>
                    <span>Hỗ trợ</span>
                </a>
            </div>
        </div>
    </div>
</nav>
