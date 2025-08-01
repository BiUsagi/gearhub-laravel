@extends('admin.layouts.app')

@section('title', 'Quản lý đơn hàng')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/orders/index.css') }}">
@endpush

@section('content')
    <div class="container-fluid p-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="fade-in-up">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="page-header fade-in-up">
            <h1 class="page-title">
                <i class="bi bi-receipt me-3"></i>
                Quản lý đơn hàng
            </h1>
            <p class="page-subtitle">Theo dõi và xử lý tất cả các đơn hàng từ khách hàng</p>
        </div>

        {{-- Statistics Cards --}}
        <div class="stats-cards fade-in-up">
            <div class="stat-card total">
                <div class="stat-icon">
                    <i class="bi bi-receipt"></i>
                </div>
                <div class="stat-value" id="totalOrders">1,247</div>
                <div class="stat-label">Tổng đơn hàng</div>
                <div class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +12% so với tháng trước
                </div>
            </div>

            <div class="stat-card pending">
                <div class="stat-icon">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="stat-value" id="pendingOrders">28</div>
                <div class="stat-label">Chờ xử lý</div>
                <div class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +3 đơn mới
                </div>
            </div>

            <div class="stat-card processing">
                <div class="stat-icon">
                    <i class="bi bi-gear"></i>
                </div>
                <div class="stat-value" id="processingOrders">45</div>
                <div class="stat-label">Đang xử lý</div>
                <div class="stat-change">
                    <i class="bi bi-dash"></i> Không đổi
                </div>
            </div>

            <div class="stat-card shipped">
                <div class="stat-icon">
                    <i class="bi bi-truck"></i>
                </div>
                <div class="stat-value" id="shippedOrders">67</div>
                <div class="stat-label">Đang giao hàng</div>
                <div class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +15 đơn
                </div>
            </div>

            <div class="stat-card delivered">
                <div class="stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-value" id="deliveredOrders">1,089</div>
                <div class="stat-label">Đã giao</div>
                <div class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +89 đơn tuần này
                </div>
            </div>

            <div class="stat-card cancelled">
                <div class="stat-icon">
                    <i class="bi bi-x-circle"></i>
                </div>
                <div class="stat-value" id="cancelledOrders">18</div>
                <div class="stat-label">Đã hủy</div>
                <div class="stat-change negative">
                    <i class="bi bi-arrow-down"></i> -5% so với tuần trước
                </div>
            </div>

            <div class="stat-card revenue">
                <div class="stat-icon">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="stat-value" id="totalRevenue">₫156.2M</div>
                <div class="stat-label">Doanh thu tháng này</div>
                <div class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +18.5% tăng trưởng
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);">
                    <i class="bi bi-graph-up"></i>
                </div>
                <div class="stat-value" id="avgOrderValue">₫1.25M</div>
                <div class="stat-label">Giá trị đơn hàng TB</div>
                <div class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +8.2% cải thiện
                </div>
            </div>
        </div>

        {{-- Filters Section --}}
        <div class="filters-section fade-in-up">
            <div class="filters-title">
                <i class="bi bi-funnel"></i>
                Bộ lọc và tìm kiếm
            </div>

            <div class="filters-grid">
                <div class="filter-group">
                    <label for="searchOrders">Tìm kiếm đơn hàng</label>
                    <div class="quick-search">
                        <i class="bi bi-search search-icon"></i>
                        <input type="text" class="form-control" id="searchOrders"
                            placeholder="Mã đơn, tên khách hàng, email...">
                    </div>
                </div>

                <div class="filter-group">
                    <label for="statusFilter">Trạng thái đơn hàng</label>
                    <select class="form-select" id="statusFilter">
                        <option value="">Tất cả trạng thái</option>
                        <option value="pending">Chờ xử lý</option>
                        <option value="confirmed">Đã xác nhận</option>
                        <option value="processing">Đang xử lý</option>
                        <option value="shipped">Đang giao hàng</option>
                        <option value="delivered">Đã giao</option>
                        <option value="cancelled">Đã hủy</option>
                        <option value="refunded">Đã hoàn tiền</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="paymentFilter">Trạng thái thanh toán</label>
                    <select class="form-select" id="paymentFilter">
                        <option value="">Tất cả</option>
                        <option value="paid">Đã thanh toán</option>
                        <option value="pending">Chờ thanh toán</option>
                        <option value="failed">Thanh toán thất bại</option>
                        <option value="refunded">Đã hoàn tiền</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="dateRange">Khoảng thời gian</label>
                    <select class="form-select" id="dateRange">
                        <option value="">Tất cả thời gian</option>
                        <option value="today">Hôm nay</option>
                        <option value="yesterday">Hôm qua</option>
                        <option value="week">7 ngày qua</option>
                        <option value="month">30 ngày qua</option>
                        <option value="quarter">3 tháng qua</option>
                        <option value="year">Năm nay</option>
                        <option value="custom">Tùy chọn</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="amountRange">Giá trị đơn hàng</label>
                    <select class="form-select" id="amountRange">
                        <option value="">Tất cả</option>
                        <option value="0-500000">Dưới 500k</option>
                        <option value="500000-1000000">500k - 1M</option>
                        <option value="1000000-2000000">1M - 2M</option>
                        <option value="2000000-5000000">2M - 5M</option>
                        <option value="5000000+">Trên 5M</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="sortBy">Sắp xếp theo</label>
                    <select class="form-select" id="sortBy">
                        <option value="created_desc">Mới nhất</option>
                        <option value="created_asc">Cũ nhất</option>
                        <option value="amount_desc">Giá trị cao nhất</option>
                        <option value="amount_asc">Giá trị thấp nhất</option>
                        <option value="status">Trạng thái</option>
                        <option value="customer">Tên khách hàng</option>
                    </select>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <button class="filter-toggle" type="button">
                    <i class="bi bi-chevron-down" id="advancedToggleIcon"></i>
                    Bộ lọc nâng cao
                </button>

                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary btn-sm">
                        <i class="bi bi-x-circle me-1"></i>
                        Xóa bộ lọc
                    </button>
                    <button class="btn btn-primary btn-sm">
                        <i class="bi bi-funnel me-1"></i>
                        Áp dụng
                    </button>
                </div>
            </div>

            <div class="advanced-filters" id="advancedFilters">
                <div class="filters-grid">
                    <div class="filter-group">
                        <label for="customerType">Loại khách hàng</label>
                        <select class="form-select" id="customerType">
                            <option value="">Tất cả</option>
                            <option value="new">Khách hàng mới</option>
                            <option value="returning">Khách hàng cũ</option>
                            <option value="vip">Khách VIP</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="shippingMethod">Phương thức vận chuyển</label>
                        <select class="form-select" id="shippingMethod">
                            <option value="">Tất cả</option>
                            <option value="standard">Giao hàng tiêu chuẩn</option>
                            <option value="express">Giao hàng nhanh</option>
                            <option value="same_day">Giao hàng trong ngày</option>
                            <option value="pickup">Nhận tại cửa hàng</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="paymentMethod">Phương thức thanh toán</label>
                        <select class="form-select" id="paymentMethod">
                            <option value="">Tất cả</option>
                            <option value="cod">Thanh toán khi giao hàng</option>
                            <option value="bank_transfer">Chuyển khoản</option>
                            <option value="credit_card">Thẻ tín dụng</option>
                            <option value="e_wallet">Ví điện tử</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label for="orderPriority">Độ ưu tiên</label>
                        <select class="form-select" id="orderPriority">
                            <option value="">Tất cả</option>
                            <option value="high">Cao</option>
                            <option value="medium">Trung bình</option>
                            <option value="low">Thấp</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bulk Actions --}}
        <div class="bulk-actions fade-in-up" id="bulkActions">
            <div class="bulk-actions-text">
                <span id="selectedCount">0</span> đơn hàng được chọn
            </div>
            <div class="bulk-actions-controls">
                <select class="form-select form-select-sm" id="bulkAction" style="width: auto;">
                    <option value="">Chọn hành động</option>
                    <option value="confirm">Xác nhận đơn hàng</option>
                    <option value="process">Chuyển sang xử lý</option>
                    <option value="ship">Chuyển sang giao hàng</option>
                    <option value="cancel">Hủy đơn hàng</option>
                    <option value="export">Xuất danh sách</option>
                    <option value="print">In đơn hàng</option>
                </select>
                <button class="btn btn-primary btn-sm">
                    Áp dụng
                </button>
            </div>
        </div>

        {{-- Orders Table --}}
        <div class="orders-table-container fade-in-up">
            <div class="table-header">
                <h3 class="table-title">
                    <i class="bi bi-list-ul"></i>
                    Danh sách đơn hàng
                </h3>
                <div class="table-actions">
                    <div class="export-actions">
                        <button class="export-btn excel">
                            <i class="bi bi-file-earmark-excel"></i>
                            Excel
                        </button>
                        <button class="export-btn pdf">
                            <i class="bi bi-file-earmark-pdf"></i>
                            PDF
                        </button>
                        <button class="export-btn csv">
                            <i class="bi bi-filetype-csv"></i>
                            CSV
                        </button>
                    </div>
                    <button class="btn btn-primary btn-sm">
                        <i class="bi bi-arrow-clockwise me-1"></i>
                        Làm mới
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="orders-table" id="ordersTable">
                    <thead>
                        <tr>
                            <th>
                                <input class="form-check-input" type="checkbox" id="selectAll">
                            </th>
                            <th>Mã đơn hàng</th>
                            <th>Khách hàng</th>
                            <th>Sản phẩm</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Thanh toán</th>
                            <th>Ngày đặt</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Order 1 --}}
                        <tr>
                            <td>
                                <input class="form-check-input item-checkbox" type="checkbox" value="1">
                            </td>
                            <td>
                                <div class="order-info">
                                    <div class="order-priority high"></div>
                                    <div>
                                        <div class="order-id">#ORD-2025-001247</div>
                                        <div class="order-date">01/08/2025 09:15</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-name">Nguyễn Văn Anh</div>
                                    <div class="customer-email">nguyenvananh@email.com</div>
                                    <div class="customer-phone">0912345678</div>
                                </div>
                            </td>
                            <td>
                                <div class="product-summary">
                                    <span class="product-count">3 sản phẩm</span>
                                    <div class="product-preview">iPhone 15 Pro, AirPods Pro...</div>
                                </div>
                            </td>
                            <td>
                                <div class="order-amount">₫29,850,000</div>
                                <div class="order-tax">Đã bao gồm VAT</div>
                            </td>
                            <td>
                                <span class="status-badge pending">
                                    <i class="bi bi-clock"></i>
                                    Chờ xử lý
                                </span>
                            </td>
                            <td>
                                <span class="payment-status pending">
                                    <i class="bi bi-clock"></i>
                                    Chờ thanh toán
                                </span>
                            </td>
                            <td>
                                <div class="order-timeline">
                                    <div class="timeline-step current">
                                        <i class="bi bi-circle-fill"></i>
                                        15 phút trước
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" title="Xác nhận đơn hàng">
                                        <i class="bi bi-check"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning" title="Chỉnh sửa">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" title="Hủy đơn hàng">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Order 2 --}}
                        <tr>
                            <td>
                                <input class="form-check-input item-checkbox" type="checkbox" value="2">
                            </td>
                            <td>
                                <div class="order-info">
                                    <div class="order-priority medium"></div>
                                    <div>
                                        <div class="order-id">#ORD-2025-001246</div>
                                        <div class="order-date">01/08/2025 08:45</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-name">Trần Thị Bình</div>
                                    <div class="customer-email">tranthibinh@email.com</div>
                                    <div class="customer-phone">0987654321</div>
                                </div>
                            </td>
                            <td>
                                <div class="product-summary">
                                    <span class="product-count">2 sản phẩm</span>
                                    <div class="product-preview">MacBook Air M3, Magic Mouse...</div>
                                </div>
                            </td>
                            <td>
                                <div class="order-amount">₫32,500,000</div>
                                <div class="order-tax">Đã bao gồm VAT</div>
                            </td>
                            <td>
                                <span class="status-badge processing">
                                    <i class="bi bi-gear"></i>
                                    Đang xử lý
                                </span>
                            </td>
                            <td>
                                <span class="payment-status paid">
                                    <i class="bi bi-check-circle"></i>
                                    Đã thanh toán
                                </span>
                            </td>
                            <td>
                                <div class="order-timeline">
                                    <div class="timeline-step completed">
                                        <i class="bi bi-check-circle-fill"></i>
                                        45 phút trước
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-info" title="Chuẩn bị giao hàng">
                                        <i class="bi bi-truck"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning" title="Chỉnh sửa">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" title="In hóa đơn">
                                        <i class="bi bi-printer"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Order 3 --}}
                        <tr>
                            <td>
                                <input class="form-check-input item-checkbox" type="checkbox" value="3">
                            </td>
                            <td>
                                <div class="order-info">
                                    <div class="order-priority low"></div>
                                    <div>
                                        <div class="order-id">#ORD-2025-001245</div>
                                        <div class="order-date">31/07/2025 16:30</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-name">Lê Minh Tuấn</div>
                                    <div class="customer-email">leminhtuan@email.com</div>
                                    <div class="customer-phone">0901234567</div>
                                </div>
                            </td>
                            <td>
                                <div class="product-summary">
                                    <span class="product-count">1 sản phẩm</span>
                                    <div class="product-preview">iPad Pro 12.9 inch</div>
                                </div>
                            </td>
                            <td>
                                <div class="order-amount">₫24,990,000</div>
                                <div class="order-tax">Đã bao gồm VAT</div>
                            </td>
                            <td>
                                <span class="status-badge shipped">
                                    <i class="bi bi-truck"></i>
                                    Đang giao hàng
                                </span>
                            </td>
                            <td>
                                <span class="payment-status paid">
                                    <i class="bi bi-check-circle"></i>
                                    Đã thanh toán
                                </span>
                            </td>
                            <td>
                                <div class="order-timeline">
                                    <div class="timeline-step completed">
                                        <i class="bi bi-check-circle-fill"></i>
                                        1 ngày trước
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary" title="Theo dõi vận chuyển">
                                        <i class="bi bi-geo-alt"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-info" title="Xem chi tiết">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" title="Hoàn thành giao hàng">
                                        <i class="bi bi-check-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning" title="Báo cáo sự cố">
                                        <i class="bi bi-exclamation-triangle"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Order 4 --}}
                        <tr>
                            <td>
                                <input class="form-check-input item-checkbox" type="checkbox" value="4">
                            </td>
                            <td>
                                <div class="order-info">
                                    <div class="order-priority medium"></div>
                                    <div>
                                        <div class="order-id">#ORD-2025-001244</div>
                                        <div class="order-date">31/07/2025 14:20</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-name">Phạm Thu Hà</div>
                                    <div class="customer-email">phamthuha@email.com</div>
                                    <div class="customer-phone">0908765432</div>
                                </div>
                            </td>
                            <td>
                                <div class="product-summary">
                                    <span class="product-count">4 sản phẩm</span>
                                    <div class="product-preview">Apple Watch, Charger, Case...</div>
                                </div>
                            </td>
                            <td>
                                <div class="order-amount">₫15,750,000</div>
                                <div class="order-tax">Đã bao gồm VAT</div>
                            </td>
                            <td>
                                <span class="status-badge delivered">
                                    <i class="bi bi-check-circle"></i>
                                    Đã giao
                                </span>
                            </td>
                            <td>
                                <span class="payment-status paid">
                                    <i class="bi bi-check-circle"></i>
                                    Đã thanh toán
                                </span>
                            </td>
                            <td>
                                <div class="order-timeline">
                                    <div class="timeline-step completed">
                                        <i class="bi bi-check-circle-fill"></i>
                                        2 ngày trước
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" title="Yêu cầu đánh giá">
                                        <i class="bi bi-star"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-info" title="In hóa đơn">
                                        <i class="bi bi-printer"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning" title="Hoàn trả">
                                        <i class="bi bi-arrow-return-left"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Order 5 --}}
                        <tr>
                            <td>
                                <input class="form-check-input item-checkbox" type="checkbox" value="5">
                            </td>
                            <td>
                                <div class="order-info">
                                    <div class="order-priority high"></div>
                                    <div>
                                        <div class="order-id">#ORD-2025-001243</div>
                                        <div class="order-date">30/07/2025 11:10</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-name">Võ Đình Nam</div>
                                    <div class="customer-email">vodinhnam@email.com</div>
                                    <div class="customer-phone">0912987654</div>
                                </div>
                            </td>
                            <td>
                                <div class="product-summary">
                                    <span class="product-count">1 sản phẩm</span>
                                    <div class="product-preview">MacBook Pro 16 inch M3 Max</div>
                                </div>
                            </td>
                            <td>
                                <div class="order-amount">₫89,990,000</div>
                                <div class="order-tax">Đã bao gồm VAT</div>
                            </td>
                            <td>
                                <span class="status-badge cancelled">
                                    <i class="bi bi-x-circle"></i>
                                    Đã hủy
                                </span>
                            </td>
                            <td>
                                <span class="payment-status refunded">
                                    <i class="bi bi-arrow-return-left"></i>
                                    Đã hoàn tiền
                                </span>
                            </td>
                            <td>
                                <div class="order-timeline">
                                    <div class="timeline-step completed">
                                        <i class="bi bi-x-circle-fill"></i>
                                        3 ngày trước
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-outline-primary" title="Xem chi tiết">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-info" title="Lý do hủy">
                                        <i class="bi bi-info-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-success" title="Tạo lại đơn hàng">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning" title="Liên hệ khách hàng">
                                        <i class="bi bi-telephone"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="pagination-container">
                <div class="pagination-info">
                    Hiển thị <strong>1-5</strong> trong tổng số <strong>1,247</strong> đơn hàng
                </div>
                <div class="pagination-nav">
                    <button class="page-btn" disabled title="Trang trước">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <button class="page-btn active">1</button>
                    <button class="page-btn">2</button>
                    <button class="page-btn">3</button>
                    <button class="page-btn">...</button>
                    <button class="page-btn">249</button>
                    <button class="page-btn" title="Trang sau">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/admin/orders/index.js') }}"></script>
    @endpush
@endsection
