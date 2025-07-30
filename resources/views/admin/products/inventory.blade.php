@extends('admin.layouts.app')

@section('title', 'Quản Lý Tồn Kho - GearHub Admin')

@push('styles')
    <style>
        /* Inventory Management Styles */
        .inventory-container {
            padding: 1.5rem 0;
        }

        .page-header {
            background: var(--bg-primary);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin: 0 0 0.5rem 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .page-subtitle {
            color: var(--text-secondary);
            margin: 0;
        }

        .breadcrumb {
            background: none;
            padding: 0;
            margin: 0 0 1rem 0;
            font-size: 0.875rem;
        }

        .breadcrumb-item {
            color: var(--text-secondary);
        }

        .breadcrumb-item.active {
            color: var(--primary-color);
            font-weight: 600;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
            color: var(--text-muted);
            margin: 0 0.5rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--bg-primary);
            border-radius: 12px;
            padding: 1.5rem;
            border: 1px solid var(--border-color);
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px var(--shadow-color);
        }

        .stat-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white !important;
        }

        .stat-card.total .stat-icon {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
        }

        .stat-card.low-stock .stat-icon {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .stat-card.out-stock .stat-icon {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }

        .stat-card.high-stock .stat-icon {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .stat-trend {
            font-size: 0.875rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .stat-trend.up {
            color: #10b981;
        }

        .stat-trend.down {
            color: #ef4444;
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
            margin: 0;
        }

        .filters-section {
            background: var(--bg-primary);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
        }

        .filters-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filters-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .filter-label {
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
        }

        .form-control,
        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: var(--bg-secondary);
            color: var(--text-primary);
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px var(--primary-color-alpha);
        }

        .inventory-table {
            background: var(--bg-primary);
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 3px var(--shadow-color);
        }

        .table-header {
            background: var(--bg-secondary);
            padding: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .table-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        .inventory-data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .inventory-data-table th,
        .inventory-data-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .inventory-data-table th {
            background: var(--bg-secondary);
            font-weight: 600;
            color: var(--text-primary);
            font-size: 0.875rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .inventory-data-table td {
            color: var(--text-primary);
            font-size: 0.875rem;
            vertical-align: middle;
        }

        .inventory-data-table tr:last-child td {
            border-bottom: none;
        }

        .inventory-data-table tbody tr:hover {
            background: var(--primary-color-alpha);
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .product-image {
            width: 48px;
            height: 48px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border-color);
        }

        .product-details h6 {
            margin: 0 0 0.25rem 0;
            font-weight: 600;
            color: var(--text-primary);
        }

        .product-details p {
            margin: 0;
            font-size: 0.75rem;
            color: var(--text-secondary);
        }

        .stock-level {
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            text-align: center;
            min-width: 80px;
        }

        .stock-level.high {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
        }

        .stock-level.medium {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .stock-level.low {
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
        }

        .stock-level.out {
            background: rgba(107, 114, 128, 0.1);
            color: #6b7280;
        }

        .quantity-input {
            width: 60px;
            padding: 0.5rem;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            background: var(--bg-secondary);
            color: var(--text-primary);
            font-size: 0.875rem;
            text-align: center;
            font-weight: 600;
        }

        .stock-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stock-unit {
            font-size: 0.75rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .min-stock {
            font-size: 0.875rem;
            color: var(--text-secondary);
            padding: 0.25rem 0.5rem;
            background: var(--bg-secondary);
            border-radius: 4px;
            font-weight: 500;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.75rem;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            text-decoration: none;
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            box-shadow: 0 2px 8px rgba(99, 102, 241, 0.3);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #5b21b6, #7c3aed);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #10b981, #059669);
            color: white;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #059669, #047857);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #d97706, #b45309);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.4);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary-color);
            border: 1px solid var(--primary-color);
        }

        .btn-outline:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-1px);
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            justify-content: flex-end;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
        }

        .pagination .btn {
            min-width: 40px;
            justify-content: center;
        }

        .alert {
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            border: 1px solid;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-warning {
            background: rgba(245, 158, 11, 0.1);
            border-color: #f59e0b;
            color: #f59e0b;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-color: #ef4444;
            color: #ef4444;
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
            color: #3b82f6;
        }

        /* Responsive Design */
        @media (max-width: 1024px) {
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }

            .filters-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .inventory-container {
                padding: 1rem 0;
            }

            .page-header {
                padding: 1rem;
            }

            .filters-section {
                padding: 1rem;
            }

            .filters-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .inventory-data-table {
                font-size: 0.75rem;
            }

            .inventory-data-table th,
            .inventory-data-table td {
                padding: 0.75rem 0.5rem;
            }

            .product-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }
        }
    </style>
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
                                    <button class="btn btn-sm btn-primary" title="Điều chỉnh">
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
                                    <button class="btn btn-sm btn-primary" title="Điều chỉnh">
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
                                    <button class="btn btn-sm btn-primary" title="Điều chỉnh">
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
                                    <button class="btn btn-sm btn-primary" title="Điều chỉnh">
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
                                    <button class="btn btn-sm btn-primary" title="Điều chỉnh">
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
                                    <button class="btn btn-sm btn-primary" title="Điều chỉnh">
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
