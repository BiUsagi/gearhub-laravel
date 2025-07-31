@extends('admin.layouts.app')

@section('title', 'Quản Lý Tồn Kho - GearHub Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin/products/inventory.css') }}">
@endpush

@section('content')
    <div class="inventory-container p-3">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/admin/products">Sản Phẩm</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quản Lý Tồn Kho</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="page-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="page-title">
                        <i class="bi bi-boxes"></i>
                        Quản Lý Tồn Kho
                    </h1>
                    <p class="page-subtitle">Theo dõi và quản lý số lượng sản phẩm trong kho</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="/admin/products" class="btn btn-outline">
                        <i class="bi bi-arrow-left"></i>
                        Quay lại
                    </a>
                    <button type="button" class="btn btn-primary">
                        <i class="bi bi-plus-circle"></i>
                        Nhập kho
                    </button>
                </div>
            </div>
        </div>

        {{-- Stats Overview --}}
        <div class="stats-grid">
            <div class="stat-card total">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-boxes"></i>
                    </div>
                    <div class="stat-trend up">
                        <i class="bi bi-arrow-up"></i>
                        +5.2%
                    </div>
                </div>
                <div class="stat-value">1,247</div>
                <p class="stat-label">Tổng sản phẩm trong kho</p>
            </div>
            <div class="stat-card low-stock">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-exclamation-triangle"></i>
                    </div>
                    <div class="stat-trend down">
                        <i class="bi bi-arrow-down"></i>
                        -2.1%
                    </div>
                </div>
                <div class="stat-value">23</div>
                <p class="stat-label">Sản phẩm sắp hết hàng</p>
            </div>
            <div class="stat-card out-stock">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-x-circle"></i>
                    </div>
                    <div class="stat-trend up">
                        <i class="bi bi-arrow-up"></i>
                        +1.3%
                    </div>
                </div>
                <div class="stat-value">8</div>
                <p class="stat-label">Sản phẩm hết hàng</p>
            </div>
            <div class="stat-card high-stock">
                <div class="stat-header">
                    <div class="stat-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="stat-trend up">
                        <i class="bi bi-arrow-up"></i>
                        +8.7%
                    </div>
                </div>
                <div class="stat-value">1,216</div>
                <p class="stat-label">Sản phẩm còn hàng</p>
            </div>
        </div>

        {{-- Alerts --}}
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <strong>Cảnh báo:</strong> Có 23 sản phẩm sắp hết hàng, cần nhập thêm kho!
        </div>

        <div class="alert alert-danger">
            <i class="bi bi-x-circle-fill"></i>
            <strong>Hết hàng:</strong> 8 sản phẩm đã hết hàng và cần nhập kho ngay lập tức!
        </div>

        {{-- Filters Section --}}
        <div class="filters-section">
            <h3 class="filters-title">
                <i class="bi bi-funnel"></i>
                Bộ lọc
            </h3>
            <div class="filters-grid">
                <div class="filter-group">
                    <label class="filter-label">Danh mục</label>
                    <select class="form-select">
                        <option value="">Tất cả danh mục</option>
                        <option value="1">Điện Thoại</option>
                        <option value="2">Laptop</option>
                        <option value="3">Máy Tính Bảng</option>
                        <option value="4">Phụ Kiện</option>
                        <option value="5">Tai Nghe</option>
                        <option value="6">Smartwatch</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Trạng thái tồn kho</label>
                    <select class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="high">Còn hàng</option>
                        <option value="medium">Ít hàng</option>
                        <option value="low">Sắp hết hàng</option>
                        <option value="out">Hết hàng</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Thương hiệu</label>
                    <select class="form-select">
                        <option value="">Tất cả thương hiệu</option>
                        <option value="apple">Apple</option>
                        <option value="samsung">Samsung</option>
                        <option value="sony">Sony</option>
                        <option value="lg">LG</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Tìm kiếm</label>
                    <input type="text" class="form-control" placeholder="Tên sản phẩm, SKU...">
                </div>
            </div>
            <div class="action-buttons">
                <button type="button" class="btn btn-primary">
                    <i class="bi bi-search"></i>
                    Tìm kiếm
                </button>
                <button type="button" class="btn btn-outline">
                    <i class="bi bi-arrow-clockwise"></i>
                    Đặt lại
                </button>
            </div>
        </div>

        {{-- Inventory Table --}}
        <div class="inventory-table">
            <div class="table-header">
                <h3 class="table-title">
                    <i class="bi bi-table"></i>
                    Danh Sách Tồn Kho
                </h3>
            </div>
            <div class="table-wrapper">
                <table class="inventory-data-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>SKU</th>
                            <th>Tồn kho</th>
                            <th>Trạng thái</th>
                            <th>Mức tối thiểu</th>
                            <th>Nhập cuối</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="{{ asset('storage/products/product-1.png') }}" alt="iPhone 15 Pro Max"
                                        class="product-image">
                                    <div class="product-details">
                                        <h6>iPhone 15 Pro Max 256GB</h6>
                                        <p>Titan Tự Nhiên</p>
                                    </div>
                                </div>
                            </td>
                            <td><strong>IP15PM-256-TN</strong></td>
                            <td>
                                <div class="stock-info">
                                    <input type="number" class="quantity-input" value="45" min="0">
                                    <span class="stock-unit">chiếc</span>
                                </div>
                            </td>
                            <td><span class="stock-level high">Còn hàng</span></td>
                            <td><span class="min-stock">10</span></td>
                            <td>25/07/2025</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-success" title="Nhập kho">
                                        <i class="bi bi-plus-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Cài đặt sản phẩm"
                                        onclick="showProductSettingsModal('IP15PM-256-TN', 'iPhone 15 Pro Max 256GB', 45, 10, '{{ asset('storage/products/product-1.png') }}')">
                                        <i class="bi bi-gear"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="{{ asset('storage/products/product-2.png') }}" alt="MacBook Pro M3"
                                        class="product-image">
                                    <div class="product-details">
                                        <h6>MacBook Pro M3 14"</h6>
                                        <p>512GB - Space Gray</p>
                                    </div>
                                </div>
                            </td>
                            <td><strong>MBP-M3-14-512</strong></td>
                            <td>
                                <div class="stock-info">
                                    <input type="number" class="quantity-input" value="12" min="0">
                                    <span class="stock-unit">chiếc</span>
                                </div>
                            </td>
                            <td><span class="stock-level medium">Ít hàng</span></td>
                            <td><span class="min-stock">5</span></td>
                            <td>22/07/2025</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-warning" title="Nhập kho gấp">
                                        <i class="bi bi-exclamation-triangle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Cài đặt sản phẩm"
                                        onclick="showProductSettingsModal('MBP-M3-14-512', 'MacBook Pro M3 14', 12, 5, '{{ asset('storage/products/product-2.png') }}')">
                                        <i class="bi bi-gear"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="{{ asset('storage/products/product-3.png') }}" alt="AirPods Pro"
                                        class="product-image">
                                    <div class="product-details">
                                        <h6>AirPods Pro Gen 2</h6>
                                        <p>USB-C Case</p>
                                    </div>
                                </div>
                            </td>
                            <td><strong>APP-G2-USBC</strong></td>
                            <td>
                                <div class="stock-info">
                                    <input type="number" class="quantity-input" value="3" min="0">
                                    <span class="stock-unit">chiếc</span>
                                </div>
                            </td>
                            <td><span class="stock-level low">Sắp hết</span></td>
                            <td><span class="min-stock">15</span></td>
                            <td>20/07/2025</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-warning" title="Nhập kho gấp">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Cài đặt sản phẩm"
                                        onclick="showProductSettingsModal('APP-G2-USBC', 'AirPods Pro Gen 2', 3, 15, '{{ asset('storage/products/product-3.png') }}')">
                                        <i class="bi bi-gear"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="{{ asset('storage/products/product-4.png') }}" alt="Galaxy S24 Ultra"
                                        class="product-image">
                                    <div class="product-details">
                                        <h6>Galaxy S24 Ultra 512GB</h6>
                                        <p>Phantom Black</p>
                                    </div>
                                </div>
                            </td>
                            <td><strong>GS24U-512-PB</strong></td>
                            <td>
                                <div class="stock-info">
                                    <input type="number" class="quantity-input" value="0" min="0">
                                    <span class="stock-unit">chiếc</span>
                                </div>
                            </td>
                            <td><span class="stock-level out">Hết hàng</span></td>
                            <td><span class="min-stock">8</span></td>
                            <td>15/07/2025</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-danger" title="Nhập kho ngay">
                                        <i class="bi bi-plus-circle-fill"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Cài đặt sản phẩm"
                                        onclick="showProductSettingsModal('GS24U-512-PB', 'Galaxy S24 Ultra 512GB', 0, 8, '{{ asset('storage/products/product-4.png') }}')">
                                        <i class="bi bi-gear"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="{{ asset('storage/products/product-5.png') }}" alt="iPad Pro M4"
                                        class="product-image">
                                    <div class="product-details">
                                        <h6>iPad Pro M4 11"</h6>
                                        <p>256GB WiFi - Space Black</p>
                                    </div>
                                </div>
                            </td>
                            <td><strong>IPDP-M4-11-256</strong></td>
                            <td>
                                <div class="stock-info">
                                    <input type="number" class="quantity-input" value="18" min="0">
                                    <span class="stock-unit">chiếc</span>
                                </div>
                            </td>
                            <td><span class="stock-level high">Còn hàng</span></td>
                            <td><span class="min-stock">6</span></td>
                            <td>28/07/2025</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-success" title="Nhập kho">
                                        <i class="bi bi-plus-circle"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Cài đặt sản phẩm"
                                        onclick="showProductSettingsModal('IPDP-M4-11-256', 'iPad Pro M4 11', 18, 6, '{{ asset('storage/products/product-5.png') }}')">
                                        <i class="bi bi-gear"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="product-info">
                                    <img src="{{ asset('storage/products/product-2.png') }}" alt="Sony WH-1000XM5"
                                        class="product-image">
                                    <div class="product-details">
                                        <h6>Sony WH-1000XM5</h6>
                                        <p>Wireless NC Headphones</p>
                                    </div>
                                </div>
                            </td>
                            <td><strong>SONY-WH1000XM5</strong></td>
                            <td>
                                <div class="stock-info">
                                    <input type="number" class="quantity-input" value="5" min="0">
                                    <span class="stock-unit">chiếc</span>
                                </div>
                            </td>
                            <td><span class="stock-level low">Sắp hết</span></td>
                            <td><span class="min-stock">12</span></td>
                            <td>18/07/2025</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-warning" title="Nhập kho gấp">
                                        <i class="bi bi-exclamation-triangle-fill"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" title="Cài đặt sản phẩm"
                                        onclick="showProductSettingsModal('SONY-WH1000XM5', 'Sony WH-1000XM5', 5, 12, '{{ asset('storage/products/product-2.png') }}')">
                                        <i class="bi bi-gear"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="pagination">
            <button class="btn btn-outline">
                <i class="bi bi-chevron-left"></i>
            </button>
            <button class="btn btn-primary">1</button>
            <button class="btn btn-outline">2</button>
            <button class="btn btn-outline">3</button>
            <button class="btn btn-outline">...</button>
            <button class="btn btn-outline">15</button>
            <button class="btn btn-outline">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
    </div>

    <!-- Product Settings Modal -->
    <div class="modal fade" id="productSettingsModal" tabindex="-1" aria-labelledby="productSettingsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content"
                style="background: var(--card-bg); border: 2px solid var(--border-color); border-radius: 16px;">
                <div class="modal-header"
                    style="background: var(--card-bg); border-bottom: 2px solid var(--border-color); padding: 2rem;">
                    <h5 class="modal-title" id="productSettingsModalLabel"
                        style="color: var(--text-primary); font-weight: 700; font-size: 1.5rem;">
                        <i class="bi bi-gear me-2" style="color: var(--primary-color);"></i>
                        Cài đặt sản phẩm
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
                <div class="modal-body" style="background: var(--card-bg); padding: 2rem;">
                    <!-- Product Info -->
                    <div class="product-info-card"
                        style="background: var(--bg-secondary); border: 2px solid var(--border-color); border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem;">
                        <div class="d-flex align-items-center mb-3">
                            <div class="product-avatar"
                                style="width: 64px; height: 64px; border-radius: 12px; margin-right: 1rem; overflow: hidden; border: 2px solid var(--border-color);">
                                <img id="modalProductImage" src="" alt="Product Image"
                                    style="width: 100%; height: 100%; object-fit: cover; display: block;"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="fallback-icon"
                                    style="width: 100%; height: 100%; background: var(--primary-gradient); display: none; align-items: center; justify-content: center; color: white; font-size: 1.5rem;">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-1" id="modalProductName"
                                    style="color: var(--text-primary); font-weight: 600; font-size: 1.1rem;"></h6>
                                <p class="mb-0" id="modalProductSKU"
                                    style="color: var(--text-secondary); font-size: 0.875rem;"></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="text-center">
                                    <div class="fw-bold text-primary" id="modalCurrentStock" style="font-size: 1.25rem;">
                                    </div>
                                    <small class="text-muted">Tồn kho hiện tại</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center">
                                    <div class="fw-bold text-warning" id="modalMinStock" style="font-size: 1.25rem;">
                                    </div>
                                    <small class="text-muted">Mức tối thiểu</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text-center">
                                    <div class="fw-bold text-success" style="font-size: 1.25rem;">Good</div>
                                    <small class="text-muted">Trạng thái</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Settings Tabs -->
                    <ul class="nav nav-tabs mb-4" id="settingsTabs" role="tablist"
                        style="border-bottom: 2px solid var(--border-color);">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="inventory-tab" data-bs-toggle="tab"
                                data-bs-target="#inventory-pane" type="button" role="tab"
                                style="color: var(--text-primary); border: none; background: none; padding: 1rem 1.5rem; font-weight: 600;">
                                <i class="bi bi-boxes me-2"></i>Quản lý tồn kho
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="alerts-tab" data-bs-toggle="tab" data-bs-target="#alerts-pane"
                                type="button" role="tab"
                                style="color: var(--text-secondary); border: none; background: none; padding: 1rem 1.5rem; font-weight: 600;">
                                <i class="bi bi-bell me-2"></i>Cảnh báo
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="history-tab" data-bs-toggle="tab"
                                data-bs-target="#history-pane" type="button" role="tab"
                                style="color: var(--text-secondary); border: none; background: none; padding: 1rem 1.5rem; font-weight: 600;">
                                <i class="bi bi-clock-history me-2"></i>Lịch sử
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="settingsTabContent">
                        <!-- Inventory Management Tab -->
                        <div class="tab-pane fade show active" id="inventory-pane" role="tabpanel">
                            <div class="row g-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold"
                                            style="color: var(--text-primary); margin-bottom: 0.5rem;">
                                            <i class="bi bi-hash me-1"></i>Số lượng hiện tại
                                        </label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="currentQuantity"
                                                style="background: var(--bg-secondary); border: 1px solid var(--border-color); color: var(--text-primary); padding: 0.75rem;">
                                            <span class="input-group-text"
                                                style="background: var(--bg-secondary); border: 1px solid var(--border-color); color: var(--text-secondary);">chiếc</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold"
                                            style="color: var(--text-primary); margin-bottom: 0.5rem;">
                                            <i class="bi bi-exclamation-triangle me-1"></i>Mức tồn kho tối thiểu
                                        </label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="minQuantity"
                                                style="background: var(--bg-secondary); border: 1px solid var(--border-color); color: var(--text-primary); padding: 0.75rem;">
                                            <span class="input-group-text"
                                                style="background: var(--bg-secondary); border: 1px solid var(--border-color); color: var(--text-secondary);">chiếc</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold"
                                            style="color: var(--text-primary); margin-bottom: 0.5rem;">
                                            <i class="bi bi-plus-circle me-1"></i>Nhập thêm kho
                                        </label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="addQuantity" placeholder="0"
                                                min="0"
                                                style="background: var(--bg-secondary); border: 1px solid var(--border-color); color: var(--text-primary); padding: 0.75rem;">
                                            <button class="btn btn-success" type="button" onclick="addStock()">
                                                <i class="bi bi-plus-lg me-1"></i>Nhập
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label fw-semibold"
                                            style="color: var(--text-primary); margin-bottom: 0.5rem;">
                                            <i class="bi bi-dash-circle me-1"></i>Xuất kho
                                        </label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="removeQuantity"
                                                placeholder="0" min="0"
                                                style="background: var(--bg-secondary); border: 1px solid var(--border-color); color: var(--text-primary); padding: 0.75rem;">
                                            <button class="btn btn-warning" type="button" onclick="removeStock()">
                                                <i class="bi bi-dash-lg me-1"></i>Xuất
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="mt-4">
                                <h6 style="color: var(--text-primary); margin-bottom: 1rem;">
                                    <i class="bi bi-lightning me-2"></i>Thao tác nhanh
                                </h6>
                                <div class="d-flex gap-2 flex-wrap">
                                    <button class="btn btn-outline-primary btn-sm" onclick="quickAdd(10)">+10</button>
                                    <button class="btn btn-outline-primary btn-sm" onclick="quickAdd(20)">+20</button>
                                    <button class="btn btn-outline-primary btn-sm" onclick="quickAdd(50)">+50</button>
                                    <button class="btn btn-outline-primary btn-sm" onclick="quickAdd(100)">+100</button>
                                    <button class="btn btn-outline-warning btn-sm" onclick="setMinStock()">Đặt mức tối
                                        thiểu</button>
                                    <button class="btn btn-outline-danger btn-sm" onclick="zeroStock()">Đặt về 0</button>
                                </div>
                            </div>
                        </div>

                        <!-- Alerts Tab -->
                        <div class="tab-pane fade" id="alerts-pane" role="tabpanel">
                            <div class="alert-settings">
                                <h6 style="color: var(--text-primary); margin-bottom: 1rem;">
                                    <i class="bi bi-bell me-2"></i>Cài đặt cảnh báo
                                </h6>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="lowStockAlert" checked>
                                    <label class="form-check-label" for="lowStockAlert"
                                        style="color: var(--text-primary);">
                                        Cảnh báo khi sắp hết hàng
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="outOfStockAlert" checked>
                                    <label class="form-check-label" for="outOfStockAlert"
                                        style="color: var(--text-primary);">
                                        Cảnh báo khi hết hàng
                                    </label>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="emailAlert">
                                    <label class="form-check-label" for="emailAlert" style="color: var(--text-primary);">
                                        Gửi email thông báo
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- History Tab -->
                        <div class="tab-pane fade" id="history-pane" role="tabpanel">
                            <h6 style="color: var(--text-primary); margin-bottom: 1rem;">
                                <i class="bi bi-clock-history me-2"></i>Lịch sử nhập xuất
                            </h6>
                            <div class="history-list" style="max-height: 300px; overflow-y: auto;">
                                <div class="history-item d-flex justify-content-between align-items-center py-2 border-bottom"
                                    style="border-color: var(--border-color) !important;">
                                    <div>
                                        <div style="color: var(--text-primary); font-weight: 600;">
                                            <i class="bi bi-plus-circle text-success me-2"></i>Nhập kho +50 chiếc
                                        </div>
                                        <small style="color: var(--text-secondary);">28/07/2025 14:30</small>
                                    </div>
                                    <span class="badge bg-success">Nhập kho</span>
                                </div>
                                <div class="history-item d-flex justify-content-between align-items-center py-2 border-bottom"
                                    style="border-color: var(--border-color) !important;">
                                    <div>
                                        <div style="color: var(--text-primary); font-weight: 600;">
                                            <i class="bi bi-dash-circle text-warning me-2"></i>Bán hàng -12 chiếc
                                        </div>
                                        <small style="color: var(--text-secondary);">27/07/2025 09:15</small>
                                    </div>
                                    <span class="badge bg-warning">Bán hàng</span>
                                </div>
                                <div class="history-item d-flex justify-content-between align-items-center py-2 border-bottom"
                                    style="border-color: var(--border-color) !important;">
                                    <div>
                                        <div style="color: var(--text-primary); font-weight: 600;">
                                            <i class="bi bi-gear text-info me-2"></i>Điều chỉnh mức tối thiểu: 10 → 15
                                        </div>
                                        <small style="color: var(--text-secondary);">25/07/2025 16:20</small>
                                    </div>
                                    <span class="badge bg-info">Điều chỉnh</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"
                    style="background: var(--card-bg); border-top: 2px solid var(--border-color); padding: 2rem;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x me-2"></i>Hủy
                    </button>
                    <button type="button" class="btn btn-success" onclick="saveSettings()">
                        <i class="bi bi-check-lg me-2"></i>Lưu thay đổi
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update quantity function
            const quantityInputs = document.querySelectorAll('.quantity-input');

            quantityInputs.forEach(input => {
                input.addEventListener('change', function() {
                    const row = this.closest('tr');
                    const quantity = parseInt(this.value);
                    const statusCell = row.querySelector('.stock-level');

                    // Update status based on quantity
                    if (quantity === 0) {
                        statusCell.className = 'stock-level out';
                        statusCell.textContent = 'Hết hàng';
                    } else if (quantity <= 5) {
                        statusCell.className = 'stock-level low';
                        statusCell.textContent = 'Sắp hết';
                    } else if (quantity <= 15) {
                        statusCell.className = 'stock-level medium';
                        statusCell.textContent = 'Ít hàng';
                    } else {
                        statusCell.className = 'stock-level high';
                        statusCell.textContent = 'Còn hàng';
                    }

                    // Show update notification
                    showNotification('Đã cập nhật số lượng tồn kho!', 'success');
                });
            });

            // Action button handlers
            document.querySelectorAll('.btn-primary').forEach(btn => {
                if (btn.querySelector('.bi-pencil')) {
                    btn.addEventListener('click', function() {
                        showNotification('Chỉnh sửa thông tin sản phẩm', 'info');
                    });
                }
            });

            // Product Settings Modal Functions
            window.showProductSettingsModal = function(sku, name, currentStock, minStock, imageSrc) {
                // Fill modal data
                document.getElementById('modalProductName').textContent = name;
                document.getElementById('modalProductSKU').textContent = `SKU: ${sku}`;
                document.getElementById('modalCurrentStock').textContent = currentStock + ' chiếc';
                document.getElementById('modalMinStock').textContent = minStock + ' chiếc';
                document.getElementById('currentQuantity').value = currentStock;
                document.getElementById('minQuantity').value = minStock;

                // Set product image
                const modalImage = document.getElementById('modalProductImage');
                if (imageSrc) {
                    modalImage.src = imageSrc;
                    modalImage.style.display = 'block';
                    modalImage.nextElementSibling.style.display = 'none';
                } else {
                    modalImage.style.display = 'none';
                    modalImage.nextElementSibling.style.display = 'flex';
                }

                // Clear input fields
                document.getElementById('addQuantity').value = '';
                document.getElementById('removeQuantity').value = '';

                // Store current data
                window.currentProductData = {
                    sku: sku,
                    name: name,
                    currentStock: parseInt(currentStock),
                    minStock: parseInt(minStock)
                };

                // Show modal
                const modal = new bootstrap.Modal(document.getElementById('productSettingsModal'));
                modal.show();
            };

            // Quick add functions
            window.quickAdd = function(amount) {
                const currentQty = parseInt(document.getElementById('currentQuantity').value) || 0;
                const newQty = currentQty + amount;
                document.getElementById('currentQuantity').value = newQty;
                document.getElementById('modalCurrentStock').textContent = newQty + ' chiếc';
                showNotification(`Đã thêm ${amount} sản phẩm vào kho`, 'success');
            };

            window.addStock = function() {
                const addAmount = parseInt(document.getElementById('addQuantity').value) || 0;
                if (addAmount <= 0) {
                    showNotification('Vui lòng nhập số lượng hợp lệ', 'warning');
                    return;
                }
                const currentQty = parseInt(document.getElementById('currentQuantity').value) || 0;
                const newQty = currentQty + addAmount;
                document.getElementById('currentQuantity').value = newQty;
                document.getElementById('modalCurrentStock').textContent = newQty + ' chiếc';
                document.getElementById('addQuantity').value = '';
                showNotification(`Đã nhập thêm ${addAmount} sản phẩm vào kho`, 'success');
            };

            window.removeStock = function() {
                const removeAmount = parseInt(document.getElementById('removeQuantity').value) || 0;
                const currentQty = parseInt(document.getElementById('currentQuantity').value) || 0;

                if (removeAmount <= 0) {
                    showNotification('Vui lòng nhập số lượng hợp lệ', 'warning');
                    return;
                }

                if (removeAmount > currentQty) {
                    showNotification('Không thể xuất nhiều hơn số lượng hiện có', 'warning');
                    return;
                }

                const newQty = currentQty - removeAmount;
                document.getElementById('currentQuantity').value = newQty;
                document.getElementById('modalCurrentStock').textContent = newQty + ' chiếc';
                document.getElementById('removeQuantity').value = '';
                showNotification(`Đã xuất ${removeAmount} sản phẩm khỏi kho`, 'success');
            };

            window.setMinStock = function() {
                const currentQty = parseInt(document.getElementById('currentQuantity').value) || 0;
                document.getElementById('minQuantity').value = currentQty;
                document.getElementById('modalMinStock').textContent = currentQty + ' chiếc';
                showNotification('Đã đặt mức tối thiểu bằng số lượng hiện tại', 'info');
            };

            window.zeroStock = function() {
                if (confirm('Bạn có chắc chắn muốn đặt số lượng về 0?')) {
                    document.getElementById('currentQuantity').value = 0;
                    document.getElementById('modalCurrentStock').textContent = '0 chiếc';
                    showNotification('Đã đặt số lượng tồn kho về 0', 'warning');
                }
            };

            window.saveSettings = function() {
                const newQty = parseInt(document.getElementById('currentQuantity').value) || 0;
                const newMinQty = parseInt(document.getElementById('minQuantity').value) || 0;
                const productData = window.currentProductData;

                // Update the table row
                const rows = document.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    const skuCell = row.querySelector('td:nth-child(2) strong');
                    if (skuCell && skuCell.textContent === productData.sku) {
                        // Update quantity input
                        const qtyInput = row.querySelector('.quantity-input');
                        qtyInput.value = newQty;

                        // Update min stock display
                        const minStockSpan = row.querySelector('.min-stock');
                        minStockSpan.textContent = newMinQty;

                        // Update status
                        const statusSpan = row.querySelector('.stock-level');
                        if (newQty === 0) {
                            statusSpan.className = 'stock-level out';
                            statusSpan.textContent = 'Hết hàng';
                        } else if (newQty <= newMinQty) {
                            statusSpan.className = 'stock-level low';
                            statusSpan.textContent = 'Sắp hết';
                        } else if (newQty <= newMinQty * 2) {
                            statusSpan.className = 'stock-level medium';
                            statusSpan.textContent = 'Ít hàng';
                        } else {
                            statusSpan.className = 'stock-level high';
                            statusSpan.textContent = 'Còn hàng';
                        }
                    }
                });

                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('productSettingsModal'));
                modal.hide();

                showNotification('Đã lưu cài đặt sản phẩm thành công!', 'success');
            };

            // Tab styling
            document.querySelectorAll('#settingsTabs .nav-link').forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active styles from all tabs
                    document.querySelectorAll('#settingsTabs .nav-link').forEach(t => {
                        t.style.color = 'var(--text-secondary)';
                        t.style.borderBottom = 'none';
                    });

                    // Add active style to clicked tab
                    this.style.color = 'var(--primary-color)';
                    this.style.borderBottom = '3px solid var(--primary-color)';
                });
            });

            document.querySelectorAll('.btn-success').forEach(btn => {
                btn.addEventListener('click', function() {
                    showNotification('Nhập thêm kho cho sản phẩm', 'success');
                });
            });

            document.querySelectorAll('.btn-warning').forEach(btn => {
                btn.addEventListener('click', function() {
                    showNotification('Cảnh báo: Sản phẩm sắp hết hàng!', 'warning');
                });
            });

            // Filter handlers
            document.querySelector('.btn-primary').addEventListener('click', function() {
                if (this.querySelector('.bi-search')) {
                    showNotification('Đang tìm kiếm...', 'info');
                }
            });

            document.querySelector('.btn-outline').addEventListener('click', function() {
                if (this.querySelector('.bi-arrow-clockwise')) {
                    // Reset all filters
                    document.querySelectorAll('.form-select, .form-control').forEach(element => {
                        element.value = '';
                    });
                    showNotification('Đã đặt lại tất cả bộ lọc', 'info');
                }
            });

            function showNotification(message, type) {
                // Create notification element
                const notification = document.createElement('div');
                notification.className = 'notification-toast';
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    min-width: 320px;
                    max-width: 400px;
                    padding: 1rem 1.25rem;
                    border-radius: 12px;
                    border: 1px solid;
                    font-size: 0.875rem;
                    font-weight: 500;
                    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                    backdrop-filter: blur(10px);
                    transform: translateX(100%);
                    transition: all 0.3s ease;
                    display: flex;
                    align-items: center;
                    gap: 0.75rem;
                `;

                // Set colors based on type
                if (type === 'success') {
                    notification.style.background = 'var(--bg-primary)';
                    notification.style.borderColor = '#10b981';
                    notification.style.color = 'var(--text-primary)';
                } else if (type === 'warning') {
                    notification.style.background = 'var(--bg-primary)';
                    notification.style.borderColor = '#f59e0b';
                    notification.style.color = 'var(--text-primary)';
                } else {
                    notification.style.background = 'var(--bg-primary)';
                    notification.style.borderColor = '#3b82f6';
                    notification.style.color = 'var(--text-primary)';
                }

                notification.innerHTML = `
                    <div style="
                        width: 32px;
                        height: 32px;
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-size: 1rem;
                        background: ${type === 'success' ? 'linear-gradient(135deg, #10b981, #059669)' : 
                                    type === 'warning' ? 'linear-gradient(135deg, #f59e0b, #d97706)' : 
                                    'linear-gradient(135deg, #3b82f6, #2563eb)'}
                    ">
                        <i class="bi bi-${type === 'success' ? 'check-circle-fill' : type === 'warning' ? 'exclamation-triangle-fill' : 'info-circle-fill'}"></i>
                    </div>
                    <div style="flex: 1;">
                        <div style="font-weight: 600; margin-bottom: 0.25rem; color: var(--text-primary);">
                            ${type === 'success' ? 'Thành công!' : type === 'warning' ? 'Cảnh báo!' : 'Thông báo'}
                        </div>
                        <div style="color: var(--text-secondary); font-size: 0.8rem;">
                            ${message}
                        </div>
                    </div>
                    <button onclick="this.parentElement.remove()" style="
                        background: none;
                        border: none;
                        color: var(--text-secondary);
                        cursor: pointer;
                        font-size: 1.2rem;
                        padding: 0;
                        width: 24px;
                        height: 24px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        border-radius: 50%;
                        transition: all 0.2s ease;
                    " onmouseover="this.style.background='var(--bg-secondary)'; this.style.color='var(--text-primary)'" 
                       onmouseout="this.style.background='none'; this.style.color='var(--text-secondary)'">
                        <i class="bi bi-x"></i>
                    </button>
                `;

                document.body.appendChild(notification);

                // Animate in
                setTimeout(() => {
                    notification.style.transform = 'translateX(0)';
                }, 100);

                // Auto remove after 4 seconds
                setTimeout(() => {
                    notification.style.transform = 'translateX(100%)';
                    setTimeout(() => {
                        if (notification.parentElement) {
                            notification.remove();
                        }
                    }, 300);
                }, 4000);
            }
        });
    </script>
@endpush
