@extends('admin.layouts.app')

@section('title', 'Quản lý danh mục')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/categories/index.css') }}">
@endpush

@section('content')
    <div class="container-fluid p-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Danh mục</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="category-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-2">Quản Lý Danh Mục</h1>
                    <p class="text-muted mb-0">Quản lý tất cả danh mục sản phẩm trong cửa hàng</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.categories.tree') }}" class="btn btn-outline-primary">
                        <i class="bi bi-diagram-3 me-2"></i>Xem cây danh mục
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>Thêm Danh Mục
                    </a>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="category-stats">
            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="bi bi-tags text-primary"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">24</div>
                        <div class="stat-label">Tổng danh mục</div>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="bi bi-eye text-success"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">22</div>
                        <div class="stat-label">Đang hiển thị</div>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="bi bi-eye-slash text-warning"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">2</div>
                        <div class="stat-label">Đang ẩn</div>
                    </div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-content">
                    <div class="stat-icon">
                        <i class="bi bi-box text-info"></i>
                    </div>
                    <div class="stat-details">
                        <div class="stat-value">1,247</div>
                        <div class="stat-label">Tổng sản phẩm</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters Section --}}
        <div class="filters-section">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex gap-3">
                        <div class="filter-group">
                            <label class="filter-label">Trạng thái</label>
                            <select class="form-select form-select-sm">
                                <option value="">Tất cả</option>
                                <option value="active">Đang hiển thị</option>
                                <option value="inactive">Đang ẩn</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label class="filter-label">Cấp danh mục</label>
                            <select class="form-select form-select-sm">
                                <option value="">Tất cả</option>
                                <option value="parent">Danh mục cha</option>
                                <option value="child">Danh mục con</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end gap-2">
                        <div class="search-group">
                            <input type="text" class="form-control form-control-sm" placeholder="Tìm kiếm danh mục...">
                            <button class="btn btn-outline-secondary btn-sm" type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        <button class="btn btn-primary btn-sm">
                            <i class="bi bi-funnel"></i>
                            Lọc
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Categories Table --}}
        <div class="categories-table-container">
            <div class="table-header">
                <h5 class="table-title">Danh sách danh mục</h5>
                <div class="table-actions">
                    <button class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-arrow-clockwise"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-secondary">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="categories-table">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="form-check-input" id="selectAll">
                            </th>
                            <th>Danh mục</th>
                            <th>Danh mục cha</th>
                            <th>Số sản phẩm</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Category 1 --}}
                        <tr>
                            <td>
                                <input class="form-check-input" type="checkbox" value="1">
                            </td>
                            <td>
                                <div class="category-info">
                                    <div class="category-icon">
                                        <i class="bi bi-phone text-primary"></i>
                                    </div>
                                    <div class="category-details">
                                        <h6 class="category-name">Điện thoại</h6>
                                        <small class="category-slug">/dien-thoai</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="parent-category">-</span>
                            </td>
                            <td>
                                <span class="product-count">347</span>
                            </td>
                            <td>
                                <span class="status-badge status-active">
                                    <i class="bi bi-check-circle"></i>
                                    Hiển thị
                                </span>
                            </td>
                            <td>
                                <span class="created-date">15/07/2025</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/categories/1/edit" class="btn btn-sm btn-outline-primary"
                                        title="Chỉnh sửa">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/admin/categories/1" class="btn btn-sm btn-outline-info"
                                        title="Xem chi tiết">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Xóa"
                                        onclick="deleteCategory(1)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Category 2 --}}
                        <tr>
                            <td>
                                <input class="form-check-input" type="checkbox" value="2">
                            </td>
                            <td>
                                <div class="category-info">
                                    <div class="category-icon">
                                        <i class="bi bi-laptop text-info"></i>
                                    </div>
                                    <div class="category-details">
                                        <h6 class="category-name">Laptop</h6>
                                        <small class="category-slug">/laptop</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="parent-category">-</span>
                            </td>
                            <td>
                                <span class="product-count">156</span>
                            </td>
                            <td>
                                <span class="status-badge status-active">
                                    <i class="bi bi-check-circle"></i>
                                    Hiển thị
                                </span>
                            </td>
                            <td>
                                <span class="created-date">15/07/2025</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/categories/2/edit" class="btn btn-sm btn-outline-primary"
                                        title="Chỉnh sửa">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/admin/categories/2" class="btn btn-sm btn-outline-info"
                                        title="Xem chi tiết">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Xóa"
                                        onclick="deleteCategory(2)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Category 3 - Child Category --}}
                        <tr>
                            <td>
                                <input class="form-check-input" type="checkbox" value="3">
                            </td>
                            <td>
                                <div class="category-info">
                                    <div class="category-icon sub-category">
                                        <i class="bi bi-phone text-primary"></i>
                                    </div>
                                    <div class="category-details">
                                        <h6 class="category-name sub-category">iPhone</h6>
                                        <small class="category-slug">/dien-thoai/iphone</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="parent-category">Điện thoại</span>
                            </td>
                            <td>
                                <span class="product-count">89</span>
                            </td>
                            <td>
                                <span class="status-badge status-active">
                                    <i class="bi bi-check-circle"></i>
                                    Hiển thị
                                </span>
                            </td>
                            <td>
                                <span class="created-date">16/07/2025</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/categories/3/edit" class="btn btn-sm btn-outline-primary"
                                        title="Chỉnh sửa">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/admin/categories/3" class="btn btn-sm btn-outline-info"
                                        title="Xem chi tiết">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Xóa"
                                        onclick="deleteCategory(3)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Category 4 --}}
                        <tr>
                            <td>
                                <input class="form-check-input" type="checkbox" value="4">
                            </td>
                            <td>
                                <div class="category-info">
                                    <div class="category-icon">
                                        <i class="bi bi-tablet text-success"></i>
                                    </div>
                                    <div class="category-details">
                                        <h6 class="category-name">Máy tính bảng</h6>
                                        <small class="category-slug">/may-tinh-bang</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="parent-category">-</span>
                            </td>
                            <td>
                                <span class="product-count">78</span>
                            </td>
                            <td>
                                <span class="status-badge status-active">
                                    <i class="bi bi-check-circle"></i>
                                    Hiển thị
                                </span>
                            </td>
                            <td>
                                <span class="created-date">17/07/2025</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/categories/4/edit" class="btn btn-sm btn-outline-primary"
                                        title="Chỉnh sửa">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/admin/categories/4" class="btn btn-sm btn-outline-info"
                                        title="Xem chi tiết">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Xóa"
                                        onclick="deleteCategory(4)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Category 5 - Inactive --}}
                        <tr>
                            <td>
                                <input class="form-check-input" type="checkbox" value="5">
                            </td>
                            <td>
                                <div class="category-info">
                                    <div class="category-icon">
                                        <i class="bi bi-headphones text-warning"></i>
                                    </div>
                                    <div class="category-details">
                                        <h6 class="category-name">Phụ kiện âm thanh</h6>
                                        <small class="category-slug">/phu-kien-am-thanh</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="parent-category">-</span>
                            </td>
                            <td>
                                <span class="product-count">234</span>
                            </td>
                            <td>
                                <span class="status-badge status-inactive">
                                    <i class="bi bi-eye-slash"></i>
                                    Đang ẩn
                                </span>
                            </td>
                            <td>
                                <span class="created-date">18/07/2025</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="/admin/categories/5/edit" class="btn btn-sm btn-outline-primary"
                                        title="Chỉnh sửa">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/admin/categories/5" class="btn btn-sm btn-outline-info"
                                        title="Xem chi tiết">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-danger" title="Xóa"
                                        onclick="deleteCategory(5)">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="pagination-container">
            <div class="pagination-info">
                Hiển thị <strong>1-5</strong> trong tổng số <strong>24</strong> danh mục
            </div>
            <div class="pagination-nav">
                <a href="#" class="page-btn" title="Trang trước">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <a href="#" class="page-btn active">1</a>
                <a href="#" class="page-btn">2</a>
                <a href="#" class="page-btn">3</a>
                <a href="#" class="page-btn">...</a>
                <a href="#" class="page-btn">5</a>
                <a href="#" class="page-btn" title="Trang sau">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/admin/categories/index.js') }}"></script>
    @endpush
@endsection
