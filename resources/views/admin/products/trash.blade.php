@extends('admin.layouts.app')

@section('title', 'Thùng rác sản phẩm')
@push('styles')
    <style>
        /* Product Index Styles - Copied from index.blade.php */
        .product-header {
            background: var(--bg-primary);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid var(--border-color);
        }

        .product-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: var(--bg-primary);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            text-align: center;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px var(--shadow-color);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            background: var(--primary-gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .products-table-container {
            background: var(--bg-primary);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            overflow: hidden;
        }

        .table-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 1rem;
        }

        .table-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
        }

        .table-filters {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .filter-select,
        .filter-input {
            padding: 0.5rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--bg-secondary);
            color: var(--text-primary);
            font-size: 0.875rem;
        }

        .filter-select:focus,
        .filter-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-color-alpha);
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
        }

        .products-table th,
        .products-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .products-table th {
            background: var(--bg-secondary);
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
        }

        .products-table td {
            color: var(--text-secondary);
            vertical-align: middle;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .product-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border-color);
        }

        .product-details h6 {
            margin: 0;
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.9rem;
        }

        .product-sku {
            font-size: 0.75rem;
            color: var(--text-secondary);
            margin-top: 0.25rem;
        }

        .product-price {
            font-weight: 600;
            color: var(--text-primary);
        }

        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .status-inactive {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .status-out-of-stock {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .stock-badge {
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .stock-high {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .stock-medium {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .stock-low {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            border: 1px solid var(--border-color);
            background: var(--bg-secondary);
            color: var(--text-secondary);
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-action:hover {
            background: var(--bg-tertiary);
            color: var(--text-primary);
            transform: translateY(-1px);
        }

        .btn-edit:hover {
            background: rgba(34, 197, 94, 0.1);
            border-color: #22c55e;
            color: #22c55e;
        }

        .btn-delete:hover {
            background: rgba(239, 68, 68, 0.1);
            border-color: #ef4444;
            color: #ef4444;
        }

        /* Modal styles - Fixed transparency issues */
        .modal-backdrop {
            background-color: rgba(0, 0, 0, 0.8) !important;
        }

        .modal-content {
            background: var(--bg-primary) !important;
            border: 2px solid var(--border-color) !important;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.5) !important;
            border-radius: 12px !important;
        }

        .modal-header {
            border-bottom: 2px solid var(--border-color) !important;
            background: var(--bg-primary) !important;
            padding: 1.5rem !important;
        }

        .modal-body {
            background: var(--bg-primary) !important;
            padding: 1.5rem !important;
        }

        .modal-footer {
            border-top: 2px solid var(--border-color) !important;
            background: var(--bg-primary) !important;
            padding: 1.5rem !important;
        }

        .modal-title {
            color: var(--text-primary) !important;
            font-weight: 600 !important;
        }

        .alert {
            border: none !important;
            border-radius: 8px !important;
            padding: 1rem !important;
            margin-bottom: 1rem !important;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.2) !important;
            color: #dc3545 !important;
            border: 1px solid rgba(239, 68, 68, 0.3) !important;
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.2) !important;
            color: #0d6efd !important;
            border: 1px solid rgba(59, 130, 246, 0.3) !important;
        }

        .product-preview {
            background: var(--bg-secondary) !important;
            border: 2px solid var(--border-color) !important;
            border-radius: 8px !important;
            padding: 1rem !important;
        }

        /* Dark mode modal adjustments */
        [data-theme="dark"] .modal-content {
            background: #1a1d29 !important;
            border: 2px solid #2d3748 !important;
        }

        [data-theme="dark"] .modal-header,
        [data-theme="dark"] .modal-body,
        [data-theme="dark"] .modal-footer {
            background: #1a1d29 !important;
        }

        [data-theme="dark"] .product-preview {
            background: #2d3748 !important;
            border: 2px solid #4a5568 !important;
        }

        /* Filters card */
        .filters-card {
            background: var(--bg-primary);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            margin-bottom: 1.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .table-filters {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-select,
            .filter-input {
                width: 100%;
            }

            .products-table {
                font-size: 0.875rem;
            }

            .product-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .product-image {
                width: 50px;
                height: 50px;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1" style="color: var(--text-primary);">Thùng rác sản phẩm</h1>
                <p class="text-muted mb-0">Quản lý các sản phẩm đã xóa</p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-danger" onclick="showEmptyTrashModal()">
                    <i class="bi bi-trash3"></i>
                    Làm trống thùng rác
                </button>
                <a href="/admin/products" class="btn btn-outline-primary">
                    <i class="bi bi-arrow-left"></i>
                    Quay lại danh sách
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm"
                    style="background: var(--bg-secondary); border: 1px solid var(--border-color) !important;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                                    <i class="bi bi-trash" style="color: var(--danger-color) !important;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="stat-value" style="color: var(--text-primary);">47</div>
                                <div class="stat-label" style="color: var(--text-secondary);">Sản phẩm trong thùng rác</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm"
                    style="background: var(--bg-secondary); border: 1px solid var(--border-color) !important;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                                    <i class="bi bi-clock-history" style="color: var(--warning-color) !important;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="stat-value" style="color: var(--text-primary);">12</div>
                                <div class="stat-label" style="color: var(--text-secondary);">Sắp xóa vĩnh viễn</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm"
                    style="background: var(--bg-secondary); border: 1px solid var(--border-color) !important;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="stat-icon bg-info bg-opacity-10 text-info">
                                    <i class="bi bi-calendar-week" style="color: var(--info-color) !important;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="stat-value" style="color: var(--text-primary);">7 ngày</div>
                                <div class="stat-label" style="color: var(--text-secondary);">Thời gian lưu trữ</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm"
                    style="background: var(--bg-secondary); border: 1px solid var(--border-color) !important;">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="stat-icon bg-success bg-opacity-10 text-success">
                                    <i class="bi bi-arrow-clockwise" style="color: var(--success-color) !important;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="stat-value" style="color: var(--text-primary);">156</div>
                                <div class="stat-label" style="color: var(--text-secondary);">Đã khôi phục tháng này</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters and Actions -->
        <div class="card border-0 shadow-sm mb-4"
            style="background: var(--bg-secondary); border: 1px solid var(--border-color) !important;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="d-flex gap-3">
                            <div class="form-group">
                                <label class="form-label small fw-medium" style="color: var(--text-secondary);">Lọc theo
                                    danh mục</label>
                                <select class="form-select form-select-sm"
                                    style="background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary);">
                                    <option value="">Tất cả danh mục</option>
                                    <option value="smartphones">Điện thoại</option>
                                    <option value="laptops">Laptop</option>
                                    <option value="tablets">Máy tính bảng</option>
                                    <option value="accessories">Phụ kiện</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label small fw-medium" style="color: var(--text-secondary);">Ngày
                                    xóa</label>
                                <select class="form-select form-select-sm"
                                    style="background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary);">
                                    <option value="">Tất cả</option>
                                    <option value="today">Hôm nay</option>
                                    <option value="week">7 ngày qua</option>
                                    <option value="month">30 ngày qua</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex justify-content-end gap-2">
                            <div class="input-group" style="max-width: 300px;">
                                <input type="text" class="form-control form-control-sm"
                                    placeholder="Tìm kiếm sản phẩm..."
                                    style="background: var(--bg-primary); border: 1px solid var(--border-color); color: var(--text-primary);">
                                <button class="btn btn-outline-secondary btn-sm" type="button">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                            <button class="btn btn-primary btn-sm" onclick="showBulkActionsModal()">
                                <i class="bi bi-check2-square"></i>
                                Thao tác hàng loạt
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="products-table-container">
            <div class="table-header">
                <h5 class="table-title">Danh sách sản phẩm đã xóa</h5>
            </div>
            <div class="table-responsive">
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="form-check-input" id="selectAll">
                            </th>
                            <th>Sản phẩm</th>
                            <th>SKU</th>
                            <th>Danh mục</th>
                            <th>Giá bán</th>
                            <th>Tồn kho</th>
                            <th>Ngày xóa</th>
                            <th>Xóa vĩnh viễn sau</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Product 1 -->
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="product-image me-3">
                                        <img src="https://via.placeholder.com/50x50/6c757d/ffffff?text=IMG" alt="Product"
                                            class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-medium" style="color: var(--text-primary);">iPhone 15 Pro
                                            Max</h6>
                                        <small style="color: var(--text-secondary);">Điện thoại cao cấp với chip A17
                                            Pro</small>
                                    </div>
                                </div>
                            </td>
                            <td style="color: var(--text-secondary);">IP15PM-001</td>
                            <td>
                                <span
                                    class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-20">
                                    Điện thoại
                                </span>
                            </td>
                            <td class="fw-medium" style="color: var(--text-primary);">29.990.000₫</td>
                            <td>
                                <span
                                    class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20">
                                    45 chiếc
                                </span>
                            </td>
                            <td style="color: var(--text-secondary);">28/07/2025</td>
                            <td>
                                <span
                                    class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20">
                                    5 ngày
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-success"
                                        onclick="restoreProduct(1)" title="Khôi phục">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="permanentDeleteProduct(1)" title="Xóa vĩnh viễn">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Product 2 -->
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="2">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="product-image me-3">
                                        <img src="https://via.placeholder.com/50x50/6c757d/ffffff?text=IMG" alt="Product"
                                            class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-medium" style="color: var(--text-primary);">MacBook Pro M3
                                        </h6>
                                        <small style="color: var(--text-secondary);">Laptop chuyên nghiệp với chip
                                            M3</small>
                                    </div>
                                </div>
                            </td>
                            <td style="color: var(--text-secondary);">MBP-M3-001</td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-20">
                                    Laptop
                                </span>
                            </td>
                            <td class="fw-medium" style="color: var(--text-primary);">45.990.000₫</td>
                            <td>
                                <span
                                    class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20">
                                    12 chiếc
                                </span>
                            </td>
                            <td style="color: var(--text-secondary);">26/07/2025</td>
                            <td>
                                <span
                                    class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20">
                                    3 ngày
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-success"
                                        onclick="restoreProduct(2)" title="Khôi phục">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="permanentDeleteProduct(2)" title="Xóa vĩnh viễn">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Product 3 -->
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="3">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="product-image me-3">
                                        <img src="https://via.placeholder.com/50x50/6c757d/ffffff?text=IMG" alt="Product"
                                            class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-medium" style="color: var(--text-primary);">AirPods Pro 2
                                        </h6>
                                        <small style="color: var(--text-secondary);">Tai nghe không dây cao cấp</small>
                                    </div>
                                </div>
                            </td>
                            <td style="color: var(--text-secondary);">APP2-001</td>
                            <td>
                                <span
                                    class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20">
                                    Phụ kiện
                                </span>
                            </td>
                            <td class="fw-medium" style="color: var(--text-primary);">6.990.000₫</td>
                            <td>
                                <span
                                    class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20">
                                    3 chiếc
                                </span>
                            </td>
                            <td style="color: var(--text-secondary);">25/07/2025</td>
                            <td>
                                <span
                                    class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-20">
                                    2 ngày
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-success"
                                        onclick="restoreProduct(3)" title="Khôi phục">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="permanentDeleteProduct(3)" title="Xóa vĩnh viễn">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Product 4 -->
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="4">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="product-image me-3">
                                        <img src="https://via.placeholder.com/50x50/6c757d/ffffff?text=IMG" alt="Product"
                                            class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-medium" style="color: var(--text-primary);">Samsung Galaxy
                                            Tab S9</h6>
                                        <small style="color: var(--text-secondary);">Máy tính bảng Android cao
                                            cấp</small>
                                    </div>
                                </div>
                            </td>
                            <td style="color: var(--text-secondary);">SGT-S9-001</td>
                            <td>
                                <span
                                    class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20">
                                    Máy tính bảng
                                </span>
                            </td>
                            <td class="fw-medium" style="color: var(--text-primary);">18.990.000₫</td>
                            <td>
                                <span
                                    class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-20">
                                    8 chiếc
                                </span>
                            </td>
                            <td style="color: var(--text-secondary);">24/07/2025</td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-20">
                                    6 ngày
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-success"
                                        onclick="restoreProduct(4)" title="Khôi phục">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="permanentDeleteProduct(4)" title="Xóa vĩnh viễn">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Product 5 -->
                        <tr style="border-bottom: 1px solid var(--border-color);">
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="5">
                                </div>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="product-image me-3">
                                        <img src="https://via.placeholder.com/50x50/6c757d/ffffff?text=IMG" alt="Product"
                                            class="rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                    </div>
                                    <div>
                                        <h6 class="mb-1 fw-medium" style="color: var(--text-primary);">Dell XPS 13
                                        </h6>
                                        <small style="color: var(--text-secondary);">Laptop ultrabook cao cấp</small>
                                    </div>
                                </div>
                            </td>
                            <td style="color: var(--text-secondary);">DXP-13-001</td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-20">
                                    Laptop
                                </span>
                            </td>
                            <td class="fw-medium" style="color: var(--text-primary);">32.990.000₫</td>
                            <td>
                                <span
                                    class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-20">
                                    2 chiếc
                                </span>
                            </td>
                            <td style="color: var(--text-secondary);">23/07/2025</td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-20">
                                    7 ngày
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn btn-sm btn-outline-success"
                                        onclick="restoreProduct(5)" title="Khôi phục">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                        onclick="permanentDeleteProduct(5)" title="Xóa vĩnh viễn">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted">
            Hiển thị 1-5 trong tổng số 47 sản phẩm
        </div>
        <nav>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled">
                    <a class="page-link" href="#"
                        style="background: var(--bg-secondary); border: 1px solid var(--border-color); color: var(--text-secondary);">Trước</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="#"
                        style="background: var(--primary-color); border: 1px solid var(--primary-color); color: white;">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#"
                        style="background: var(--bg-secondary); border: 1px solid var(--border-color); color: var(--text-primary);">2</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#"
                        style="background: var(--bg-secondary); border: 1px solid var(--border-color); color: var(--text-primary);">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="#"
                        style="background: var(--bg-secondary); border: 1px solid var(--border-color); color: var(--text-primary);">Sau</a>
                </li>
            </ul>
        </nav>
    </div>
    </div>

    <!-- Restore Product Modal -->
    <div class="modal fade" id="restoreModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-arrow-clockwise text-success me-2"></i>
                        Khôi phục sản phẩm
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Sản phẩm sẽ được khôi phục và hiển thị trở lại trong danh sách sản phẩm.
                    </div>
                    <p style="color: var(--text-primary);">Bạn có chắc chắn muốn khôi phục sản phẩm này không?</p>
                    <div class="product-preview">
                        <div class="d-flex align-items-center">
                            <img id="restoreProductImage" src="" alt="Product" class="rounded me-3"
                                style="width: 60px; height: 60px; object-fit: cover;">
                            <div>
                                <h6 class="mb-1" id="restoreProductName" style="color: var(--text-primary);"></h6>
                                <small id="restoreProductSKU" style="color: var(--text-secondary);"></small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-success" onclick="confirmRestore()">
                        <i class="bi bi-arrow-clockwise me-2"></i>
                        Khôi phục
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Permanent Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle text-danger me-2"></i>
                        Xóa vĩnh viễn sản phẩm
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Cảnh báo:</strong> Hành động này không thể hoàn tác!
                    </div>
                    <p style="color: var(--text-primary);">Sản phẩm sẽ bị xóa vĩnh viễn khỏi hệ thống và không thể khôi
                        phục.</p>
                    <div class="product-preview">
                        <div class="d-flex align-items-center">
                            <img id="deleteProductImage" src="" alt="Product" class="rounded me-3"
                                style="width: 60px; height: 60px; object-fit: cover;">
                            <div>
                                <h6 class="mb-1" id="deleteProductName" style="color: var(--text-primary);"></h6>
                                <small id="deleteProductSKU" style="color: var(--text-secondary);"></small>
                            </div>
                        </div>
                    </div>
                    <div class="form-check mt-3">
                        <input class="form-check-input" type="checkbox" id="confirmDeleteCheck">
                        <label class="form-check-label" for="confirmDeleteCheck" style="color: var(--text-primary);">
                            Tôi hiểu rằng hành động này không thể hoàn tác
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn" onclick="confirmDelete()"
                        disabled>
                        <i class="bi bi-trash3 me-2"></i>
                        Xóa vĩnh viễn
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Empty Trash Modal -->
    <div class="modal fade" id="emptyTrashModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-trash3 text-danger me-2"></i>
                        Làm trống thùng rác
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Cảnh báo nghiêm trọng:</strong> Tất cả sản phẩm trong thùng rác sẽ bị xóa vĩnh viễn!
                    </div>
                    <p style="color: var(--text-primary);">Bạn sắp xóa vĩnh viễn <strong>47 sản phẩm</strong> khỏi thùng
                        rác. Hành động này không thể hoàn tác.</p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="confirmEmptyCheck">
                        <label class="form-check-label" for="confirmEmptyCheck" style="color: var(--text-primary);">
                            Tôi hiểu rằng tất cả sản phẩm sẽ bị xóa vĩnh viễn và không thể khôi phục
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="button" class="btn btn-danger" id="confirmEmptyBtn" onclick="confirmEmptyTrash()"
                        disabled>
                        <i class="bi bi-trash3 me-2"></i>
                        Làm trống thùng rác
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bulk Actions Modal -->
    <div class="modal fade" id="bulkActionsModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-check2-square me-2"></i>
                        Thao tác hàng loạt
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p style="color: var(--text-primary);">Chọn thao tác bạn muốn thực hiện với các sản phẩm đã chọn:</p>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-success" onclick="bulkRestore()">
                            <i class="bi bi-arrow-clockwise me-2"></i>
                            Khôi phục các sản phẩm đã chọn
                        </button>
                        <button class="btn btn-outline-danger" onclick="bulkDelete()">
                            <i class="bi bi-trash3 me-2"></i>
                            Xóa vĩnh viễn các sản phẩm đã chọn
                        </button>
                    </div>
                    <div class="mt-3 p-3 rounded"
                        style="background: var(--bg-secondary); border: 2px solid var(--border-color);">
                        <small style="color: var(--text-secondary);">
                            <i class="bi bi-info-circle me-1"></i>
                            Chọn các sản phẩm trong danh sách trước khi thực hiện thao tác hàng loạt.
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Stats Icons */
        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0;
        }

        /* Product Image */
        .product-image img {
            transition: transform 0.2s ease;
        }

        .product-image img:hover {
            transform: scale(1.05);
        }

        /* Buttons */
        .btn-group .btn {
            border-width: 1px;
            font-size: 0.875rem;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
        }

        /* Table hover effect */
        .table-hover tbody tr:hover {
            background-color: var(--bg-tertiary) !important;
        }

        /* Form controls */
        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(var(--primary-color-rgb), 0.25);
        }

        /* Badges */
        .badge {
            font-size: 0.75rem;
            padding: 0.35em 0.65em;
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .d-flex.gap-3 {
                flex-direction: column;
                gap: 1rem !important;
            }

            .d-flex.justify-content-end.gap-2 {
                flex-direction: column;
                gap: 1rem !important;
            }

            .input-group {
                max-width: 100% !important;
            }

            .table-responsive {
                font-size: 0.875rem;
            }

            .btn-group {
                display: flex;
                flex-direction: column;
            }

            .btn-group .btn {
                border-radius: 0.375rem !important;
                margin-bottom: 0.25rem;
            }

            .stat-value {
                font-size: 1.5rem;
            }
        }

        /* Dark mode specific adjustments */
        [data-theme="dark"] .table-hover tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }

        [data-theme="dark"] .form-control,
        [data-theme="dark"] .form-select {
            background-color: var(--bg-primary);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }

        [data-theme="dark"] .form-control::placeholder {
            color: var(--text-secondary);
        }

        /* Color variables for consistency */
        :root {
            --danger-color-10: rgba(220, 53, 69, 0.1);
            --info-color-10: rgba(13, 202, 240, 0.1);
            --success-color-10: rgba(25, 135, 84, 0.1);
            --warning-color-10: rgba(255, 193, 7, 0.1);
            --primary-color-10: rgba(13, 110, 253, 0.1);
        }

        [data-theme="dark"] {
            --danger-color-10: rgba(220, 53, 69, 0.15);
            --info-color-10: rgba(13, 202, 240, 0.15);
            --success-color-10: rgba(25, 135, 84, 0.15);
            --warning-color-10: rgba(255, 193, 7, 0.15);
            --primary-color-10: rgba(13, 110, 253, 0.15);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize modals
            const restoreModal = new bootstrap.Modal(document.getElementById('restoreModal'));
            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            const emptyTrashModal = new bootstrap.Modal(document.getElementById('emptyTrashModal'));
            const bulkActionsModal = new bootstrap.Modal(document.getElementById('bulkActionsModal'));

            // Variables to store current action data
            let currentProductId = null;

            // Select all checkbox functionality
            const selectAllCheckbox = document.getElementById('selectAll');
            const productCheckboxes = document.querySelectorAll('tbody input[type="checkbox"]');

            selectAllCheckbox.addEventListener('change', function() {
                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });

            // Individual checkbox change
            productCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    const checkedBoxes = document.querySelectorAll(
                        'tbody input[type="checkbox"]:checked');
                    selectAllCheckbox.checked = checkedBoxes.length === productCheckboxes.length;
                    selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes
                        .length < productCheckboxes.length;
                });
            });

            // Confirmation checkbox for delete
            const confirmDeleteCheck = document.getElementById('confirmDeleteCheck');
            const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

            confirmDeleteCheck.addEventListener('change', function() {
                confirmDeleteBtn.disabled = !this.checked;
            });

            // Confirmation checkbox for empty trash
            const confirmEmptyCheck = document.getElementById('confirmEmptyCheck');
            const confirmEmptyBtn = document.getElementById('confirmEmptyBtn');

            confirmEmptyCheck.addEventListener('change', function() {
                confirmEmptyBtn.disabled = !this.checked;
            });

            // Reset modal states when closed
            document.getElementById('deleteModal').addEventListener('hidden.bs.modal', function() {
                confirmDeleteCheck.checked = false;
                confirmDeleteBtn.disabled = true;
            });

            document.getElementById('emptyTrashModal').addEventListener('hidden.bs.modal', function() {
                confirmEmptyCheck.checked = false;
                confirmEmptyBtn.disabled = true;
            });
        });

        // Product data for modals
        const productData = {
            1: {
                name: 'iPhone 15 Pro Max',
                sku: 'IP15PM-001',
                image: 'https://via.placeholder.com/60x60/6c757d/ffffff?text=IMG'
            },
            2: {
                name: 'MacBook Pro M3',
                sku: 'MBP-M3-001',
                image: 'https://via.placeholder.com/60x60/6c757d/ffffff?text=IMG'
            },
            3: {
                name: 'AirPods Pro 2',
                sku: 'APP2-001',
                image: 'https://via.placeholder.com/60x60/6c757d/ffffff?text=IMG'
            },
            4: {
                name: 'Samsung Galaxy Tab S9',
                sku: 'SGT-S9-001',
                image: 'https://via.placeholder.com/60x60/6c757d/ffffff?text=IMG'
            },
            5: {
                name: 'Dell XPS 13',
                sku: 'DXP-13-001',
                image: 'https://via.placeholder.com/60x60/6c757d/ffffff?text=IMG'
            }
        };

        // Show restore modal
        function restoreProduct(productId) {
            currentProductId = productId;
            const product = productData[productId];

            document.getElementById('restoreProductName').textContent = product.name;
            document.getElementById('restoreProductSKU').textContent = product.sku;
            document.getElementById('restoreProductImage').src = product.image;

            const restoreModal = new bootstrap.Modal(document.getElementById('restoreModal'));
            restoreModal.show();
        }

        // Show permanent delete modal
        function permanentDeleteProduct(productId) {
            currentProductId = productId;
            const product = productData[productId];

            document.getElementById('deleteProductName').textContent = product.name;
            document.getElementById('deleteProductSKU').textContent = product.sku;
            document.getElementById('deleteProductImage').src = product.image;

            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }

        // Show empty trash modal
        function showEmptyTrashModal() {
            const emptyTrashModal = new bootstrap.Modal(document.getElementById('emptyTrashModal'));
            emptyTrashModal.show();
        }

        // Show bulk actions modal
        function showBulkActionsModal() {
            const checkedBoxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
            if (checkedBoxes.length === 0) {
                showNotification('Vui lòng chọn ít nhất một sản phẩm', 'warning');
                return;
            }

            const bulkActionsModal = new bootstrap.Modal(document.getElementById('bulkActionsModal'));
            bulkActionsModal.show();
        }

        // Confirm restore
        function confirmRestore() {
            // Simulate API call
            setTimeout(() => {
                showNotification(`Đã khôi phục sản phẩm ${productData[currentProductId].name} thành công!`,
                    'success');

                // Remove row from table
                const row = document.querySelector(`input[value="${currentProductId}"]`).closest('tr');
                row.style.opacity = '0.5';
                setTimeout(() => row.remove(), 300);

                // Close modal
                const restoreModal = bootstrap.Modal.getInstance(document.getElementById('restoreModal'));
                restoreModal.hide();

                // Update stats
                updateStats();
            }, 500);
        }

        // Confirm delete
        function confirmDelete() {
            // Simulate API call
            setTimeout(() => {
                showNotification(`Đã xóa vĩnh viễn sản phẩm ${productData[currentProductId].name}!`, 'success');

                // Remove row from table
                const row = document.querySelector(`input[value="${currentProductId}"]`).closest('tr');
                row.style.opacity = '0.5';
                setTimeout(() => row.remove(), 300);

                // Close modal
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
                deleteModal.hide();

                // Update stats
                updateStats();
            }, 500);
        }

        // Confirm empty trash
        function confirmEmptyTrash() {
            // Simulate API call
            setTimeout(() => {
                showNotification('Đã làm trống thùng rác thành công!', 'success');

                // Remove all rows
                const tbody = document.querySelector('tbody');
                tbody.innerHTML =
                    '<tr><td colspan="9" class="text-center py-5" style="color: var(--text-secondary);">Thùng rác trống</td></tr>';

                // Close modal
                const emptyTrashModal = bootstrap.Modal.getInstance(document.getElementById('emptyTrashModal'));
                emptyTrashModal.hide();

                // Update stats to zero
                document.querySelectorAll('.stat-value').forEach(stat => {
                    stat.textContent = '0';
                });
            }, 500);
        }

        // Bulk restore
        function bulkRestore() {
            const checkedBoxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
            const count = checkedBoxes.length;

            if (count === 0) {
                showNotification('Vui lòng chọn ít nhất một sản phẩm', 'warning');
                return;
            }

            // Simulate API call
            setTimeout(() => {
                showNotification(`Đã khôi phục ${count} sản phẩm thành công!`, 'success');

                // Remove selected rows
                checkedBoxes.forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    row.style.opacity = '0.5';
                    setTimeout(() => row.remove(), 300);
                });

                // Close modal
                const bulkActionsModal = bootstrap.Modal.getInstance(document.getElementById('bulkActionsModal'));
                bulkActionsModal.hide();

                // Update stats
                updateStats();
            }, 500);
        }

        // Bulk delete
        function bulkDelete() {
            const checkedBoxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
            const count = checkedBoxes.length;

            if (count === 0) {
                showNotification('Vui lòng chọn ít nhất một sản phẩm', 'warning');
                return;
            }

            if (!confirm(
                    `Bạn có chắc chắn muốn xóa vĩnh viễn ${count} sản phẩm đã chọn? Hành động này không thể hoàn tác!`)) {
                return;
            }

            // Simulate API call
            setTimeout(() => {
                showNotification(`Đã xóa vĩnh viễn ${count} sản phẩm!`, 'success');

                // Remove selected rows
                checkedBoxes.forEach(checkbox => {
                    const row = checkbox.closest('tr');
                    row.style.opacity = '0.5';
                    setTimeout(() => row.remove(), 300);
                });

                // Close modal
                const bulkActionsModal = bootstrap.Modal.getInstance(document.getElementById('bulkActionsModal'));
                bulkActionsModal.hide();

                // Update stats
                updateStats();
            }, 500);
        }

        // Update statistics
        function updateStats() {
            const remainingRows = document.querySelectorAll('tbody tr').length;
            document.querySelector('.stat-value').textContent = Math.max(0, remainingRows);
        }

        // Notification function
        function showNotification(message, type = 'info') {
            // Create notification element
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            notification.style.cssText = `
        top: 20px;
        right: 20px;
        z-index: 9999;
        max-width: 400px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border: none;
        animation: slideInRight 0.3s ease-out;
    `;

            notification.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="bi bi-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'} me-2"></i>
            ${message}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

            document.body.appendChild(notification);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.remove();
                }
            }, 5000);
        }

        // Add slideInRight animation
        const style = document.createElement('style');
        style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
`;
        document.head.appendChild(style);
    </script>
@endsection
