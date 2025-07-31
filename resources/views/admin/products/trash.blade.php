@extends('admin.layouts.app')

@section('title', 'Thùng rác sản phẩm')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/products/trash.css') }}">
@endpush

@section('content')
    <div class="container-fluid p-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/products">Sản Phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Thùng rác</li>
            </ol>
        </nav>
        <!-- Header Section -->
        <div class="trash-header">
            <div class="d-flex justify-content-between align-items-center">
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
                                        <img src="{{ asset('storage/products/product-4.png') }}" alt="Product"
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
                                        <img src="{{ asset('storage/products/product-2.png') }}" alt="Product"
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
                                        <img src="{{ asset('storage/products/product-3.png') }}" alt="Product"
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
                                        <img src="{{ asset('storage/products/product-4.png') }}" alt="Product"
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
                                        <img src="{{ asset('storage/products/product-5.png') }}" alt="Product"
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

    {{-- Pagination - Phân trang --}}
    <div class="pagination-container">
        <div class="pagination-info">
            Hiển thị <strong>1-5</strong> trong tổng số <strong>47</strong> sản phẩm đã xóa
        </div>
        <div class="pagination-nav">
            <a href="#" class="page-btn" title="Trang trước">
                <i class="bi bi-chevron-left"></i>
            </a>
            <a href="#" class="page-btn active">1</a>
            <a href="#" class="page-btn">2</a>
            <a href="#" class="page-btn">3</a>
            <a href="#" class="page-btn">...</a>
            <a href="#" class="page-btn">10</a>
            <a href="#" class="page-btn" title="Trang sau">
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
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

@endsection
@push('scripts')
    <script src="{{ asset('js/admin/products/trash.js') }}"></script>
@endpush
