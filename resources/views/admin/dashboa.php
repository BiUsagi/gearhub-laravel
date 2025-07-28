@extends('admin.layouts.app')

@section('title', 'Dashboard - GearHub Admin')

@push('styles')
    <style>
        :root {
            --primary-blue: #0066ff;
            --primary-blue-light: #3d85ff;
            --primary-blue-dark: #0052cc;
            --secondary-blue: #f0f7ff;
            --accent-blue: #e6f2ff;
            --text-primary: #1a1a1a;
            --text-secondary: #6b7280;
            --glass-bg: rgba(255, 255, 255, 0.95);
            --glass-border: rgba(0, 102, 255, 0.1);
        }

        .dashboard-2025 {
            background: linear-gradient(135deg, #f0f7ff 0%, #e6f2ff 100%);
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0, 102, 255, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .glass-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 48px rgba(0, 102, 255, 0.15);
        }

        .metric-card {
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .metric-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-blue), var(--primary-blue-light));
            border-radius: 24px 24px 0 0;
        }

        .metric-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-blue);
            margin: 0;
            line-height: 1.1;
        }

        .metric-label {
            color: var(--text-secondary);
            font-size: 0.875rem;
            font-weight: 500;
            margin-top: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .metric-change {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            margin-top: 1rem;
        }

        .metric-change.positive {
            background: rgba(34, 197, 94, 0.1);
            color: #059669;
        }

        .metric-change.negative {
            background: rgba(239, 68, 68, 0.1);
            color: #dc2626;
        }

        .chart-container {
            height: 400px;
            padding: 1.5rem;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            border-radius: 16px;
            transition: background-color 0.2s ease;
        }

        .activity-item:hover {
            background: var(--accent-blue);
        }

        .activity-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
        }

        .btn-modern {
            padding: 0.75rem 1.5rem;
            border-radius: 16px;
            border: none;
            font-weight: 600;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 102, 255, 0.3);
            color: white;
            text-decoration: none;
        }

        .welcome-section {
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
            color: white;
            padding: 3rem 2rem;
            border-radius: 24px;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .welcome-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(2deg);
            }
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-title::before {
            content: '';
            width: 4px;
            height: 24px;
            background: var(--primary-blue);
            border-radius: 2px;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .action-card {
            padding: 1.5rem;
            text-align: center;
            text-decoration: none;
            color: var(--text-primary);
            transition: all 0.3s ease;
        }

        .action-card:hover {
            color: var(--primary-blue);
            text-decoration: none;
        }

        .action-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 1rem;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
            color: white;
        }

        @media (max-width: 768px) {
            .metric-card {
                padding: 1.5rem;
            }

            .metric-value {
                font-size: 2rem;
            }

            .welcome-section {
                padding: 2rem 1.5rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="dashboard-2025">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="mb-3" style="font-size: 2.5rem; font-weight: 700;">
                        Chào mừng trở lại, Admin! 👋
                    </h1>
                    <p class="mb-0 opacity-90" style="font-size: 1.125rem;">
                        Hôm nay là {{ now()->format('d/m/Y') }}. Hãy cùng xem tổng quan hoạt động kinh doanh của bạn.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <p class="mb-1 opacity-75">Thời gian thực</p>
                    <h3 class="mb-0" id="current-time"></h3>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="section-title">
            <i class="mdi mdi-flash"></i>
            Thao tác nhanh
        </div>
        <div class="quick-actions">
            <a href="#" class="glass-card action-card">
                <div class="action-icon">
                    <i class="mdi mdi-plus"></i>
                </div>
                <h6 class="mb-1">Thêm sản phẩm</h6>
                <small class="text-muted">Tạo sản phẩm mới</small>
            </a>
            <a href="#" class="glass-card action-card">
                <div class="action-icon">
                    <i class="mdi mdi-cart"></i>
                </div>
                <h6 class="mb-1">Đơn hàng</h6>
                <small class="text-muted">Quản lý đơn hàng</small>
            </a>
            <a href="#" class="glass-card action-card">
                <div class="action-icon">
                    <i class="mdi mdi-account-group"></i>
                </div>
                <h6 class="mb-1">Khách hàng</h6>
                <small class="text-muted">Quản lý khách hàng</small>
            </a>
            <a href="#" class="glass-card action-card">
                <div class="action-icon">
                    <i class="mdi mdi-chart-line"></i>
                </div>
                <h6 class="mb-1">Báo cáo</h6>
                <small class="text-muted">Xem thống kê</small>
            </a>
        </div>

        <!-- Metrics Overview -->
        <div class="section-title">
            <i class="mdi mdi-chart-box"></i>
            Tổng quan kinh doanh
        </div>
        <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="glass-card metric-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h2 class="metric-value">1,247</h2>
                            <p class="metric-label">Tổng đơn hàng</p>
                            <span class="metric-change positive">
                                <i class="mdi mdi-arrow-up"></i>
                                +12.5%
                            </span>
                        </div>
                        <div class="text-primary">
                            <i class="mdi mdi-cart-outline" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="glass-card metric-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h2 class="metric-value">847.2M</h2>
                            <p class="metric-label">Doanh thu (VNĐ)</p>
                            <span class="metric-change positive">
                                <i class="mdi mdi-arrow-up"></i>
                                +8.3%
                            </span>
                        </div>
                        <div class="text-success">
                            <i class="mdi mdi-currency-usd" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="glass-card metric-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h2 class="metric-value">2,384</h2>
                            <p class="metric-label">Khách hàng</p>
                            <span class="metric-change positive">
                                <i class="mdi mdi-arrow-up"></i>
                                +15.7%
                            </span>
                        </div>
                        <div class="text-info">
                            <i class="mdi mdi-account-group" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="glass-card metric-card">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h2 class="metric-value">432</h2>
                            <p class="metric-label">Sản phẩm</p>
                            <span class="metric-change negative">
                                <i class="mdi mdi-arrow-down"></i>
                                -2.1%
                            </span>
                        </div>
                        <div class="text-warning">
                            <i class="mdi mdi-package-variant" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Analytics -->
        <div class="row mb-4">
            <div class="col-lg-8 mb-4">
                <div class="glass-card">
                    <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-light">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="mdi mdi-chart-areaspline me-2"></i>
                            Doanh thu 7 ngày qua
                        </h5>
                        <select class="form-select form-select-sm" style="width: auto; border-radius: 12px;">
                            <option>7 ngày</option>
                            <option>30 ngày</option>
                            <option>3 tháng</option>
                        </select>
                    </div>
                    <div class="chart-container">
                        <canvas id="revenueChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="glass-card h-100">
                    <div class="p-4 border-bottom border-light">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="mdi mdi-clock-outline me-2"></i>
                            Hoạt động gần đây
                        </h5>
                    </div>
                    <div class="p-3">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="mdi mdi-cart-plus"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Đơn hàng mới #1234</h6>
                                <small class="text-muted">2 phút trước</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="mdi mdi-account-plus"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Khách hàng đăng ký mới</h6>
                                <small class="text-muted">15 phút trước</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="mdi mdi-star"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Đánh giá 5 sao mới</h6>
                                <small class="text-muted">1 giờ trước</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="mdi mdi-package"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1">Sản phẩm hết hàng</h6>
                                <small class="text-muted">2 giờ trước</small>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 pt-0">
                        <a href="#" class="btn-modern w-100 justify-content-center">
                            <i class="mdi mdi-eye"></i>
                            Xem tất cả
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Products and Recent Orders -->
        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="glass-card">
                    <div class="p-4 border-bottom border-light">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="mdi mdi-trophy me-2"></i>
                            Sản phẩm bán chạy
                        </h5>
                    </div>
                    <div class="p-4">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="border-0">Sản phẩm</th>
                                        <th class="border-0">Đã bán</th>
                                        <th class="border-0">Doanh thu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-primary rounded-circle me-3"
                                                    style="width: 40px; height: 40px;"></div>
                                                <div>
                                                    <h6 class="mb-0">Gaming Laptop X1</h6>
                                                    <small class="text-muted">SKU: GL001</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">245</span></td>
                                        <td class="fw-bold text-primary">147.2M</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-info rounded-circle me-3"
                                                    style="width: 40px; height: 40px;"></div>
                                                <div>
                                                    <h6 class="mb-0">Mechanical Keyboard</h6>
                                                    <small class="text-muted">SKU: KB002</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">189</span></td>
                                        <td class="fw-bold text-primary">95.4M</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-warning rounded-circle me-3"
                                                    style="width: 40px; height: 40px;"></div>
                                                <div>
                                                    <h6 class="mb-0">Gaming Mouse Pro</h6>
                                                    <small class="text-muted">SKU: MS003</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">156</span></td>
                                        <td class="fw-bold text-primary">62.8M</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="glass-card">
                    <div class="p-4 border-bottom border-light">
                        <h5 class="mb-0 fw-bold text-primary">
                            <i class="mdi mdi-clipboard-list me-2"></i>
                            Đơn hàng gần đây
                        </h5>
                    </div>
                    <div class="p-4">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th class="border-0">Mã đơn</th>
                                        <th class="border-0">Khách hàng</th>
                                        <th class="border-0">Trạng thái</th>
                                        <th class="border-0">Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">#1247</td>
                                        <td>Nguyễn Văn A</td>
                                        <td><span class="badge bg-success">Hoàn thành</span></td>
                                        <td class="fw-bold text-primary">2.5M</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">#1246</td>
                                        <td>Trần Thị B</td>
                                        <td><span class="badge bg-warning">Đang xử lý</span></td>
                                        <td class="fw-bold text-primary">1.8M</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">#1245</td>
                                        <td>Lê Văn C</td>
                                        <td><span class="badge bg-info">Đang giao</span></td>
                                        <td class="fw-bold text-primary">3.2M</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Cập nhật thời gian thực
        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('vi-VN', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('current-time').textContent = timeString;
        }

        updateTime();
        setInterval(updateTime, 1000);

        // Biểu đồ doanh thu (cần Chart.js)
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueChart');
            if (ctx && typeof Chart !== 'undefined') {
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
                        datasets: [{
                            label: 'Doanh thu (Triệu VNĐ)',
                            data: [120, 135, 145, 128, 156, 173, 142],
                            borderColor: '#0066ff',
                            backgroundColor: 'rgba(0, 102, 255, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    color: 'rgba(0, 102, 255, 0.1)'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
@endsection
