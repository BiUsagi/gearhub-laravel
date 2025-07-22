@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="dashboard-container">
        <!-- Welcome Section -->
        <div class="welcome-section mb-4">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="welcome-content">
                        <h1 class="welcome-title">
                            {{-- Chào mừng trở lại, {{ auth()->user()->name }}! 👋 --}}
                            Chào mừng trở lại, Sơn!
                        </h1>
                        <p class="welcome-subtitle">
                            Đây là tổng quan về hoạt động kinh doanh của bạn hôm nay
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <div class="welcome-date">
                        <i class="bi bi-calendar-event me-2"></i>
                        {{ now()->format('d/m/Y - H:i') }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Key Metrics -->
        <div class="row g-4 mb-4">
            <div class="col-xl-3 col-md-6">
                <div class="metric-card revenue-card">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="bi bi-currency-dollar"></i>
                        </div>
                        <div class="metric-trend positive">
                            <i class="bi bi-arrow-up"></i>
                            <span>+12.5%</span>
                        </div>
                    </div>
                    <div class="metric-body">
                        <h3 class="metric-value">₫245,850,000</h3>
                        <p class="metric-label">Doanh thu tháng này</p>
                        <div class="metric-chart">
                            <canvas id="revenueChart" width="100" height="40"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="metric-card orders-card">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="bi bi-bag-check"></i>
                        </div>
                        <div class="metric-trend positive">
                            <i class="bi bi-arrow-up"></i>
                            <span>+8.2%</span>
                        </div>
                    </div>
                    <div class="metric-body">
                        <h3 class="metric-value">1,847</h3>
                        <p class="metric-label">Đơn hàng mới</p>
                        <div class="metric-chart">
                            <canvas id="ordersChart" width="100" height="40"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="metric-card customers-card">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="bi bi-people"></i>
                        </div>
                        <div class="metric-trend positive">
                            <i class="bi bi-arrow-up"></i>
                            <span>+15.3%</span>
                        </div>
                    </div>
                    <div class="metric-body">
                        <h3 class="metric-value">3,249</h3>
                        <p class="metric-label">Khách hàng mới</p>
                        <div class="metric-chart">
                            <canvas id="customersChart" width="100" height="40"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="metric-card products-card">
                    <div class="metric-header">
                        <div class="metric-icon">
                            <i class="bi bi-box-seam"></i>
                        </div>
                        <div class="metric-trend negative">
                            <i class="bi bi-arrow-down"></i>
                            <span>-2.1%</span>
                        </div>
                    </div>
                    <div class="metric-body">
                        <h3 class="metric-value">24</h3>
                        <p class="metric-label">Sản phẩm sắp hết hàng</p>
                        <div class="metric-progress">
                            <div class="progress">
                                <div class="progress-bar bg-warning" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="row g-4 mb-4">
            <div class="col-xl-8">
                <div class="chart-card">
                    <div class="chart-header">
                        <h5 class="chart-title">Tổng quan doanh thu</h5>
                        <div class="chart-actions">
                            <div class="btn-group" role="group">
                                <input type="radio" class="btn-check" name="revenueFilter" id="revenue7d" checked>
                                <label class="btn btn-outline-primary btn-sm" for="revenue7d">7 ngày</label>

                                <input type="radio" class="btn-check" name="revenueFilter" id="revenue30d">
                                <label class="btn btn-outline-primary btn-sm" for="revenue30d">30 ngày</label>

                                <input type="radio" class="btn-check" name="revenueFilter" id="revenue90d">
                                <label class="btn btn-outline-primary btn-sm" for="revenue90d">90 ngày</label>
                            </div>
                        </div>
                    </div>
                    <div class="chart-body">
                        <canvas id="mainRevenueChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="chart-card">
                    <div class="chart-header">
                        <h5 class="chart-title">Phân loại đơn hàng</h5>
                    </div>
                    <div class="chart-body">
                        <canvas id="orderStatusChart" width="200" height="200"></canvas>
                        <div class="chart-legend mt-3">
                            <div class="legend-item">
                                <span class="legend-color bg-success"></span>
                                <span>Hoàn thành (68%)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color bg-warning"></span>
                                <span>Đang xử lý (22%)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color bg-info"></span>
                                <span>Đang giao (8%)</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-color bg-danger"></span>
                                <span>Đã hủy (2%)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities and Quick Stats -->
        <div class="row g-4">
            <div class="col-xl-8">
                <div class="activity-card">
                    <div class="card-header">
                        <h5 class="card-title">Đơn hàng gần đây</h5>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary btn-sm">
                            Xem tất cả
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Mã đơn</th>
                                        <th>Khách hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thời gian</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">#12345</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/user/default.jpg') }}" alt=""
                                                    class="rounded-circle me-2" width="32" height="32">
                                                <span>Nguyễn Văn A</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-semibold">₫2,450,000</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Hoàn thành</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">2 phút trước</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">Chi tiết</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">#12344</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/user/default.jpg') }}" alt=""
                                                    class="rounded-circle me-2" width="32" height="32">
                                                <span>Trần Thị B</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-semibold">₫1,250,000</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning">Đang xử lý</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">15 phút trước</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">Chi tiết</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">#12343</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/user/default.jpg') }}" alt=""
                                                    class="rounded-circle me-2" width="32" height="32">
                                                <span>Lê Văn C</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-semibold">₫850,000</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">Đang giao</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">1 giờ trước</span>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary">Chi tiết</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4">
                <div class="stats-card">
                    <div class="card-header">
                        <h5 class="card-title">Thống kê nhanh</h5>
                    </div>
                    <div class="card-body">
                        <!-- Top Products -->
                        <div class="stat-section mb-4">
                            <h6 class="stat-title">Sản phẩm bán chạy</h6>
                            <div class="product-list">
                                <div class="product-item">
                                    <img src="{{ asset('storage/products/product1.jpg') }}" alt=""
                                        class="product-thumb">
                                    <div class="product-info">
                                        <p class="product-name">MacBook Pro M3</p>
                                        <p class="product-sales">245 đã bán</p>
                                    </div>
                                    <div class="product-revenue">
                                        <span class="revenue-amount">₫85M</span>
                                    </div>
                                </div>
                                <div class="product-item">
                                    <img src="{{ asset('storage/products/product2.jpg') }}" alt=""
                                        class="product-thumb">
                                    <div class="product-info">
                                        <p class="product-name">iPhone 15 Pro Max</p>
                                        <p class="product-sales">189 đã bán</p>
                                    </div>
                                    <div class="product-revenue">
                                        <span class="revenue-amount">₫67M</span>
                                    </div>
                                </div>
                                <div class="product-item">
                                    <img src="{{ asset('storage/products/product3.jpg') }}" alt=""
                                        class="product-thumb">
                                    <div class="product-info">
                                        <p class="product-name">AirPods Pro</p>
                                        <p class="product-sales">156 đã bán</p>
                                    </div>
                                    <div class="product-revenue">
                                        <span class="revenue-amount">₫42M</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions -->
                        <div class="stat-section">
                            <h6 class="stat-title">Tác vụ nhanh</h6>
                            <div class="quick-action-grid">
                                <a href="{{ route('admin.products.create') }}" class="quick-action-item">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Thêm sản phẩm</span>
                                </a>
                                <a href="{{ route('admin.orders.index') }}" class="quick-action-item">
                                    <i class="bi bi-receipt"></i>
                                    <span>Xem đơn hàng</span>
                                </a>
                                <a href="{{ route('admin.customers.index') }}" class="quick-action-item">
                                    <i class="bi bi-people"></i>
                                    <span>Quản lý KH</span>
                                </a>
                                <a href="{{ route('admin.analytics') }}" class="quick-action-item">
                                    <i class="bi bi-graph-up"></i>
                                    <span>Báo cáo</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Initialize dashboard charts
        document.addEventListener('DOMContentLoaded', function() {
            initializeDashboardCharts();
        });

        function initializeDashboardCharts() {
            // Revenue chart
            const revenueCtx = document.getElementById('revenueChart');
            if (revenueCtx) {
                new Chart(revenueCtx, {
                    type: 'line',
                    data: {
                        labels: ['', '', '', '', '', '', ''],
                        datasets: [{
                            data: [20, 35, 25, 45, 38, 55, 48],
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            pointRadius: 0,
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
                            x: {
                                display: false
                            },
                            y: {
                                display: false
                            }
                        }
                    }
                });
            }

            // Orders chart
            const ordersCtx = document.getElementById('ordersChart');
            if (ordersCtx) {
                new Chart(ordersCtx, {
                    type: 'bar',
                    data: {
                        labels: ['', '', '', '', '', '', ''],
                        datasets: [{
                            data: [12, 19, 15, 25, 22, 30, 28],
                            backgroundColor: '#3b82f6',
                            borderRadius: 4,
                            borderSkipped: false,
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
                            x: {
                                display: false
                            },
                            y: {
                                display: false
                            }
                        }
                    }
                });
            }

            // Customers chart
            const customersCtx = document.getElementById('customersChart');
            if (customersCtx) {
                new Chart(customersCtx, {
                    type: 'line',
                    data: {
                        labels: ['', '', '', '', '', '', ''],
                        datasets: [{
                            data: [10, 25, 18, 35, 28, 42, 38],
                            borderColor: '#8b5cf6',
                            backgroundColor: 'rgba(139, 92, 246, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            pointRadius: 0,
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
                            x: {
                                display: false
                            },
                            y: {
                                display: false
                            }
                        }
                    }
                });
            }

            // Main revenue chart
            const mainRevenueCtx = document.getElementById('mainRevenueChart');
            if (mainRevenueCtx) {
                new Chart(mainRevenueCtx, {
                    type: 'line',
                    data: {
                        labels: ['T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'CN'],
                        datasets: [{
                                label: 'Doanh thu',
                                data: [65000000, 75000000, 80000000, 85000000, 90000000, 95000000, 88000000],
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                borderWidth: 3,
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#3b82f6',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointRadius: 6
                            },
                            {
                                label: 'Đơn hàng',
                                data: [120, 140, 135, 160, 155, 175, 168],
                                borderColor: '#10b981',
                                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                                borderWidth: 3,
                                fill: true,
                                tension: 0.4,
                                pointBackgroundColor: '#10b981',
                                pointBorderColor: '#fff',
                                pointBorderWidth: 2,
                                pointRadius: 6
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'top',
                                align: 'end'
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: true,
                                    color: 'rgba(0,0,0,0.05)'
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

            // Order status chart
            const orderStatusCtx = document.getElementById('orderStatusChart');
            if (orderStatusCtx) {
                new Chart(orderStatusCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Hoàn thành', 'Đang xử lý', 'Đang giao', 'Đã hủy'],
                        datasets: [{
                            data: [68, 22, 8, 2],
                            backgroundColor: ['#10b981', '#f59e0b', '#3b82f6', '#ef4444'],
                            borderWidth: 0,
                            cutout: '70%'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
        }
    </script>
@endsection
