@extends('admin.layouts.app')

@section('title', 'Tổng quan - GearHub Admin Dashboard')

@section('content')
    <!-- Dashboard Content - Nội dung Dashboard -->
    <div class="dashboard-content">
        <!-- Page Title - Tiêu đề trang -->
        <div class="page-title fade-in-up">
            <h1>Dashboard</h1>
            <p class="page-subtitle">Chào mừng trở lại! Đây là tổng quan về hiệu suất cửa hàng của bạn.</p>
        </div>

        <!-- Stats Cards - Thẻ thống kê -->
        <div class="stats-grid fade-in-up">
            <!-- Total Revenue - Tổng doanh thu -->
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-title">Tổng doanh thu</span>
                    <div class="stat-icon primary">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                </div>
                <div class="stat-value" data-count="2846780000">₫0</div>
                <div class="stat-change positive">
                    <i class="bi bi-trending-up"></i>
                    <span>+12.5%</span>
                    <small>so với tháng trước</small>
                </div>
            </div>

            <!-- Total Orders - Tổng đơn hàng -->
            <div class="stat-card success">
                <div class="stat-header">
                    <span class="stat-title">Tổng đơn hàng</span>
                    <div class="stat-icon success">
                        <i class="bi bi-bag-check"></i>
                    </div>
                </div>
                <div class="stat-value" data-count="1843">0</div>
                <div class="stat-change positive">
                    <i class="bi bi-trending-up"></i>
                    <span>+8.2%</span>
                    <small>so với tháng trước</small>
                </div>
            </div>

            <!-- Total Customers - Tổng khách hàng -->
            <div class="stat-card warning">
                <div class="stat-header">
                    <span class="stat-title">Tổng khách hàng</span>
                    <div class="stat-icon warning">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
                <div class="stat-value" data-count="945">0</div>
                <div class="stat-change positive">
                    <i class="bi bi-trending-up"></i>
                    <span>+15.3%</span>
                    <small>so với tháng trước</small>
                </div>
            </div>

            <!-- Conversion Rate - Tỷ lệ chuyển đổi -->
            <div class="stat-card danger">
                <div class="stat-header">
                    <span class="stat-title">Tỷ lệ chuyển đổi</span>
                    <div class="stat-icon danger">
                        <i class="bi bi-graph-up"></i>
                    </div>
                </div>
                <div class="stat-value">3.2%</div>
                <div class="stat-change negative">
                    <i class="bi bi-trending-down"></i>
                    <span>-2.4%</span>
                    <small>so với tháng trước</small>
                </div>
            </div>
        </div>

        <!-- Charts Row - Hàng biểu đồ -->
        <div class="chart-grid fade-in-up">
            <!-- Revenue Chart - Biểu đồ doanh thu -->
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <h3 class="chart-title">Doanh thu theo thời gian</h3>
                        <p class="chart-subtitle">Biểu đồ doanh thu 12 tháng gần nhất</p>
                    </div>
                </div>
                <div class="chart-placeholder">
                    <i class="bi bi-bar-chart" style="font-size: 48px; opacity: 0.3;"></i>
                    <p>Biểu đồ doanh thu sẽ được hiển thị tại đây</p>
                </div>
            </div>

            <!-- Recent Activity - Hoạt động gần đây -->
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <h3 class="chart-title">Hoạt động gần đây</h3>
                        <p class="chart-subtitle">Cập nhật mới nhất từ hệ thống</p>
                    </div>
                </div>
                <ul class="activity-list">
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--gradient-success);">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Đơn hàng mới #12345</h6>
                            <p>Khách hàng Nguyễn Văn A đã đặt đơn hàng MacBook Air M2</p>
                        </div>
                        <div class="activity-time">2 phút trước</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--gradient-primary);">
                            <i class="bi bi-person-plus"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Khách hàng mới</h6>
                            <p>Trần Thị B đã đăng ký tài khoản</p>
                        </div>
                        <div class="activity-time">15 phút trước</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--gradient-warning);">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Cảnh báo tồn kho</h6>
                            <p>iPad Pro 12.9 inch chỉ còn 5 sản phẩm</p>
                        </div>
                        <div class="activity-time">1 giờ trước</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--gradient-danger);">
                            <i class="bi bi-x-circle"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Đơn hàng bị hủy</h6>
                            <p>Đơn hàng #12340 đã được khách hàng hủy</p>
                        </div>
                        <div class="activity-time">2 giờ trước</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--gradient-success);">
                            <i class="bi bi-truck"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Giao hàng thành công</h6>
                            <p>Đơn hàng #12338 đã được giao thành công</p>
                        </div>
                        <div class="activity-time">3 giờ trước</div>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Additional Stats Row - Hàng thống kê bổ sung -->
        <div class="chart-grid fade-in-up">
            <!-- Top Products - Sản phẩm bán chạy -->
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <h3 class="chart-title">Sản phẩm bán chạy</h3>
                        <p class="chart-subtitle">Top 5 sản phẩm được mua nhiều nhất</p>
                    </div>
                </div>
                <ul class="activity-list">
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--gradient-primary);">
                            <i class="bi bi-laptop"></i>
                        </div>
                        <div class="activity-content">
                            <h6>MacBook Air M2 13"</h6>
                            <p>Đã bán: 156 sản phẩm</p>
                        </div>
                        <div class="activity-time">₫32.990.000</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--gradient-success);">
                            <i class="bi bi-phone"></i>
                        </div>
                        <div class="activity-content">
                            <h6>iPhone 15 Pro Max</h6>
                            <p>Đã bán: 134 sản phẩm</p>
                        </div>
                        <div class="activity-time">₫34.990.000</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--gradient-warning);">
                            <i class="bi bi-tablet"></i>
                        </div>
                        <div class="activity-content">
                            <h6>iPad Pro 12.9"</h6>
                            <p>Đã bán: 98 sản phẩm</p>
                        </div>
                        <div class="activity-time">₫28.990.000</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--gradient-danger);">
                            <i class="bi bi-headphones"></i>
                        </div>
                        <div class="activity-content">
                            <h6>AirPods Pro 2</h6>
                            <p>Đã bán: 87 sản phẩm</p>
                        </div>
                        <div class="activity-time">₫6.490.000</div>
                    </li>
                    <li class="activity-item">
                        <div class="activity-icon" style="background: var(--gradient-primary);">
                            <i class="bi bi-smartwatch"></i>
                        </div>
                        <div class="activity-content">
                            <h6>Apple Watch Ultra 2</h6>
                            <p>Đã bán: 65 sản phẩm</p>
                        </div>
                        <div class="activity-time">₫20.990.000</div>
                    </li>
                </ul>
            </div>

            <!-- Quick Stats - Thống kê nhanh -->
            <div class="chart-card">
                <div class="chart-header">
                    <div>
                        <h3 class="chart-title">Thống kê nhanh</h3>
                        <p class="chart-subtitle">Các chỉ số quan trọng hôm nay</p>
                    </div>
                </div>
                <div class="stats-grid" style="margin-bottom: 0;">
                    <div class="stat-card" style="margin-bottom: 16px;">
                        <div class="stat-header">
                            <span class="stat-title">Đơn hàng hôm nay</span>
                            <div class="stat-icon primary" style="width: 32px; height: 32px; font-size: 14px;">
                                <i class="bi bi-cart-check"></i>
                            </div>
                        </div>
                        <div class="stat-value" style="font-size: 24px;" data-count="24">0</div>
                        <div class="stat-change positive">
                            <i class="bi bi-trending-up"></i>
                            <span>+6</span>
                        </div>
                    </div>
                    <div class="stat-card" style="margin-bottom: 16px;">
                        <div class="stat-header">
                            <span class="stat-title">Khách truy cập</span>
                            <div class="stat-icon success" style="width: 32px; height: 32px; font-size: 14px;">
                                <i class="bi bi-eye"></i>
                            </div>
                        </div>
                        <div class="stat-value" style="font-size: 24px;" data-count="1247">0</div>
                        <div class="stat-change positive">
                            <i class="bi bi-trending-up"></i>
                            <span>+89</span>
                        </div>
                    </div>
                    <div class="stat-card" style="margin-bottom: 16px;">
                        <div class="stat-header">
                            <span class="stat-title">Doanh thu hôm nay</span>
                            <div class="stat-icon warning" style="width: 32px; height: 32px; font-size: 14px;">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                        </div>
                        <div class="stat-value" style="font-size: 18px;" data-count="87650000">₫0</div>
                        <div class="stat-change positive">
                            <i class="bi bi-trending-up"></i>
                            <span>+12%</span>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-header">
                            <span class="stat-title">Sản phẩm hết hàng</span>
                            <div class="stat-icon danger" style="width: 32px; height: 32px; font-size: 14px;">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                        </div>
                        <div class="stat-value" style="font-size: 24px;" data-count="3">0</div>
                        <div class="stat-change negative">
                            <i class="bi bi-trending-up"></i>
                            <span>+1</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
