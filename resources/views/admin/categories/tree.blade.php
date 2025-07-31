@extends('admin.layouts.app')

@section('title', 'Cây danh mục')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/categories/tree.css') }}">
@endpush

@section('content')
    <div class="container-fluid p-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/categories">Danh mục</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cây danh mục</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="tree-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-2">Cây Danh Mục Sản Phẩm</h1>
                    <p class="text-muted mb-0">Quản lý cấu trúc phân cấp danh mục sản phẩm</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-secondary" onclick="expandAllCategories()">
                        <i class="bi bi-arrows-expand me-2"></i>Mở rộng tất cả
                    </button>
                    <button class="btn btn-outline-secondary" onclick="collapseAllCategories()">
                        <i class="bi bi-arrows-collapse me-2"></i>Thu gọn tất cả
                    </button>
                    <button class="btn btn-primary" onclick="showAddCategoryModal()">
                        <i class="bi bi-plus-lg me-2"></i>Thêm Danh Mục
                    </button>
                </div>
            </div>
        </div>

        {{-- Stats Section --}}
        <div class="tree-stats">
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="bi bi-diagram-3 text-primary"></i>
                </div>
                <div class="stat-details">
                    <span class="stat-value">24</span>
                    <span class="stat-label">Tổng danh mục</span>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="bi bi-diagram-2 text-success"></i>
                </div>
                <div class="stat-details">
                    <span class="stat-value">6</span>
                    <span class="stat-label">Danh mục gốc</span>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="bi bi-layers text-info"></i>
                </div>
                <div class="stat-details">
                    <span class="stat-value">3</span>
                    <span class="stat-label">Cấp độ tối đa</span>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon">
                    <i class="bi bi-box text-warning"></i>
                </div>
                <div class="stat-details">
                    <span class="stat-value">1,247</span>
                    <span class="stat-label">Tổng sản phẩm</span>
                </div>
            </div>
        </div>

        {{-- Tree Controls --}}
        <div class="tree-controls">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="d-flex gap-3 align-items-center">
                        <div class="form-group mb-0">
                            <select class="form-select form-select-sm" id="filterStatus">
                                <option value="">Tất cả trạng thái</option>
                                <option value="active">Đang hoạt động</option>
                                <option value="inactive">Tạm ẩn</option>
                            </select>
                        </div>
                        <div class="form-group mb-0">
                            <select class="form-select form-select-sm" id="sortBy">
                                <option value="name">Sắp xếp theo tên</option>
                                <option value="order">Sắp xếp theo thứ tự</option>
                                <option value="products">Sắp xếp theo số sản phẩm</option>
                                <option value="created">Sắp xếp theo ngày tạo</option>
                            </select>
                        </div>
                        <button class="btn btn-sm btn-outline-primary" onclick="refreshTree()">
                            <i class="bi bi-arrow-clockwise"></i>
                        </button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex justify-content-end gap-2">
                        <div class="search-box">
                            <input type="text" class="form-control form-control-sm" placeholder="Tìm kiếm danh mục..."
                                id="searchTree">
                            <i class="bi bi-search search-icon"></i>
                        </div>
                        <button class="btn btn-sm btn-outline-secondary" onclick="toggleTreeMode()">
                            <i class="bi bi-list-ul" id="treeModeIcon"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Category Tree --}}
        <div class="category-tree-container">
            <div class="tree-view" id="categoryTree">
                {{-- Root Category 1: Điện thoại --}}
                <div class="tree-node" data-category-id="1" data-level="0">
                    <div class="tree-item">
                        <div class="tree-handle">
                            <i class="bi bi-grip-vertical"></i>
                        </div>
                        <span class="tree-toggle" onclick="toggleTreeNode(this)">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                        <div class="tree-content">
                            <div class="category-icon">
                                <i class="bi bi-phone text-primary"></i>
                            </div>
                            <div class="category-info">
                                <h6 class="category-name">Điện thoại</h6>
                                <span class="category-slug">/dien-thoai</span>
                            </div>
                            <div class="category-meta">
                                <span class="product-count">347 sản phẩm</span>
                                <span class="status-badge active">
                                    <i class="bi bi-check-circle"></i>
                                </span>
                            </div>
                            <div class="tree-actions">
                                <button class="btn btn-sm btn-outline-primary" onclick="editCategory(1)"
                                    title="Chỉnh sửa">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" onclick="addSubCategory(1)"
                                    title="Thêm danh mục con">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" onclick="viewProducts(1)"
                                    title="Xem sản phẩm">
                                    <i class="bi bi-box"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(1)" title="Xóa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tree-children">
                        {{-- Child: iPhone --}}
                        <div class="tree-node" data-category-id="2" data-level="1">
                            <div class="tree-item">
                                <div class="tree-handle">
                                    <i class="bi bi-grip-vertical"></i>
                                </div>
                                <span class="tree-toggle" onclick="toggleTreeNode(this)">
                                    <i class="bi bi-chevron-down"></i>
                                </span>
                                <div class="tree-content">
                                    <div class="category-icon">
                                        <i class="bi bi-phone text-primary"></i>
                                    </div>
                                    <div class="category-info">
                                        <h6 class="category-name">iPhone</h6>
                                        <span class="category-slug">/dien-thoai/iphone</span>
                                    </div>
                                    <div class="category-meta">
                                        <span class="product-count">89 sản phẩm</span>
                                        <span class="status-badge active">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                    </div>
                                    <div class="tree-actions">
                                        <button class="btn btn-sm btn-outline-primary" onclick="editCategory(2)"
                                            title="Chỉnh sửa">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="addSubCategory(2)"
                                            title="Thêm danh mục con">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" onclick="viewProducts(2)"
                                            title="Xem sản phẩm">
                                            <i class="bi bi-box"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(2)"
                                            title="Xóa">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="tree-children">
                                {{-- Sub-child: iPhone 15 Series --}}
                                <div class="tree-node" data-category-id="3" data-level="2">
                                    <div class="tree-item">
                                        <div class="tree-handle">
                                            <i class="bi bi-grip-vertical"></i>
                                        </div>
                                        <span class="tree-spacer"></span>
                                        <div class="tree-content">
                                            <div class="category-icon">
                                                <i class="bi bi-phone text-primary"></i>
                                            </div>
                                            <div class="category-info">
                                                <h6 class="category-name">iPhone 15 Series</h6>
                                                <span class="category-slug">/dien-thoai/iphone/iphone-15</span>
                                            </div>
                                            <div class="category-meta">
                                                <span class="product-count">24 sản phẩm</span>
                                                <span class="status-badge active">
                                                    <i class="bi bi-check-circle"></i>
                                                </span>
                                            </div>
                                            <div class="tree-actions">
                                                <button class="btn btn-sm btn-outline-primary" onclick="editCategory(3)"
                                                    title="Chỉnh sửa">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-info" onclick="viewProducts(3)"
                                                    title="Xem sản phẩm">
                                                    <i class="bi bi-box"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(3)"
                                                    title="Xóa">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Sub-child: iPhone 14 Series --}}
                                <div class="tree-node" data-category-id="4" data-level="2">
                                    <div class="tree-item">
                                        <div class="tree-handle">
                                            <i class="bi bi-grip-vertical"></i>
                                        </div>
                                        <span class="tree-spacer"></span>
                                        <div class="tree-content">
                                            <div class="category-icon">
                                                <i class="bi bi-phone text-primary"></i>
                                            </div>
                                            <div class="category-info">
                                                <h6 class="category-name">iPhone 14 Series</h6>
                                                <span class="category-slug">/dien-thoai/iphone/iphone-14</span>
                                            </div>
                                            <div class="category-meta">
                                                <span class="product-count">32 sản phẩm</span>
                                                <span class="status-badge active">
                                                    <i class="bi bi-check-circle"></i>
                                                </span>
                                            </div>
                                            <div class="tree-actions">
                                                <button class="btn btn-sm btn-outline-primary" onclick="editCategory(4)"
                                                    title="Chỉnh sửa">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-info" onclick="viewProducts(4)"
                                                    title="Xem sản phẩm">
                                                    <i class="bi bi-box"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(4)"
                                                    title="Xóa">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- Child: Samsung --}}
                        <div class="tree-node" data-category-id="5" data-level="1">
                            <div class="tree-item">
                                <div class="tree-handle">
                                    <i class="bi bi-grip-vertical"></i>
                                </div>
                                <span class="tree-toggle" onclick="toggleTreeNode(this)">
                                    <i class="bi bi-chevron-down"></i>
                                </span>
                                <div class="tree-content">
                                    <div class="category-icon">
                                        <i class="bi bi-phone text-success"></i>
                                    </div>
                                    <div class="category-info">
                                        <h6 class="category-name">Samsung</h6>
                                        <span class="category-slug">/dien-thoai/samsung</span>
                                    </div>
                                    <div class="category-meta">
                                        <span class="product-count">156 sản phẩm</span>
                                        <span class="status-badge active">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                    </div>
                                    <div class="tree-actions">
                                        <button class="btn btn-sm btn-outline-primary" onclick="editCategory(5)"
                                            title="Chỉnh sửa">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success" onclick="addSubCategory(5)"
                                            title="Thêm danh mục con">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" onclick="viewProducts(5)"
                                            title="Xem sản phẩm">
                                            <i class="bi bi-box"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(5)"
                                            title="Xóa">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="tree-children">
                                <div class="tree-node" data-category-id="6" data-level="2">
                                    <div class="tree-item">
                                        <div class="tree-handle">
                                            <i class="bi bi-grip-vertical"></i>
                                        </div>
                                        <span class="tree-spacer"></span>
                                        <div class="tree-content">
                                            <div class="category-icon">
                                                <i class="bi bi-phone text-success"></i>
                                            </div>
                                            <div class="category-info">
                                                <h6 class="category-name">Galaxy S Series</h6>
                                                <span class="category-slug">/dien-thoai/samsung/galaxy-s</span>
                                            </div>
                                            <div class="category-meta">
                                                <span class="product-count">67 sản phẩm</span>
                                                <span class="status-badge active">
                                                    <i class="bi bi-check-circle"></i>
                                                </span>
                                            </div>
                                            <div class="tree-actions">
                                                <button class="btn btn-sm btn-outline-primary" onclick="editCategory(6)"
                                                    title="Chỉnh sửa">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-info" onclick="viewProducts(6)"
                                                    title="Xem sản phẩm">
                                                    <i class="bi bi-box"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(6)"
                                                    title="Xóa">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Root Category 2: Laptop --}}
                <div class="tree-node" data-category-id="7" data-level="0">
                    <div class="tree-item">
                        <div class="tree-handle">
                            <i class="bi bi-grip-vertical"></i>
                        </div>
                        <span class="tree-toggle" onclick="toggleTreeNode(this)">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                        <div class="tree-content">
                            <div class="category-icon">
                                <i class="bi bi-laptop text-info"></i>
                            </div>
                            <div class="category-info">
                                <h6 class="category-name">Laptop</h6>
                                <span class="category-slug">/laptop</span>
                            </div>
                            <div class="category-meta">
                                <span class="product-count">234 sản phẩm</span>
                                <span class="status-badge active">
                                    <i class="bi bi-check-circle"></i>
                                </span>
                            </div>
                            <div class="tree-actions">
                                <button class="btn btn-sm btn-outline-primary" onclick="editCategory(7)"
                                    title="Chỉnh sửa">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" onclick="addSubCategory(7)"
                                    title="Thêm danh mục con">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" onclick="viewProducts(7)"
                                    title="Xem sản phẩm">
                                    <i class="bi bi-box"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(7)" title="Xóa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tree-children">
                        <div class="tree-node" data-category-id="8" data-level="1">
                            <div class="tree-item">
                                <div class="tree-handle">
                                    <i class="bi bi-grip-vertical"></i>
                                </div>
                                <span class="tree-spacer"></span>
                                <div class="tree-content">
                                    <div class="category-icon">
                                        <i class="bi bi-laptop text-info"></i>
                                    </div>
                                    <div class="category-info">
                                        <h6 class="category-name">MacBook</h6>
                                        <span class="category-slug">/laptop/macbook</span>
                                    </div>
                                    <div class="category-meta">
                                        <span class="product-count">78 sản phẩm</span>
                                        <span class="status-badge active">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                    </div>
                                    <div class="tree-actions">
                                        <button class="btn btn-sm btn-outline-primary" onclick="editCategory(8)"
                                            title="Chỉnh sửa">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" onclick="viewProducts(8)"
                                            title="Xem sản phẩm">
                                            <i class="bi bi-box"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(8)"
                                            title="Xóa">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tree-node" data-category-id="9" data-level="1">
                            <div class="tree-item">
                                <div class="tree-handle">
                                    <i class="bi bi-grip-vertical"></i>
                                </div>
                                <span class="tree-spacer"></span>
                                <div class="tree-content">
                                    <div class="category-icon">
                                        <i class="bi bi-laptop text-warning"></i>
                                    </div>
                                    <div class="category-info">
                                        <h6 class="category-name">Windows Laptop</h6>
                                        <span class="category-slug">/laptop/windows</span>
                                    </div>
                                    <div class="category-meta">
                                        <span class="product-count">156 sản phẩm</span>
                                        <span class="status-badge active">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                    </div>
                                    <div class="tree-actions">
                                        <button class="btn btn-sm btn-outline-primary" onclick="editCategory(9)"
                                            title="Chỉnh sửa">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" onclick="viewProducts(9)"
                                            title="Xem sản phẩm">
                                            <i class="bi bi-box"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(9)"
                                            title="Xóa">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Root Category 3: Máy tính bảng (Collapsed) --}}
                <div class="tree-node" data-category-id="10" data-level="0">
                    <div class="tree-item">
                        <div class="tree-handle">
                            <i class="bi bi-grip-vertical"></i>
                        </div>
                        <span class="tree-toggle" onclick="toggleTreeNode(this)">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                        <div class="tree-content">
                            <div class="category-icon">
                                <i class="bi bi-tablet text-success"></i>
                            </div>
                            <div class="category-info">
                                <h6 class="category-name">Máy tính bảng</h6>
                                <span class="category-slug">/may-tinh-bang</span>
                            </div>
                            <div class="category-meta">
                                <span class="product-count">89 sản phẩm</span>
                                <span class="status-badge active">
                                    <i class="bi bi-check-circle"></i>
                                </span>
                            </div>
                            <div class="tree-actions">
                                <button class="btn btn-sm btn-outline-primary" onclick="editCategory(10)"
                                    title="Chỉnh sửa">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" onclick="addSubCategory(10)"
                                    title="Thêm danh mục con">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" onclick="viewProducts(10)"
                                    title="Xem sản phẩm">
                                    <i class="bi bi-box"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(10)"
                                    title="Xóa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tree-children" style="display: none;">
                        <div class="tree-node" data-category-id="11" data-level="1">
                            <div class="tree-item">
                                <div class="tree-handle">
                                    <i class="bi bi-grip-vertical"></i>
                                </div>
                                <span class="tree-spacer"></span>
                                <div class="tree-content">
                                    <div class="category-icon">
                                        <i class="bi bi-tablet text-success"></i>
                                    </div>
                                    <div class="category-info">
                                        <h6 class="category-name">iPad</h6>
                                        <span class="category-slug">/may-tinh-bang/ipad</span>
                                    </div>
                                    <div class="category-meta">
                                        <span class="product-count">45 sản phẩm</span>
                                        <span class="status-badge active">
                                            <i class="bi bi-check-circle"></i>
                                        </span>
                                    </div>
                                    <div class="tree-actions">
                                        <button class="btn btn-sm btn-outline-primary" onclick="editCategory(11)"
                                            title="Chỉnh sửa">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" onclick="viewProducts(11)"
                                            title="Xem sản phẩm">
                                            <i class="bi bi-box"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(11)"
                                            title="Xóa">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Root Category 4: Phụ kiện âm thanh (Inactive) --}}
                <div class="tree-node inactive" data-category-id="12" data-level="0">
                    <div class="tree-item">
                        <div class="tree-handle">
                            <i class="bi bi-grip-vertical"></i>
                        </div>
                        <span class="tree-toggle" onclick="toggleTreeNode(this)">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                        <div class="tree-content">
                            <div class="category-icon">
                                <i class="bi bi-headphones text-warning"></i>
                            </div>
                            <div class="category-info">
                                <h6 class="category-name">Phụ kiện âm thanh</h6>
                                <span class="category-slug">/phu-kien-am-thanh</span>
                            </div>
                            <div class="category-meta">
                                <span class="product-count">167 sản phẩm</span>
                                <span class="status-badge inactive">
                                    <i class="bi bi-eye-slash"></i>
                                </span>
                            </div>
                            <div class="tree-actions">
                                <button class="btn btn-sm btn-outline-primary" onclick="editCategory(12)"
                                    title="Chỉnh sửa">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-success" onclick="addSubCategory(12)"
                                    title="Thêm danh mục con">
                                    <i class="bi bi-plus"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-info" onclick="viewProducts(12)"
                                    title="Xem sản phẩm">
                                    <i class="bi bi-box"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(12)"
                                    title="Xóa">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="tree-children" style="display: none;">
                        <div class="tree-node" data-category-id="13" data-level="1">
                            <div class="tree-item">
                                <div class="tree-handle">
                                    <i class="bi bi-grip-vertical"></i>
                                </div>
                                <span class="tree-spacer"></span>
                                <div class="tree-content">
                                    <div class="category-icon">
                                        <i class="bi bi-headphones text-warning"></i>
                                    </div>
                                    <div class="category-info">
                                        <h6 class="category-name">Tai nghe</h6>
                                        <span class="category-slug">/phu-kien-am-thanh/tai-nghe</span>
                                    </div>
                                    <div class="category-meta">
                                        <span class="product-count">89 sản phẩm</span>
                                        <span class="status-badge inactive">
                                            <i class="bi bi-eye-slash"></i>
                                        </span>
                                    </div>
                                    <div class="tree-actions">
                                        <button class="btn btn-sm btn-outline-primary" onclick="editCategory(13)"
                                            title="Chỉnh sửa">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-info" onclick="viewProducts(13)"
                                            title="Xem sản phẩm">
                                            <i class="bi bi-box"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" onclick="deleteCategory(13)"
                                            title="Xóa">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/admin/categories/tree.js') }}"></script>
    @endpush
@endsection
