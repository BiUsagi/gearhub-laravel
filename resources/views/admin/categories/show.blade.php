@extends('admin.layouts.app')

@section('title', 'Chi tiết danh mục')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/categories/create.css') }}">
@endpush

@section('content')
    <div class="container-fluid p-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/categories">Danh mục</a></li>
                <li class="breadcrumb-item active" aria-current="page">Chi tiết danh mục</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">Chi Tiết Danh Mục</h1>
                    <p class="page-subtitle">Thông tin chi tiết và thống kê danh mục</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="/admin/categories" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Quay lại
                    </a>
                    <a href="/admin/categories/1/edit" class="btn btn-primary">
                        <i class="bi bi-pencil"></i>
                        Chỉnh sửa
                    </a>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8">
                {{-- Basic Information --}}
                <div class="form-section">
                    <div class="section-header">
                        <h5 class="section-title">
                            <i class="bi bi-info-circle text-primary me-2"></i>
                            Thông tin cơ bản
                        </h5>
                    </div>
                    <div class="section-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <label class="info-label">Tên danh mục</label>
                                    <div class="info-value">Điện thoại</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <label class="info-label">Đường dẫn (Slug)</label>
                                    <div class="info-value">
                                        <code>/dien-thoai</code>
                                        <button class="btn btn-sm btn-outline-secondary ms-2"
                                            onclick="copyToClipboard('/dien-thoai')">
                                            <i class="bi bi-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="info-group">
                            <label class="info-label">Mô tả danh mục</label>
                            <div class="info-value">Danh mục chứa các sản phẩm điện thoại di động từ nhiều thương hiệu khác
                                nhau như iPhone, Samsung, Xiaomi, Oppo, Vivo và các thương hiệu khác. Cung cấp đa dạng sản
                                phẩm từ phân khúc giá rẻ đến cao cấp.</div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-group">
                                    <label class="info-label">Danh mục cha</label>
                                    <div class="info-value">
                                        <span class="badge bg-light text-dark">Danh mục gốc</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-group">
                                    <label class="info-label">Thứ tự hiển thị</label>
                                    <div class="info-value">1</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- SEO Information --}}
                <div class="form-section">
                    <div class="section-header">
                        <h5 class="section-title">
                            <i class="bi bi-search text-info me-2"></i>
                            Thông tin SEO
                        </h5>
                    </div>
                    <div class="section-content">
                        <div class="info-group">
                            <label class="info-label">Meta Title</label>
                            <div class="info-value">Điện thoại di động chính hãng - GearHub</div>
                        </div>

                        <div class="info-group">
                            <label class="info-label">Meta Description</label>
                            <div class="info-value">Khám phá bộ sưu tập điện thoại di động chính hãng với giá tốt nhất.
                                iPhone, Samsung, Xiaomi và nhiều thương hiệu hàng đầu tại GearHub.</div>
                        </div>

                        <div class="info-group">
                            <label class="info-label">Meta Keywords</label>
                            <div class="info-value">
                                <span class="badge bg-primary me-1">điện thoại</span>
                                <span class="badge bg-primary me-1">smartphone</span>
                                <span class="badge bg-primary me-1">iPhone</span>
                                <span class="badge bg-primary me-1">Samsung</span>
                                <span class="badge bg-primary me-1">Xiaomi</span>
                                <span class="badge bg-primary me-1">di động</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Category Tree --}}
                <div class="form-section">
                    <div class="section-header">
                        <h5 class="section-title">
                            <i class="bi bi-diagram-3 text-success me-2"></i>
                            Cây danh mục con
                        </h5>
                    </div>
                    <div class="section-content">
                        <div class="tree-view">
                            <div class="tree-item active">
                                <i class="bi bi-phone text-primary me-2"></i>
                                <strong>Điện thoại</strong>
                                <span class="badge bg-success ms-2">347 sản phẩm</span>
                            </div>
                            <div class="tree-children">
                                <div class="tree-item">
                                    <span class="tree-spacer"></span>
                                    <i class="bi bi-phone text-success me-2"></i>
                                    <a href="/admin/categories/3">iPhone</a>
                                    <span class="badge bg-light text-dark ms-2">89 sản phẩm</span>
                                </div>
                                <div class="tree-item">
                                    <span class="tree-spacer"></span>
                                    <i class="bi bi-phone text-success me-2"></i>
                                    <a href="/admin/categories/5">Samsung</a>
                                    <span class="badge bg-light text-dark ms-2">156 sản phẩm</span>
                                </div>
                                <div class="tree-item">
                                    <span class="tree-spacer"></span>
                                    <i class="bi bi-phone text-success me-2"></i>
                                    <a href="/admin/categories/8">Xiaomi</a>
                                    <span class="badge bg-light text-dark ms-2">102 sản phẩm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recent Products --}}
                <div class="form-section">
                    <div class="section-header">
                        <h5 class="section-title">
                            <i class="bi bi-box text-warning me-2"></i>
                            Sản phẩm mới nhất
                        </h5>
                        <a href="/admin/products?category=1" class="btn btn-sm btn-outline-primary">
                            Xem tất cả
                        </a>
                    </div>
                    <div class="section-content">
                        <div class="product-list">
                            <div class="product-item">
                                <img src="/api/placeholder/60/60" alt="Product" class="product-image">
                                <div class="product-info">
                                    <h6 class="product-name">iPhone 15 Pro Max</h6>
                                    <p class="product-price">29.990.000 ₫</p>
                                    <span class="product-status badge bg-success">Còn hàng</span>
                                </div>
                                <div class="product-actions">
                                    <a href="/admin/products/1" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-item">
                                <img src="/api/placeholder/60/60" alt="Product" class="product-image">
                                <div class="product-info">
                                    <h6 class="product-name">Samsung Galaxy S24 Ultra</h6>
                                    <p class="product-price">26.990.000 ₫</p>
                                    <span class="product-status badge bg-success">Còn hàng</span>
                                </div>
                                <div class="product-actions">
                                    <a href="/admin/products/2" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-item">
                                <img src="/api/placeholder/60/60" alt="Product" class="product-image">
                                <div class="product-info">
                                    <h6 class="product-name">Xiaomi 14 Ultra</h6>
                                    <p class="product-price">24.990.000 ₫</p>
                                    <span class="product-status badge bg-warning text-dark">Sắp hết</span>
                                </div>
                                <div class="product-actions">
                                    <a href="/admin/products/3" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Status & Visibility --}}
                <div class="form-section">
                    <div class="section-header">
                        <h5 class="section-title">
                            <i class="bi bi-gear text-primary me-2"></i>
                            Trạng thái & Hiển thị
                        </h5>
                    </div>
                    <div class="section-content">
                        <div class="status-display">
                            <div class="status-item">
                                <label class="status-label">Trạng thái</label>
                                <div class="status-value">
                                    <span class="badge bg-success">
                                        <i class="bi bi-check-circle me-1"></i>
                                        Hoạt động
                                    </span>
                                </div>
                            </div>

                            <div class="status-item">
                                <label class="status-label">Hiển thị trong menu</label>
                                <div class="status-value">
                                    <span class="badge bg-success">
                                        <i class="bi bi-check me-1"></i>
                                        Có
                                    </span>
                                </div>
                            </div>

                            <div class="status-item">
                                <label class="status-label">Danh mục nổi bật</label>
                                <div class="status-value">
                                    <span class="badge bg-light text-dark">
                                        <i class="bi bi-x me-1"></i>
                                        Không
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Statistics --}}
                <div class="form-section">
                    <div class="section-header">
                        <h5 class="section-title">
                            <i class="bi bi-graph-up text-primary me-2"></i>
                            Thống kê
                        </h5>
                    </div>
                    <div class="section-content">
                        <div class="stats-grid">
                            <div class="stat-item">
                                <div class="stat-label">Tổng sản phẩm</div>
                                <div class="stat-value text-primary">347</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Sản phẩm active</div>
                                <div class="stat-value text-success">334</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Sản phẩm hết hàng</div>
                                <div class="stat-value text-danger">13</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-label">Danh mục con</div>
                                <div class="stat-value text-info">3</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Image Display --}}
                <div class="form-section">
                    <div class="section-header">
                        <h5 class="section-title">
                            <i class="bi bi-image text-primary me-2"></i>
                            Hình ảnh & Biểu tượng
                        </h5>
                    </div>
                    <div class="section-content">
                        <div class="image-display">
                            <div class="category-icon-large">
                                <i class="bi bi-phone"></i>
                            </div>
                            <div class="category-image">
                                <img src="/api/placeholder/300/200" alt="Category Image" class="img-fluid rounded">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Analytics Chart --}}
                <div class="form-section">
                    <div class="section-header">
                        <h5 class="section-title">
                            <i class="bi bi-bar-chart text-info me-2"></i>
                            Thống kê theo tháng
                        </h5>
                    </div>
                    <div class="section-content">
                        <div class="analytics-summary">
                            <div class="analytics-item">
                                <div class="analytics-label">Lượt xem tháng này</div>
                                <div class="analytics-value text-info">12,547</div>
                                <div class="analytics-change text-success">
                                    <i class="bi bi-arrow-up"></i> +12.5%
                                </div>
                            </div>
                            <div class="analytics-item">
                                <div class="analytics-label">Đơn hàng tháng này</div>
                                <div class="analytics-value text-warning">89</div>
                                <div class="analytics-change text-success">
                                    <i class="bi bi-arrow-up"></i> +8.3%
                                </div>
                            </div>
                            <div class="analytics-item">
                                <div class="analytics-label">Doanh thu tháng này</div>
                                <div class="analytics-value text-primary">2,450,000,000 ₫</div>
                                <div class="analytics-change text-success">
                                    <i class="bi bi-arrow-up"></i> +15.2%
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="form-section">
                    <div class="section-header">
                        <h5 class="section-title">
                            <i class="bi bi-lightning text-warning me-2"></i>
                            Thao tác nhanh
                        </h5>
                    </div>
                    <div class="section-content">
                        <div class="d-grid gap-2">
                            <a href="/admin/categories/1/edit" class="btn btn-primary">
                                <i class="bi bi-pencil me-2"></i>
                                Chỉnh sửa danh mục
                            </a>
                            <a href="/admin/categories/create?parent=1" class="btn btn-outline-success">
                                <i class="bi bi-plus me-2"></i>
                                Thêm danh mục con
                            </a>
                            <a href="/admin/products?category=1" class="btn btn-outline-info">
                                <i class="bi bi-box me-2"></i>
                                Xem sản phẩm
                            </a>
                            <button class="btn btn-outline-danger" onclick="deleteCategory(1)">
                                <i class="bi bi-trash me-2"></i>
                                Xóa danh mục
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Meta Information --}}
                <div class="form-section">
                    <div class="section-header">
                        <h5 class="section-title">
                            <i class="bi bi-info-square text-secondary me-2"></i>
                            Thông tin hệ thống
                        </h5>
                    </div>
                    <div class="section-content">
                        <div class="meta-info">
                            <div class="meta-item">
                                <label>ID danh mục:</label>
                                <span>#1</span>
                            </div>
                            <div class="meta-item">
                                <label>Ngày tạo:</label>
                                <span>15/07/2025 10:30</span>
                            </div>
                            <div class="meta-item">
                                <label>Cập nhật lần cuối:</label>
                                <span>29/07/2025 14:20</span>
                            </div>
                            <div class="meta-item">
                                <label>Người tạo:</label>
                                <span>Admin User</span>
                            </div>
                            <div class="meta-item">
                                <label>Người cập nhật:</label>
                                <span>Admin User</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Additional styles for show page */
        .info-group {
            margin-bottom: 1.5rem;
        }

        .info-label {
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
            display: block;
        }

        .info-value {
            color: var(--text-primary);
            line-height: 1.6;
        }

        .status-display .status-item {
            display: flex;
            justify-content: between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .status-display .status-item:last-child {
            border-bottom: none;
        }

        .status-label {
            font-weight: 500;
            color: var(--text-secondary);
        }

        .tree-view {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 1rem;
        }

        .tree-item {
            padding: 0.5rem 0;
            display: flex;
            align-items: center;
        }

        .tree-item.active {
            background: var(--bg-light);
            padding: 0.75rem;
            border-radius: 6px;
            margin-bottom: 0.5rem;
        }

        .tree-spacer {
            width: 24px;
            height: 1px;
            background: var(--border-color);
            margin-right: 0.5rem;
        }

        .product-list {
            border: 1px solid var(--border-color);
            border-radius: 8px;
        }

        .product-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .product-item:last-child {
            border-bottom: none;
        }

        .product-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 1rem;
        }

        .product-info {
            flex: 1;
        }

        .product-name {
            margin-bottom: 0.25rem;
            font-weight: 600;
        }

        .product-price {
            color: var(--primary-color);
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .image-display {
            text-align: center;
        }

        .category-icon-large {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .category-image img {
            max-width: 100%;
            height: auto;
        }

        .analytics-summary {
            space-y: 1rem;
        }

        .analytics-item {
            padding: 1rem;
            background: var(--bg-light);
            border-radius: 8px;
            margin-bottom: 1rem;
        }

        .analytics-label {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin-bottom: 0.25rem;
        }

        .analytics-value {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .analytics-change {
            font-size: 0.875rem;
            font-weight: 500;
        }

        .meta-info {
            background: var(--bg-light);
            border-radius: 8px;
            padding: 1rem;
        }

        .meta-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .meta-item:last-child {
            border-bottom: none;
        }

        .meta-item label {
            font-weight: 500;
            color: var(--text-secondary);
        }

        .meta-item span {
            color: var(--text-primary);
        }
    </style>

    @push('scripts')
        <script src="{{ asset('js/admin/categories/show.js') }}"></script>
    @endpush
@endsection
