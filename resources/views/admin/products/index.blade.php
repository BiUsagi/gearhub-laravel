@extends('admin.layouts.app')

@section('title', 'Quản lý sản phẩm')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Sản phẩm</li>
@endsection

@section('content')
    <div class="products-container">
        <!-- Page Header -->
        <div class="page-header mb-4">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="page-title">Quản lý sản phẩm</h1>
                    <p class="page-subtitle">Quản lý danh sách sản phẩm và thông tin chi tiết</p>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <div class="page-actions">
                        <button class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#importModal">
                            <i class="bi bi-upload me-2"></i>
                            Nhập Excel
                        </button>
                        <button class="btn btn-outline-secondary me-2" onclick="adminDashboard.exportData('products')">
                            <i class="bi bi-download me-2"></i>
                            Xuất Excel
                        </button>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>
                            Thêm sản phẩm
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="filters-card mb-4">
            <div class="card-body">
                <form class="filters-form" id="filtersForm">
                    <div class="row g-3">
                        <div class="col-lg-3 col-md-6">
                            <label class="form-label">Tìm kiếm</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Tên sản phẩm, SKU..."
                                    name="search">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label">Danh mục</label>
                            <select class="form-select" name="category">
                                <option value="">Tất cả</option>
                                <option value="1">Laptop</option>
                                <option value="2">Điện thoại</option>
                                <option value="3">Phụ kiện</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label">Thương hiệu</label>
                            <select class="form-select" name="brand">
                                <option value="">Tất cả</option>
                                <option value="1">Apple</option>
                                <option value="2">Samsung</option>
                                <option value="3">Dell</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label">Trạng thái</label>
                            <select class="form-select" name="status">
                                <option value="">Tất cả</option>
                                <option value="active">Hoạt động</option>
                                <option value="inactive">Tạm ngưng</option>
                                <option value="out_of_stock">Hết hàng</option>
                            </select>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <label class="form-label">Sắp xếp</label>
                            <select class="form-select" name="sort">
                                <option value="name_asc">Tên A-Z</option>
                                <option value="name_desc">Tên Z-A</option>
                                <option value="price_asc">Giá thấp → cao</option>
                                <option value="price_desc">Giá cao → thấp</option>
                                <option value="created_desc">Mới nhất</option>
                            </select>
                        </div>
                        <div class="col-lg-1 col-md-12">
                            <label class="form-label">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-outline-secondary flex-fill" onclick="resetFilters()">
                                    <i class="bi bi-x-lg"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Products Table -->
        <div class="table-card">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="table-info">
                        <h6 class="mb-0">Danh sách sản phẩm</h6>
                        <small class="text-muted">Hiển thị 1-10 trong tổng số 156 sản phẩm</small>
                    </div>
                    <div class="table-actions">
                        <div class="btn-group" role="group">
                            <input type="checkbox" class="btn-check" id="selectAll">
                            <label class="btn btn-outline-secondary btn-sm" for="selectAll">
                                <i class="bi bi-check-square"></i>
                            </label>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="dropdown">
                                Tác vụ hàng loạt
                                <i class="bi bi-chevron-down ms-1"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="bulkAction('activate')">
                                        <i class="bi bi-check-circle me-2"></i>Kích hoạt
                                    </a></li>
                                <li><a class="dropdown-item" href="#" onclick="bulkAction('deactivate')">
                                        <i class="bi bi-x-circle me-2"></i>Tạm ngưng
                                    </a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item text-danger" href="#" onclick="bulkAction('delete')">
                                        <i class="bi bi-trash me-2"></i>Xóa
                                    </a></li>
                            </ul>
                        </div>
                        <button class="btn btn-outline-secondary btn-sm" onclick="location.reload()">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover products-table">
                        <thead>
                            <tr>
                                <th width="40">
                                    <input type="checkbox" class="form-check-input" id="checkAll">
                                </th>
                                <th width="80">Hình ảnh</th>
                                <th>Sản phẩm</th>
                                <th width="120">SKU</th>
                                <th width="100">Danh mục</th>
                                <th width="100">Giá bán</th>
                                <th width="80">Kho</th>
                                <th width="100">Trạng thái</th>
                                <th width="120">Ngày tạo</th>
                                <th width="100">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Product Row 1 -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input product-check" value="1">
                                </td>
                                <td>
                                    <div class="product-image">
                                        <img src="{{ asset('storage/products/macbook-pro.jpg') }}" alt="MacBook Pro M3"
                                            class="img-fluid rounded">
                                    </div>
                                </td>
                                <td>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">MacBook Pro M3 14inch</h6>
                                        <small class="text-muted">Apple</small>
                                        <div class="product-rating mt-1">
                                            <div class="stars">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </div>
                                            <small class="text-muted ms-1">(4.8)</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <code class="text-primary">MBP-M3-14</code>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">Laptop</span>
                                </td>
                                <td>
                                    <div class="price-info">
                                        <div class="current-price fw-bold">₫52,990,000</div>
                                        <div class="original-price text-muted text-decoration-line-through">₫54,990,000
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="stock-info">
                                        <span class="stock-number fw-bold text-success">25</span>
                                        <small class="text-muted d-block">Còn hàng</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-success">Hoạt động</span>
                                </td>
                                <td>
                                    <div class="date-info">
                                        <div>15/12/2024</div>
                                        <small class="text-muted">10:30</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                            title="Xem chi tiết">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip"
                                            title="Chỉnh sửa">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">
                                                        <i class="bi bi-files me-2"></i>Nhân bản
                                                    </a></li>
                                                <li><a class="dropdown-item" href="#">
                                                        <i class="bi bi-archive me-2"></i>Lưu trữ
                                                    </a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger" href="#">
                                                        <i class="bi bi-trash me-2"></i>Xóa
                                                    </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Product Row 2 -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input product-check" value="2">
                                </td>
                                <td>
                                    <div class="product-image">
                                        <img src="{{ asset('storage/products/iphone-15.jpg') }}" alt="iPhone 15 Pro Max"
                                            class="img-fluid rounded">
                                    </div>
                                </td>
                                <td>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">iPhone 15 Pro Max 256GB</h6>
                                        <small class="text-muted">Apple</small>
                                        <div class="product-rating mt-1">
                                            <div class="stars">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star text-warning"></i>
                                            </div>
                                            <small class="text-muted ms-1">(4.6)</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <code class="text-primary">IP15-PM-256</code>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">Điện thoại</span>
                                </td>
                                <td>
                                    <div class="price-info">
                                        <div class="current-price fw-bold">₫32,990,000</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="stock-info">
                                        <span class="stock-number fw-bold text-warning">5</span>
                                        <small class="text-muted d-block">Sắp hết</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-success">Hoạt động</span>
                                </td>
                                <td>
                                    <div class="date-info">
                                        <div>14/12/2024</div>
                                        <small class="text-muted">14:20</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                            title="Xem chi tiết">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip"
                                            title="Chỉnh sửa">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">
                                                        <i class="bi bi-files me-2"></i>Nhân bản
                                                    </a></li>
                                                <li><a class="dropdown-item" href="#">
                                                        <i class="bi bi-archive me-2"></i>Lưu trữ
                                                    </a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger" href="#">
                                                        <i class="bi bi-trash me-2"></i>Xóa
                                                    </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Product Row 3 -->
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input product-check" value="3">
                                </td>
                                <td>
                                    <div class="product-image">
                                        <img src="{{ asset('storage/products/airpods-pro.jpg') }}" alt="AirPods Pro 2"
                                            class="img-fluid rounded">
                                    </div>
                                </td>
                                <td>
                                    <div class="product-info">
                                        <h6 class="product-name mb-1">AirPods Pro 2nd Generation</h6>
                                        <small class="text-muted">Apple</small>
                                        <div class="product-rating mt-1">
                                            <div class="stars">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </div>
                                            <small class="text-muted ms-1">(4.9)</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <code class="text-primary">APD-PRO-2G</code>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark">Phụ kiện</span>
                                </td>
                                <td>
                                    <div class="price-info">
                                        <div class="current-price fw-bold">₫6,490,000</div>
                                    </div>
                                </td>
                                <td>
                                    <div class="stock-info">
                                        <span class="stock-number fw-bold text-danger">0</span>
                                        <small class="text-muted d-block">Hết hàng</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-danger">Hết hàng</span>
                                </td>
                                <td>
                                    <div class="date-info">
                                        <div>13/12/2024</div>
                                        <small class="text-muted">09:15</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip"
                                            title="Xem chi tiết">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip"
                                            title="Chỉnh sửa">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <div class="dropdown d-inline">
                                            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#">
                                                        <i class="bi bi-files me-2"></i>Nhân bản
                                                    </a></li>
                                                <li><a class="dropdown-item" href="#">
                                                        <i class="bi bi-archive me-2"></i>Lưu trữ
                                                    </a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger" href="#">
                                                        <i class="bi bi-trash me-2"></i>Xóa
                                                    </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="card-footer">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="pagination-info">
                        <small class="text-muted">Hiển thị 1-10 trong tổng số 156 sản phẩm</small>
                    </div>
                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><span class="page-link">...</span></li>
                            <li class="page-item"><a class="page-link" href="#">16</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #1e293b;
        }

        .page-subtitle {
            color: #64748b;
            margin: 0;
        }

        .page-actions {
            display: flex;
            gap: 0.5rem;
        }

        .filters-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        }

        .table-card {
            background: white;
            border-radius: 12px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .product-image {
            width: 50px;
            height: 50px;
            overflow: hidden;
            border-radius: 8px;
            background: #f8fafc;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            min-width: 200px;
        }

        .product-name {
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 2px;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-rating .stars {
            display: inline-flex;
            gap: 1px;
        }

        .price-info .current-price {
            color: #059669;
            font-size: 14px;
        }

        .price-info .original-price {
            font-size: 12px;
            color: #64748b;
        }

        .stock-info .stock-number {
            font-size: 16px;
        }

        .date-info div {
            font-size: 14px;
            font-weight: 500;
        }

        .action-buttons {
            display: flex;
            gap: 4px;
            align-items: center;
        }

        .action-buttons .btn {
            width: 32px;
            height: 32px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .table thead th {
            background: #f8fafc;
            border-bottom: 2px solid #e2e8f0;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
        }

        .table tbody tr {
            border-bottom: 1px solid #f1f5f9;
        }

        .table tbody tr:hover {
            background: #fafbfc;
        }

        .badge {
            font-size: 11px;
            font-weight: 500;
            padding: 4px 8px;
        }

        @media (max-width: 768px) {
            .page-header .row {
                text-align: center;
            }

            .page-actions {
                justify-content: center;
                margin-top: 1rem;
            }

            .filters-form .row {
                gap: 0.5rem;
            }

            .table-responsive {
                font-size: 12px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 2px;
            }

            .product-name {
                font-size: 13px;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Bulk actions
        function bulkAction(action) {
            const checkedItems = document.querySelectorAll('.product-check:checked');
            if (checkedItems.length === 0) {
                adminDashboard.showToast('Vui lòng chọn ít nhất một sản phẩm!', 'warning');
                return;
            }

            const productIds = Array.from(checkedItems).map(item => item.value);

            if (confirm(`Bạn có chắc muốn ${action} ${productIds.length} sản phẩm đã chọn?`)) {
                // Perform bulk action
                console.log('Bulk action:', action, 'Products:', productIds);
                adminDashboard.showToast(`Đã ${action} ${productIds.length} sản phẩm!`, 'success');
            }
        }

        // Reset filters
        function resetFilters() {
            document.getElementById('filtersForm').reset();
            // Reload table with reset filters
            location.reload();
        }

        // Select all functionality
        document.getElementById('checkAll').addEventListener('change', function() {
            const productChecks = document.querySelectorAll('.product-check');
            productChecks.forEach(check => {
                check.checked = this.checked;
            });
        });

        // Filter form submission
        document.getElementById('filtersForm').addEventListener('submit', function(e) {
            e.preventDefault();
            // Handle filter submission
            console.log('Applying filters...');
            adminDashboard.showToast('Đang áp dụng bộ lọc...', 'info');
        });
    </script>
@endsection
