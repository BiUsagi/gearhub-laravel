@extends('admin.layouts.app')

@section('title', 'Theo dõi vận chuyển - GearHub Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/orders/tracking.css') }}">
@endpush

@section('content')
    <div class="container-fluid p-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="fade-in-up">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/orders">Đơn hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Theo dõi vận chuyển</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="page-header fade-in-up">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">
                        <i class="bi bi-truck"></i>
                        Theo dõi vận chuyển
                    </h1>
                    <p class="page-subtitle">Theo dõi trạng thái vận chuyển đơn hàng</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary">
                        <i class="bi bi-download me-1"></i>
                        Xuất báo cáo
                    </button>
                    <button class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i>
                        Tạo vận đơn mới
                    </button>
                </div>
            </div>
        </div>

        {{-- Tracking Statistics --}}
        <div class="stats-cards fade-in-up">
            <div class="stat-card total">
                <div class="stat-icon">
                    <i class="bi bi-truck"></i>
                </div>
                <div class="stat-value">125</div>
                <div class="stat-label">Đang vận chuyển</div>
                <div class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +8 đơn mới
                </div>
            </div>

            <div class="stat-card delivered">
                <div class="stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-value">1,247</div>
                <div class="stat-label">Đã giao hàng</div>
                <div class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +12% so với tháng trước
                </div>
            </div>

            <div class="stat-card processing">
                <div class="stat-icon">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="stat-value">28</div>
                <div class="stat-label">Chờ lấy hàng</div>
                <div class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +3 đơn mới
                </div>
            </div>

            <div class="stat-card cancelled">
                <div class="stat-icon">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div class="stat-value">15</div>
                <div class="stat-label">Không giao được</div>
                <div class="stat-change negative">
                    <i class="bi bi-arrow-down"></i> -2 so với tuần trước
                </div>
            </div>
        </div>

        {{-- Search & Filter Section --}}
        <div class="filters-section fade-in-up">
            <div class="filters-title">
                <i class="bi bi-search me-2"></i>
                Tìm kiếm đơn hàng
            </div>
            <div class="row mt-3">
                <div class="col-md-6">
                    <label class="form-label">Tìm kiếm đơn hàng</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control"
                            placeholder="Nhập mã đơn hàng, mã vận đơn hoặc số điện thoại..." value="GH2025-001"
                            id="searchInput">
                        <button class="btn btn-primary" onclick="searchOrder()">
                            Tìm kiếm
                        </button>
                    </div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" onchange="filterByStatus(this.value)">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending">Chờ xử lý</option>
                        <option value="shipped">Đang vận chuyển</option>
                        <option value="delivered">Đã giao hàng</option>
                        <option value="returned">Trả hàng</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Đơn vị vận chuyển</label>
                    <select class="form-select">
                        <option value="">Tất cả đơn vị</option>
                        <option value="ghn">Giao Hàng Nhanh</option>
                        <option value="jt">J&T Express</option>
                        <option value="vtp">Viettel Post</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Main Tracking Content -->
        <div class="row fade-in-up">
            <!-- Left Column - Tracking Details -->
            <div class="col-lg-8">
                <!-- Order Summary Card -->
                <div class="content-card mb-4">
                    <div class="card-header-gradient">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-1">Đơn hàng #GH2025-001</h5>
                                <p class="mb-0 opacity-75">Đặt hàng ngày 28/07/2025</p>
                            </div>
                            <div>
                                <span class="status-badge shipped">
                                    <i class="bi bi-truck me-1"></i>
                                    Đang vận chuyển
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="carrier-info">
                                    <div class="carrier-logo-wrapper">
                                        <div class="carrier-logo">GHN</div>
                                        <div>
                                            <h6 class="mb-0">Giao Hàng Nhanh</h6>
                                            <small class="text-muted">Mã vận đơn: VD123456789</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="estimated-delivery">
                                    <div class="estimated-date">02/08/2025</div>
                                    <small class="text-muted">Dự kiến giao hàng</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tracking Timeline -->
                <div class="content-card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-clock-history me-2"></i>
                            Lịch trình vận chuyển
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="tracking-timeline">
                            <!-- Timeline Item 1 - Current -->
                            <div class="timeline-item current">
                                <div class="timeline-marker">
                                    <i class="bi bi-truck"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <h6 class="timeline-title">Đang vận chuyển đến bưu cục đích</h6>
                                        <span class="timeline-time">01/08/2025 14:30</span>
                                    </div>
                                    <p class="timeline-description">Hàng đang được vận chuyển từ Hà Nội đến TP.HCM</p>
                                    <div class="timeline-location">
                                        <i class="bi bi-geo-alt me-1"></i>
                                        Trung tâm phân loại Hà Nội
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline Item 2 - Completed -->
                            <div class="timeline-item completed">
                                <div class="timeline-marker">
                                    <i class="bi bi-check2"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <h6 class="timeline-title">Đã nhận hàng tại kho</h6>
                                        <span class="timeline-time">01/08/2025 09:15</span>
                                    </div>
                                    <p class="timeline-description">Hàng đã được nhận và xử lý tại kho Hà Nội</p>
                                    <div class="timeline-location">
                                        <i class="bi bi-geo-alt me-1"></i>
                                        Kho GearHub Hà Nội
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline Item 3 - Completed -->
                            <div class="timeline-item completed">
                                <div class="timeline-marker">
                                    <i class="bi bi-check2"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <h6 class="timeline-title">Đơn hàng đã được xác nhận</h6>
                                        <span class="timeline-time">31/07/2025 16:45</span>
                                    </div>
                                    <p class="timeline-description">Đơn hàng đã được xác nhận và chuẩn bị đóng gói</p>
                                    <div class="timeline-location">
                                        <i class="bi bi-person-check me-1"></i>
                                        Xử lý bởi: Admin GearHub
                                    </div>
                                </div>
                            </div>

                            <!-- Timeline Item 4 - Completed -->
                            <div class="timeline-item completed">
                                <div class="timeline-marker">
                                    <i class="bi bi-check2"></i>
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-header">
                                        <h6 class="timeline-title">Đơn hàng được đặt thành công</h6>
                                        <span class="timeline-time">28/07/2025 20:30</span>
                                    </div>
                                    <p class="timeline-description">Khách hàng đã đặt hàng và thanh toán thành công</p>
                                    <div class="timeline-location">
                                        <i class="bi bi-credit-card me-1"></i>
                                        Thanh toán: VNPay
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delivery Map -->
                <div class="content-card mt-4">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-map me-2"></i>
                            Bản đồ vận chuyển
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="delivery-map">
                            <div class="text-center">
                                <i class="bi bi-map display-1 mb-3"></i>
                                <p class="mb-0">Bản đồ theo dõi vận chuyển</p>
                                <small class="text-muted">Tích hợp Google Maps hoặc API vận chuyển</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Info & Actions -->
            <div class="col-lg-4">
                <!-- Order Information -->
                <div class="content-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-info-circle me-2"></i>
                            Thông tin đơn hàng
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="info-list">
                            <div class="info-item">
                                <span class="info-label">Mã đơn hàng:</span>
                                <span class="info-value">#GH2025-001</span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Khách hàng:</span>
                                <span class="info-value">Nguyễn Văn A</span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Số điện thoại:</span>
                                <span class="info-value">0123.456.789</span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Địa chỉ giao hàng:</span>
                                <span class="info-value">123 Nguyễn Thái Học, Q1, TP.HCM</span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Tổng tiền:</span>
                                <span class="info-value text-primary fw-bold">2.590.000 ₫</span>
                            </div>

                            <div class="info-item">
                                <span class="info-label">Phí vận chuyển:</span>
                                <span class="info-value">30.000 ₫</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="content-card mb-4">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-lightning me-2"></i>
                            Thao tác nhanh
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-outline-primary" onclick="updateStatus()">
                                <i class="bi bi-arrow-clockwise me-2"></i>
                                Cập nhật trạng thái
                            </button>

                            <button class="btn btn-outline-info" onclick="contactCustomer()">
                                <i class="bi bi-telephone me-2"></i>
                                Liên hệ khách hàng
                            </button>

                            <button class="btn btn-outline-warning" onclick="printLabel()">
                                <i class="bi bi-printer me-2"></i>
                                In nhãn vận chuyển
                            </button>

                            <button class="btn btn-outline-success" onclick="confirmDelivery()">
                                <i class="bi bi-check-circle me-2"></i>
                                Xác nhận giao hàng
                            </button>

                            <button class="btn btn-outline-danger" onclick="reportIssue()">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                Báo cáo sự cố
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Recent Tracking Updates -->
                <div class="content-card">
                    <div class="card-header">
                        <h5 class="card-title">
                            <i class="bi bi-bell me-2"></i>
                            Cập nhật gần đây
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="update-list">
                            <div class="update-item">
                                <div class="update-icon">
                                    <i class="bi bi-truck text-warning"></i>
                                </div>
                                <div class="update-content">
                                    <div class="update-time">14:30 - 01/08/2025</div>
                                    <div class="update-message">Hàng đang vận chuyển</div>
                                </div>
                            </div>

                            <div class="update-item">
                                <div class="update-icon">
                                    <i class="bi bi-check-circle text-success"></i>
                                </div>
                                <div class="update-content">
                                    <div class="update-time">09:15 - 01/08/2025</div>
                                    <div class="update-message">Đã nhận tại kho</div>
                                </div>
                            </div>

                            <div class="update-item">
                                <div class="update-icon">
                                    <i class="bi bi-check-circle text-success"></i>
                                </div>
                                <div class="update-content">
                                    <div class="update-time">16:45 - 31/07/2025</div>
                                    <div class="update-message">Đơn hàng được xác nhận</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="content-card mt-4 fade-in-up">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        <i class="bi bi-list-ul me-2"></i>
                        Đơn hàng đang vận chuyển
                    </h5>
                    <div class="btn-group" role="group">
                        <button class="btn btn-sm btn-outline-secondary active">Tất cả</button>
                        <button class="btn btn-sm btn-outline-secondary">Hôm nay</button>
                        <button class="btn btn-sm btn-outline-secondary">Tuần này</button>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover  mb-0">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Khách hàng</th>
                                <th>Đơn vị vận chuyển</th>
                                <th>Trạng thái</th>
                                <th>Ngày giao dự kiến</th>
                                <th>Tổng tiền</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="order-code">
                                        <span class="fw-semibold">#GH2025-001</span>
                                        <br>
                                        <small class="text-muted">VD123456789</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="customer-info">
                                        <span class="fw-semibold">Nguyễn Văn A</span>
                                        <br>
                                        <small class="text-muted">0123.456.789</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="carrier-info-table">
                                        <div class="carrier-logo small">GHN</div>
                                        <small>Giao Hàng Nhanh</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge shipped">Đang vận chuyển</span>
                                </td>
                                <td>
                                    <div class="delivery-date">
                                        <span class="fw-semibold text-success">02/08/2025</span>
                                        <br>
                                        <small class="text-muted">Còn 1 ngày</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold">2.590.000 ₫</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Cập nhật">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="Liên hệ">
                                            <i class="bi bi-telephone"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="order-code">
                                        <span class="fw-semibold">#GH2025-002</span>
                                        <br>
                                        <small class="text-muted">VD123456790</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="customer-info">
                                        <span class="fw-semibold">Trần Thị B</span>
                                        <br>
                                        <small class="text-muted">0987.654.321</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="carrier-info-table">
                                        <div class="carrier-logo small jt">JT</div>
                                        <small>J&T Express</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge delivered">Đã giao hàng</span>
                                </td>
                                <td>
                                    <div class="delivery-date">
                                        <span class="fw-semibold text-muted">31/07/2025</span>
                                        <br>
                                        <small class="text-success">Đã giao</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold">1.250.000 ₫</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Cập nhật">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="Liên hệ">
                                            <i class="bi bi-telephone"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="order-code">
                                        <span class="fw-semibold">#GH2025-003</span>
                                        <br>
                                        <small class="text-muted">VD123456791</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="customer-info">
                                        <span class="fw-semibold">Lê Văn C</span>
                                        <br>
                                        <small class="text-muted">0456.789.123</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="carrier-info-table">
                                        <div class="carrier-logo small vtp">VTP</div>
                                        <small>Viettel Post</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge pending">Chờ xử lý</span>
                                </td>
                                <td>
                                    <div class="delivery-date">
                                        <span class="fw-semibold text-warning">03/08/2025</span>
                                        <br>
                                        <small class="text-muted">Còn 2 ngày</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold">899.000 ₫</span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Cập nhật">
                                            <i class="bi bi-arrow-clockwise"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="Liên hệ">
                                            <i class="bi bi-telephone"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="table-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Hiển thị 1-3 trong tổng số 25 đơn hàng</small>
                        <nav>
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled">
                                    <span class="page-link">Trước</span>
                                </li>
                                <li class="page-item active">
                                    <span class="page-link">1</span>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Sau</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/orders/tracking.js') }}"></script>
@endpush
