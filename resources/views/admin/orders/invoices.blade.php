@extends('admin.layouts.app')

@section('title', 'Quản lý hóa đơn - GearHub Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/orders/invoices.css') }}">
@endpush

@section('content')
    <div class="container-fluid p-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="fade-in-up">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/orders">Đơn hàng</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quản lý hóa đơn</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="page-header fade-in-up">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">
                        <i class="bi bi-receipt-cutoff"></i>
                        Quản lý hóa đơn
                    </h1>
                    <p class="page-subtitle">Quản lý, tạo và theo dõi tất cả hóa đơn bán hàng</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary" onclick="exportInvoices()">
                        <i class="bi bi-download me-1"></i>
                        Xuất Excel
                    </button>
                    <button class="btn btn-primary" onclick="createInvoice()">
                        <i class="bi bi-plus-circle me-1"></i>
                        Tạo hóa đơn mới
                    </button>
                </div>
            </div>
        </div>

        {{-- Invoice Statistics --}}
        <div class="stats-cards fade-in-up">
            <div class="stat-card total">
                <div class="stat-icon">
                    <i class="bi bi-receipt"></i>
                </div>
                <div class="stat-value">1,847</div>
                <div class="stat-label">Tổng hóa đơn</div>
                <div class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +12% so với tháng trước
                </div>
            </div>

            <div class="stat-card pending">
                <div class="stat-icon">
                    <i class="bi bi-clock"></i>
                </div>
                <div class="stat-value">28</div>
                <div class="stat-label">Chờ thanh toán</div>
                <div class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +5 hóa đơn mới
                </div>
            </div>

            <div class="stat-card success">
                <div class="stat-icon">
                    <i class="bi bi-check-circle"></i>
                </div>
                <div class="stat-value">1,653</div>
                <div class="stat-label">Đã thanh toán</div>
                <div class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +15% so với tháng trước
                </div>
            </div>

            <div class="stat-card revenue">
                <div class="stat-icon">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <div class="stat-value">89.2M ₫</div>
                <div class="stat-label">Tổng doanh thu</div>
                <div class="stat-change positive">
                    <i class="bi bi-arrow-up"></i> +22% so với tháng trước
                </div>
            </div>
        </div>

        {{-- Search & Filter Section --}}
        <div class="filters-section fade-in-up">
            <div class="filters-title">
                <i class="bi bi-funnel me-2"></i>
                Tìm kiếm và lọc hóa đơn
            </div>
            <div class="row mt-3">
                <div class="col-md-4">
                    <label class="form-label">Tìm kiếm hóa đơn</label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Mã hóa đơn, khách hàng, số điện thoại..."
                            id="searchInput">
                        <button class="btn btn-primary" onclick="searchInvoices()">
                            Tìm kiếm
                        </button>
                    </div>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Trạng thái</label>
                    <select class="form-select" onchange="filterByStatus(this.value)">
                        <option value="">Tất cả</option>
                        <option value="paid">Đã thanh toán</option>
                        <option value="pending">Chờ thanh toán</option>
                        <option value="overdue">Quá hạn</option>
                        <option value="cancelled">Đã hủy</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Phương thức</label>
                    <select class="form-select">
                        <option value="">Tất cả</option>
                        <option value="cash">Tiền mặt</option>
                        <option value="bank">Chuyển khoản</option>
                        <option value="card">Thẻ tín dụng</option>
                        <option value="vnpay">VNPay</option>
                        <option value="momo">MoMo</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Từ ngày</label>
                    <input type="date" class="form-control" value="2025-07-01">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Đến ngày</label>
                    <input type="date" class="form-control" value="2025-08-02">
                </div>
            </div>
        </div>

        {{-- Quick Actions Section --}}
        <div class="quick-actions-section fade-in-up">
            <div class="row">
                <div class="col-md-3">
                    <div class="quick-action-card draft">
                        <div class="quick-action-icon">
                            <i class="bi bi-file-earmark-plus"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Tạo hóa đơn nháp</h6>
                            <p>Tạo và lưu hóa đơn để chỉnh sửa sau</p>
                            <button class="btn btn-outline-secondary btn-sm">Tạo nháp</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="quick-action-card template">
                        <div class="quick-action-icon">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Sử dụng mẫu</h6>
                            <p>Tạo hóa đơn từ mẫu có sẵn</p>
                            <button class="btn btn-outline-info btn-sm">Chọn mẫu</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="quick-action-card bulk">
                        <div class="quick-action-icon">
                            <i class="bi bi-files"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Xuất hàng loạt</h6>
                            <p>In hoặc gửi email nhiều hóa đơn</p>
                            <button class="btn btn-outline-warning btn-sm">Chọn hóa đơn</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="quick-action-card report">
                        <div class="quick-action-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <div class="quick-action-content">
                            <h6>Báo cáo doanh thu</h6>
                            <p>Xem báo cáo chi tiết theo thời gian</p>
                            <button class="btn btn-outline-success btn-sm">Xem báo cáo</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Invoices Table --}}
        <div class="content-card fade-in-up">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        <i class="bi bi-list-ul me-2"></i>
                        Danh sách hóa đơn
                    </h5>
                    <div class="d-flex gap-2">
                        <div class="btn-group" role="group">
                            <button class="btn btn-sm btn-outline-secondary active">Tất cả</button>
                            <button class="btn btn-sm btn-outline-secondary">Hôm nay</button>
                            <button class="btn btn-sm btn-outline-secondary">Tuần này</button>
                            <button class="btn btn-sm btn-outline-secondary">Tháng này</button>
                        </div>
                        <button class="btn btn-sm btn-outline-primary" onclick="refreshTable()">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                </th>
                                <th>Mã hóa đơn</th>
                                <th>Khách hàng</th>
                                <th>Ngày tạo</th>
                                <th>Hạn thanh toán</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Phương thức</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <div class="invoice-code">
                                        <span class="fw-semibold">#INV-2025-001</span>
                                        <br>
                                        <small class="text-muted">Từ đơn hàng #GH2025-001</small>
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
                                    <div class="date-info">
                                        <span class="fw-semibold">01/08/2025</span>
                                        <br>
                                        <small class="text-muted">14:30</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="due-date">
                                        <span class="fw-semibold text-warning">15/08/2025</span>
                                        <br>
                                        <small class="text-muted">Còn 13 ngày</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="amount-info">
                                        <span class="fw-bold">2.590.000 ₫</span>
                                        <br>
                                        <small class="text-muted">Đã VAT</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge paid">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Đã thanh toán
                                    </span>
                                </td>
                                <td>
                                    <div class="payment-method">
                                        <div class="payment-icon vnpay">
                                            <i class="bi bi-credit-card"></i>
                                        </div>
                                        <small>VNPay</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary" title="Xem chi tiết"
                                            onclick="viewInvoice('INV-2025-001')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="In hóa đơn"
                                            onclick="printInvoice('INV-2025-001')">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Gửi email"
                                            onclick="emailInvoice('INV-2025-001')">
                                            <i class="bi bi-envelope"></i>
                                        </button>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-pencil me-2"></i>Chỉnh sửa</a></li>
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-files me-2"></i>Nhân bản</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger" href="#"><i
                                                            class="bi bi-trash me-2"></i>Xóa</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <div class="invoice-code">
                                        <span class="fw-semibold">#INV-2025-002</span>
                                        <br>
                                        <small class="text-muted">Từ đơn hàng #GH2025-002</small>
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
                                    <div class="date-info">
                                        <span class="fw-semibold">31/07/2025</span>
                                        <br>
                                        <small class="text-muted">09:15</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="due-date">
                                        <span class="fw-semibold text-success">05/08/2025</span>
                                        <br>
                                        <small class="text-muted">Còn 3 ngày</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="amount-info">
                                        <span class="fw-bold">1.250.000 ₫</span>
                                        <br>
                                        <small class="text-muted">Đã VAT</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge pending">
                                        <i class="bi bi-clock me-1"></i>
                                        Chờ thanh toán
                                    </span>
                                </td>
                                <td>
                                    <div class="payment-method">
                                        <div class="payment-icon bank">
                                            <i class="bi bi-bank"></i>
                                        </div>
                                        <small>Chuyển khoản</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary" title="Xem chi tiết"
                                            onclick="viewInvoice('INV-2025-002')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="In hóa đơn"
                                            onclick="printInvoice('INV-2025-002')">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" title="Gửi email"
                                            onclick="emailInvoice('INV-2025-002')">
                                            <i class="bi bi-envelope"></i>
                                        </button>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-pencil me-2"></i>Chỉnh sửa</a></li>
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-files me-2"></i>Nhân bản</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger" href="#"><i
                                                            class="bi bi-trash me-2"></i>Xóa</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input">
                                </td>
                                <td>
                                    <div class="invoice-code">
                                        <span class="fw-semibold">#INV-2025-003</span>
                                        <br>
                                        <small class="text-muted">Từ đơn hàng #GH2025-003</small>
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
                                    <div class="date-info">
                                        <span class="fw-semibold">30/07/2025</span>
                                        <br>
                                        <small class="text-muted">16:45</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="due-date overdue">
                                        <span class="fw-semibold text-danger">01/08/2025</span>
                                        <br>
                                        <small class="text-danger">Quá hạn 1 ngày</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="amount-info">
                                        <span class="fw-bold">899.000 ₫</span>
                                        <br>
                                        <small class="text-muted">Đã VAT</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge overdue">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        Quá hạn
                                    </span>
                                </td>
                                <td>
                                    <div class="payment-method">
                                        <div class="payment-icon cash">
                                            <i class="bi bi-cash"></i>
                                        </div>
                                        <small>Tiền mặt</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary" title="Xem chi tiết"
                                            onclick="viewInvoice('INV-2025-003')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" title="In hóa đơn"
                                            onclick="printInvoice('INV-2025-003')">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-warning" title="Nhắc nhở"
                                            onclick="remindCustomer('INV-2025-003')">
                                            <i class="bi bi-bell"></i>
                                        </button>
                                        <div class="btn-group">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-pencil me-2"></i>Chỉnh sửa</a></li>
                                                <li><a class="dropdown-item" href="#"><i
                                                            class="bi bi-files me-2"></i>Nhân bản</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger" href="#"><i
                                                            class="bi bi-trash me-2"></i>Xóa</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Table Footer -->
                <div class="table-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <small class="text-muted">Hiển thị 1-3 trong tổng số 1,847 hóa đơn</small>
                            <div class="bulk-actions" style="display: none;">
                                <button class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-printer me-1"></i>
                                    In đã chọn
                                </button>
                                <button class="btn btn-sm btn-outline-success">
                                    <i class="bi bi-envelope me-1"></i>
                                    Gửi email
                                </button>
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash me-1"></i>
                                    Xóa
                                </button>
                            </div>
                        </div>
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
                                    <span class="page-link">...</span>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">616</a>
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

    {{-- Invoice Detail Modal --}}
    <div class="modal fade" id="invoiceDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-receipt-cutoff me-2"></i>
                        Chi tiết hóa đơn #INV-2025-001
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="invoice-preview">
                        <!-- Invoice content will be loaded here -->
                        <div class="text-center py-5">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Đang tải chi tiết hóa đơn...</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="button" class="btn btn-outline-info">
                        <i class="bi bi-printer me-1"></i>
                        In hóa đơn
                    </button>
                    <button type="button" class="btn btn-outline-success">
                        <i class="bi bi-envelope me-1"></i>
                        Gửi email
                    </button>
                    <button type="button" class="btn btn-primary">
                        <i class="bi bi-pencil me-1"></i>
                        Chỉnh sửa
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/admin/orders/invoices.js') }}"></script>
@endpush
