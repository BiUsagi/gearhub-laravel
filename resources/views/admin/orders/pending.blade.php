@extends('admin.layouts.app')

@section('title', 'Đơn hàng cần xử lý')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/orders/pending.css') }}">
@endpush

@section('content')
    <div class="container-fluid p-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="fade-in-up">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/orders">Đơn hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cần xử lý</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="page-header fade-in-up">
            <div class="header-main">
                <h1 class="page-title">
                    <i class="bi bi-exclamation-triangle-fill text-warning me-3"></i>
                    Đơn hàng cần xử lý
                </h1>
                <p class="page-subtitle">Xử lý nhanh các đơn hàng đang chờ xác nhận</p>
            </div>
            <div class="header-actions">
                <button class="btn btn-outline-secondary" id="refreshBtn">
                    <i class="bi bi-arrow-clockwise me-2"></i>
                    Làm mới
                </button>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bulkActionModal">
                    <i class="bi bi-lightning-fill me-2"></i>
                    Xử lý hàng loạt
                </button>
            </div>
        </div>

        {{-- Quick Stats --}}
        <div class="quick-stats fade-in-up">
            <div class="stat-card urgent">
                <div class="stat-icon">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value" id="urgentCount">8</div>
                    <div class="stat-label">Khẩn cấp (>2h)</div>
                </div>
            </div>

            <div class="stat-card today">
                <div class="stat-icon">
                    <i class="bi bi-clock-fill"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value" id="todayCount">15</div>
                    <div class="stat-label">Hôm nay</div>
                </div>
            </div>

            <div class="stat-card high-value">
                <div class="stat-icon">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value" id="highValueCount">5</div>
                    <div class="stat-label">Giá trị cao (>5M)</div>
                </div>
            </div>

            <div class="stat-card total">
                <div class="stat-icon">
                    <i class="bi bi-list-ul"></i>
                </div>
                <div class="stat-content">
                    <div class="stat-value" id="totalPending">28</div>
                    <div class="stat-label">Tổng cần xử lý</div>
                </div>
            </div>
        </div>

        {{-- Quick Actions Bar --}}
        <div class="quick-actions-bar fade-in-up">
            <div class="actions-left">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="selectAllPending">
                    <label class="form-check-label" for="selectAllPending">
                        Chọn tất cả (<span id="selectedCountDisplay">0</span>)
                    </label>
                </div>
                <div class="bulk-actions" id="bulkActionsContainer" style="display: none;">
                    <button class="btn btn-success btn-sm" id="bulkConfirmBtn">
                        <i class="bi bi-check-circle me-1"></i>
                        Xác nhận
                    </button>
                    <button class="btn btn-danger btn-sm" id="bulkCancelBtn">
                        <i class="bi bi-x-circle me-1"></i>
                        Hủy
                    </button>
                    <button class="btn btn-info btn-sm" id="bulkPrintBtn">
                        <i class="bi bi-printer me-1"></i>
                        In
                    </button>
                </div>
            </div>
            <div class="actions-right">
                <div class="filter-group">
                    <label>Sắp xếp:</label>
                    <select class="form-select form-select-sm" id="sortOrder">
                        <option value="newest">Mới nhất</option>
                        <option value="oldest">Cũ nhất</option>
                        <option value="amount_desc">Giá trị cao</option>
                        <option value="urgent">Khẩn cấp</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Pending Orders List --}}
        <div class="pending-orders-container fade-in-up">
            <div class="orders-grid" id="pendingOrdersGrid">

                {{-- Order Card 1 - Urgent --}}
                <div class="order-card urgent" data-order-id="1247">
                    <div class="order-header">
                        <div class="order-selection">
                            <input class="form-check-input order-checkbox" type="checkbox" value="1247">
                        </div>
                        <div class="order-info">
                            <div class="order-id">#ORD-2025-001247</div>
                            <div class="order-time">
                                <i class="bi bi-clock"></i>
                                <span class="time-ago urgent">2 giờ 15 phút trước</span>
                            </div>
                        </div>
                        <div class="order-priority">
                            <span class="priority-badge urgent">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                Khẩn cấp
                            </span>
                        </div>
                    </div>

                    <div class="order-body">
                        <div class="customer-section">
                            <div class="customer-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="customer-details">
                                <div class="customer-name">Nguyễn Văn Anh</div>
                                <div class="customer-contact">
                                    <i class="bi bi-telephone"></i>
                                    0912345678
                                </div>
                                <div class="customer-type">
                                    <span class="badge bg-primary">Khách VIP</span>
                                </div>
                            </div>
                        </div>

                        <div class="order-details">
                            <div class="products-summary">
                                <div class="product-count">3 sản phẩm</div>
                                <div class="product-preview">iPhone 15 Pro, AirPods Pro, MagSafe Charger</div>
                            </div>
                            <div class="order-amount">
                                <div class="amount-value">₫29,850,000</div>
                                <div class="payment-method">
                                    <i class="bi bi-credit-card"></i>
                                    Chuyển khoản
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-actions">
                        <button class="btn btn-outline-primary btn-sm" title="Xem chi tiết">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-success btn-sm confirm-btn" title="Xác nhận đơn hàng">
                            <i class="bi bi-check-circle"></i>
                            Xác nhận
                        </button>
                        <button class="btn btn-warning btn-sm" title="Liên hệ khách hàng">
                            <i class="bi bi-telephone"></i>
                        </button>
                        <button class="btn btn-danger btn-sm cancel-btn" title="Hủy đơn hàng">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                </div>

                {{-- Order Card 2 - High Value --}}
                <div class="order-card high-value" data-order-id="1246">
                    <div class="order-header">
                        <div class="order-selection">
                            <input class="form-check-input order-checkbox" type="checkbox" value="1246">
                        </div>
                        <div class="order-info">
                            <div class="order-id">#ORD-2025-001246</div>
                            <div class="order-time">
                                <i class="bi bi-clock"></i>
                                <span class="time-ago">1 giờ 30 phút trước</span>
                            </div>
                        </div>
                        <div class="order-priority">
                            <span class="priority-badge high-value">
                                <i class="bi bi-currency-dollar"></i>
                                Giá trị cao
                            </span>
                        </div>
                    </div>

                    <div class="order-body">
                        <div class="customer-section">
                            <div class="customer-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="customer-details">
                                <div class="customer-name">Trần Thị Bình</div>
                                <div class="customer-contact">
                                    <i class="bi bi-envelope"></i>
                                    tranthibinh@email.com
                                </div>
                                <div class="customer-type">
                                    <span class="badge bg-success">Khách mới</span>
                                </div>
                            </div>
                        </div>

                        <div class="order-details">
                            <div class="products-summary">
                                <div class="product-count">2 sản phẩm</div>
                                <div class="product-preview">MacBook Pro 16", Magic Mouse</div>
                            </div>
                            <div class="order-amount">
                                <div class="amount-value">₫67,500,000</div>
                                <div class="payment-method">
                                    <i class="bi bi-wallet2"></i>
                                    COD
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-actions">
                        <button class="btn btn-outline-primary btn-sm" title="Xem chi tiết">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-success btn-sm confirm-btn" title="Xác nhận đơn hàng">
                            <i class="bi bi-check-circle"></i>
                            Xác nhận
                        </button>
                        <button class="btn btn-warning btn-sm" title="Liên hệ khách hàng">
                            <i class="bi bi-telephone"></i>
                        </button>
                        <button class="btn btn-danger btn-sm cancel-btn" title="Hủy đơn hàng">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                </div>

                {{-- Order Card 3 - Normal --}}
                <div class="order-card normal" data-order-id="1245">
                    <div class="order-header">
                        <div class="order-selection">
                            <input class="form-check-input order-checkbox" type="checkbox" value="1245">
                        </div>
                        <div class="order-info">
                            <div class="order-id">#ORD-2025-001245</div>
                            <div class="order-time">
                                <i class="bi bi-clock"></i>
                                <span class="time-ago">45 phút trước</span>
                            </div>
                        </div>
                        <div class="order-priority">
                            <span class="priority-badge normal">
                                <i class="bi bi-circle-fill"></i>
                                Bình thường
                            </span>
                        </div>
                    </div>

                    <div class="order-body">
                        <div class="customer-section">
                            <div class="customer-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="customer-details">
                                <div class="customer-name">Lê Minh Tuấn</div>
                                <div class="customer-contact">
                                    <i class="bi bi-telephone"></i>
                                    0901234567
                                </div>
                                <div class="customer-type">
                                    <span class="badge bg-info">Khách cũ</span>
                                </div>
                            </div>
                        </div>

                        <div class="order-details">
                            <div class="products-summary">
                                <div class="product-count">1 sản phẩm</div>
                                <div class="product-preview">iPad Pro 12.9 inch</div>
                            </div>
                            <div class="order-amount">
                                <div class="amount-value">₫24,990,000</div>
                                <div class="payment-method">
                                    <i class="bi bi-credit-card"></i>
                                    Thẻ tín dụng
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-actions">
                        <button class="btn btn-outline-primary btn-sm" title="Xem chi tiết">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-success btn-sm confirm-btn" title="Xác nhận đơn hàng">
                            <i class="bi bi-check-circle"></i>
                            Xác nhận
                        </button>
                        <button class="btn btn-warning btn-sm" title="Liên hệ khách hàng">
                            <i class="bi bi-telephone"></i>
                        </button>
                        <button class="btn btn-danger btn-sm cancel-btn" title="Hủy đơn hàng">
                            <i class="bi bi-x-circle"></i>
                        </button>
                    </div>
                </div>

                {{-- Repeat similar cards for other pending orders --}}
                {{-- Add more order cards as needed --}}
            </div>

            {{-- Load More Button --}}
            <div class="load-more-container">
                <button class="btn btn-outline-primary" id="loadMoreBtn">
                    <i class="bi bi-arrow-down me-2"></i>
                    Tải thêm đơn hàng
                </button>
            </div>
        </div>
    </div>

    {{-- Bulk Action Modal --}}
    <div class="modal fade" id="bulkActionModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-lightning-fill text-warning me-2"></i>
                        Xử lý hàng loạt
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="action-options">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="bulkAction" id="confirmAll"
                                value="confirm">
                            <label class="form-check-label" for="confirmAll">
                                <i class="bi bi-check-circle text-success me-2"></i>
                                Xác nhận tất cả đơn hàng đã chọn
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="bulkAction" id="cancelAll"
                                value="cancel">
                            <label class="form-check-label" for="cancelAll">
                                <i class="bi bi-x-circle text-danger me-2"></i>
                                Hủy tất cả đơn hàng đã chọn
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="bulkAction" id="printAll"
                                value="print">
                            <label class="form-check-label" for="printAll">
                                <i class="bi bi-printer text-info me-2"></i>
                                In tất cả đơn hàng đã chọn
                            </label>
                        </div>
                    </div>
                    <div class="selected-orders-info">
                        <p>Số đơn hàng đã chọn: <strong><span id="selectedOrdersCount">0</span></strong></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-primary" id="executeBulkAction">Thực hiện</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/admin/orders/pending.js') }}"></script>
    @endpush
@endsection
